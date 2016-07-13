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
        $site_url = $this->modx->getOption('site_url');
        $resources = $this->modx->getIterator('modResource', array('context_key:!=' => 'mgr'));
        foreach ($resources as $resource) {
            $context_key = $resource->get('context_key');
            $site_url_setting = $this->modx->getObject('modContextSetting', array('context_key' => $context_key, 'key' => 'site_url'));
            if ($site_url_setting) {
                $site_url = $site_url_setting->get('value');
            }
            $base_url_setting = $this->modx->getObject('modContextSetting', array('context_key' => $context_key, 'key' => 'base_url'));
            if ($base_url_setting) {
                $base_url = $base_url_setting->get('value');
            }
            if (isset($base_url) && !empty($base_url)) {
                $site_url = str_replace($base_url, '/', $site_url);
            }
            $properties = $resource->getProperties('stercseo');
            if ($properties['urls']) {
                foreach ($properties['urls'] as $urls) {
                    foreach ($urls as $url) {
                        $encoded_url = urlencode($site_url.ltrim($url, '/'));
                        $redirect = $this->modx->getObject('seoUrl', array('url' => $encoded_url));
                        if (!$redirect) {
                            $redirect = $this->modx->newObject('seoUrl');
                            $data = array(
                               'url' => $encoded_url,
                               'resource' => $resource->get('id'),
                               'context_key' => $context_key,
                            );
                            $redirect->fromArray($data);
                            $redirect->save();
                            $logMessage = 'New redirect URL: '.($site_url.$url).' >>>> '.$resource->get('uri').' - Added to resource '.$resource->get('id').'<br>';
                            $this->log($logMessage);
                            $count++;
                        } else {
                            $logMessage = 'Existing redirect URL '.$site_url.$url.' - Already exists for resource '.$resource->get('id').'<br>';
                            $this->log($logMessage);
                        }
                    }
                }
                // reset the urls in properties
                unset($properties['urls']);
                $resource->setProperties($properties, 'stercseo');
                $resource->save();
            }
        }

        if ($count == 0) {
            $this->log('No 301 redirect urls found in resource properties.');
        } else {
            $this->log($count.' Redirect urls migrated from resource properties to seoUrl object.');
        }

        return $this->outputArray(array(), $count);
    }

    private function log($message)
    {
        $logTarget = array(
            'target' => 'FILE',
            'options' => array(
                'filepath' => $this->modx->stercseo->config['assetsPath'],
                'filename' => 'migration.log'
            )
        );
        $this->modx->log(MODx::LOG_LEVEL_ERROR, $message, $logTarget);
        return;
    }
}
return 'StercSeoMigrateProcessor';
