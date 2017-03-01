<?php
/**
 * Migrate redirects from resource properties to seoUrl objects
 *
 * @package stercseo
 * @subpackage processors
 */

class StercSeoMigrateProcessor extends modProcessor
{
    public function process()
    {
        $count = 0;
        $limit = 1000;
        $queryLimit = 100;
        $site_url = $this->modx->getOption('site_url');

        $site_urls = array();
        $contexts = $this->modx->getCollection('modContext', array('key:!=' => 'mgr'));
        foreach ($contexts as $ctx) {
            $context_key = $ctx->get('key');
            $context = $this->modx->getContext($context_key);
            if ($context) {
                $site_url = $context->getOption('site_url', null, '');
                $base_url = $context->getOption('base_url', null, '');
            }
            if (isset($base_url) && !empty($base_url)) {
                $site_url = str_replace($base_url, '/', $site_url);
            }
            $site_urls[$context_key] = $site_url;
        }

        $c = $this->modx->newQuery('modResource');
        $c->prepare();

        $sql = $c->toSql() . ' WHERE ( `modResource`.`context_key` != \'mgr\' AND `modResource`.`properties` LIKE \'%urls":[{"url":"%\' ) LIMIT ' . $queryLimit;
        $results = $this->modx->query($sql);

        while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
            if ($count > $limit) {
                break;
            }
            $context_key = $row['modResource_context_key'];

            $site_url = $site_urls[$context_key];

            $properties = json_decode($row['modResource_properties'], true);

            if ($properties['stercseo']['urls']) {
                foreach ($properties['stercseo']['urls'] as $urls) {
                    foreach ($urls as $url) {
                        $encoded_url = urlencode($site_url.ltrim($url, '/'));
                        $q = $this->modx->newQuery('seoUrl');
                        $q->where(array(
                            'url' => $encoded_url
                        ));

                        $query = $q->toSql();

                        // fix for hhvm, which will throw a 500 error if there is an empty query
                        if (strlen($query) > 0) {
                            $redirect = $this->modx->query($query);
                            if (is_object($redirect)) {
                                continue;
                            }
                        }

                        // if no matches are found in the block above, this will insert a redirect
                        $this->modx->exec("INSERT INTO {$this->modx->getTableName('seoUrl')} 
                            SET {$this->modx->escape('url')} = {$this->modx->quote($encoded_url)}, 
                                {$this->modx->escape('resource')} = {$this->modx->quote($row['modResource_id'])}, 
                                {$this->modx->escape('context_key')} = {$this->modx->quote($context_key)}");

                        $count++;
                    }
                }
                // reset the urls in properties
                $properties['stercseo']['urls'] = '';
                $this->modx->exec("UPDATE {$this->modx->getTableName('modResource')}
                    SET {$this->modx->escape('properties')} = {$this->modx->quote(json_encode($properties))}
                    WHERE {$this->modx->escape('id')} = {$this->modx->quote($row['modResource_id'])} ");
            }
        }

        if ($count == 0) {
            $migrationStatus = $this->modx->getObject('modSystemSetting', array('key' => 'stercseo.migration_status', 'namespace' => 'stercseo_custom'));
            if (!$migrationStatus) {
                $migrationStatus = $this->modx->newObject('modSystemSetting');
                $migrationStatus->set('key', 'stercseo.migration_status');
                $migrationStatus->set('namespace', 'stercseo_custom');
            }
            $migrationStatus->set('value', '1');
            $migrationStatus->save();
            $this->log('No 301 redirect urls found in resource properties.');
        } else {
            $this->log('-------------------------------------------------------------');
            $this->log($count.' Redirect urls migrated from resource properties to seoUrl objects.');
        }

        return $this->outputArray(array(), $count);
    }

    private function log($message)
    {
        // Decrease log level to enable INFO level logging
        // First get the current log level
        $logLevel = $this->modx->getOption('log_level');
        $this->modx->setLogLevel(MODx::LOG_LEVEL_INFO);
        $logTarget = array(
            'target' => 'FILE',
            'options' => array(
                'filepath' => $this->modx->stercseo->config['assetsPath'],
                'filename' => 'migration.log'
            )
        );
        $this->modx->log(MODx::LOG_LEVEL_INFO, $message, $logTarget);
        // Set log level back to original
        $this->modx->setLogLevel($logLevel);
        return;
    }
}
return 'StercSeoMigrateProcessor';
