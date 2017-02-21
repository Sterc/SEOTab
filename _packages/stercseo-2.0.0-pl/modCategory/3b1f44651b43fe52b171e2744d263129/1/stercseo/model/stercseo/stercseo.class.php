<?php
/**
 * StercSEO
 *
 * Copyright 2013 by Sterc <modx@sterc.nl>
 *
 * This file is part of StercSEO.
 *
 * StercSEO is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * StercSEO is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * StercSEO; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package stercseo
 */
/**
 * This file is the main class file for StercSEO.
 *
 *
 * @author Sterc <modx@sterc.nl>
 *
 * @package stercseo
 */
class StercSEO
{

    /**
     * @access protected
     * @var array A collection of preprocessed chunk values.
     */
    protected $chunks = array();
    /**
     * @access public
     * @var modX A reference to the modX object.
     */
    public $modx = null;
    /**
     * @access public
     * @var array A collection of properties to adjust StercSEO behaviour.
     */
    public $config = array();
    /**
     * @access public
     * @var modTemplateVar A reference to the stercseo TV which is used to store linked resources.
     * The linked resources are stored using this syntax: [contextKey1]:[resourceId1];[contextKey2]:[resourceId2]
     * Example: web:1;de:4;es:7;fr:10
     */
    public $stercseoTv = null;

    public $defaults = array();

    /**
     * The StercSEO Constructor.
     *
     * This method is used to create a new StercSEO object.
     *
     * @param modX &$modx A reference to the modX object.
     * @param array $config A collection of properties that modify StercSEO
     * behaviour.
     * @return StercSEO A unique StercSEO instance.
     */
    public function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('stercseo.core_path', null, $modx->getOption('core_path').'components/stercseo/');
        $assetsPath = $this->modx->getOption('stercseo.assets_path', null, $this->modx->getOption('assets_path') . 'components/stercseo/');
        $assetsUrl = $this->modx->getOption('stercseo.assets_url', null, $modx->getOption('assets_url').'components/stercseo/');
        $connectorUrl = $assetsUrl.'connector.php';

        $this->config = array_merge(array(
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl.'css/',
            'jsUrl' => $assetsUrl.'js/',
            'imagesUrl' => $assetsUrl.'images/',

            'connectorUrl' => $connectorUrl,

            'corePath' => $corePath,
            'modelPath' => $corePath.'model/',
            'chunksPath' => $corePath.'elements/chunks/',
            'chunkSuffix' => '.chunk.tpl',
            'snippetsPath' => $corePath.'elements/snippets/',
            'processorsPath' => $corePath.'processors/',
            'templatesPath' => $corePath.'templates/',
        ), $config);
        $this->modx->addPackage('stercseo', $this->config['modelPath']);
        /* load stercseo lexicon */
        if ($this->modx->lexicon) {
            $this->modx->lexicon->load('stercseo:default');
        }

        $this->defaults = array(
            'index' => $this->modx->getOption('stercseo.index', null, '1'),
            'follow' => $this->modx->getOption('stercseo.follow', null, '1'),
            'search' => $this->modx->getOption('stercseo.search', null, '1'),
            'sitemap' => $this->modx->getOption('stercseo.sitemap', null, '1'),
            'changefreq' => $this->modx->getOption('stercseo.changefreq', null, 'weekly'),
            'priority' => $this->modx->getOption('stercseo.priority', null, '0.5'),
        );
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = array(), $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->config)) {
                $option = $this->config[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }

    /**
     * Gets a Chunk and caches it; also falls back to file-based templates
     * for easier debugging.
     *
     * @access public
     * @param string $name The name of the Chunk
     * @param array $properties The properties for the Chunk
     * @return string The processed content of the Chunk
     */
    public function getChunk($name, $properties = array())
    {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->_getTplChunk($name);
            if (empty($chunk)) {
                $chunk = $this->modx->getObject('modChunk', array('name' => $name), true);
                if ($chunk == false) {
                    return false;
                }
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    /**
     * Returns a modChunk object from a template file.
     *
     * @access private
     * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
     * @param string $postFix
     * @return modChunk/boolean Returns the modChunk object if found, otherwise
     * false.
     */
    private function _getTplChunk($name, $postFix = '.chunk.tpl')
    {
        $chunk = false;
        $f = $this->config['chunksPath'].strtolower($name).$postFix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            /** @var modChunk $chunk */
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name', $name);
            $chunk->setContent($o);
        }
        return $chunk;
    }

    public function sitemap($contextKey = array('web'), $rowTpl = '', $outerTpl = '', $allowSymlinks = '')
    {
        $c = $this->modx->newQuery('modResource');
        $c->where(array(
            array('context_key:IN' => $contextKey, 'published' => 1, 'deleted' => 0),
            array('properties:LIKE' => '%"sitemap":"1"%', 'OR:properties:LIKE' => '%"sitemap":null%', 'OR:properties:IS' => null)
        ));
        if (!$allowSymlinks) {
            $c->where(array('class_key:!=' => 'modSymLink'));
        }
        $resources = $this->modx->getCollection('modResource', $c);
        foreach ($resources as $resource) {
            $properties = $resource->getProperties('stercseo');
            $editedon = $resource->get('editedon');
            $createdon = $resource->get('createdon');
            $output .= $this->getChunk($rowTpl, array(
                'url' => $this->modx->makeUrl($resource->get('id'), '', '', 'full'),
                'lastmod' => date('c', strtotime((($editedon > 0) ? $editedon : $createdon))),
                'changefreq' => (!empty($properties['changefreq']) ? $properties['changefreq'] : $this->defaults['changefreq']),
                'priority' => (!empty($properties['priority']) ? $properties['priority'] : $this->defaults['priority']),
            ));
        }
        return $this->getChunk($outerTpl, array('wrapper' => $output));
    }

    public function isAllowed($context_key)
    {
        $allowedContexts = $this->modx->getOption('stercseo.allowed_contexts');
        if ($allowedContexts && !empty($allowedContexts)) {
            if (in_array($context_key, explode(',', $allowedContexts))) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function checkUserAccess($user = false)
    {
        if (!$user) {
            $user = $this->modx->getUser();
        }
        $exclUsergroups = explode(',', $this->modx->getOption('stercseo.hide_from_usergroups'));
        if (!empty($exclUsergroups)) {
            foreach ($exclUsergroups as $exclUserGroup) {
                if ($user->isMember($exclUserGroup)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function redirectMigrationStatus()
    {
        $migrationStatus = true;
        $migrationStatusSetting = $this->modx->getObject('modSystemSetting', array(
            'key'       => 'stercseo.migration_status',
            'namespace' => 'stercseo_custom',
            'value'     => '1'
        ));
        if (!$migrationStatusSetting) {
            // Search for modResources with an URL's array within the properties
            // If matches are found, it means the migration hasn't finished yet (false)
            $resource = $this->modx->getObject('modResource', array(
                'context_key:!='    => 'mgr',
                'properties:LIKE'   => '%urls":[{"url":"%'
            ));
            $migrationStatus = (is_object($resource)) ? false : true;

            // save new migration status
            $migrationStatusSetting = $this->modx->getObject('modSystemSetting', array('key' => 'stercseo.migration_status', 'namespace' => 'stercseo_custom'));
            if (!$migrationStatusSetting) {
                // if there is no system setting, create it
                $migrationStatusSetting = $this->modx->newObject('modSystemSetting');
                $migrationStatusSetting->set('key', 'stercseo.migration_status');
                $migrationStatusSetting->set('namespace', 'stercseo_custom');
            }
            $migrationStatusSetting->set('value', (int)$migrationStatus);
            $migrationStatusSetting->save();
        }
        return $migrationStatus;
    }
}
