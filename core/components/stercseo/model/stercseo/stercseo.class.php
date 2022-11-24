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
     * Current namespace.
     *
     * @var string
     */
    protected $namespace = 'stercseo';

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

    /**
     * The working context for this request. This is set by calling $this->setWorkingContext
     * and needs to be an initialised context. Used for getting context-specific settings for example.
     *
     * @var \modContext
     */
    public $wctx;

    public $defaults = array();

    /* Holds arrays of images for image sitemap. */
    public $images = array();

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
     * Grabs context specific settings from the current namespace, and loads them into $this->config.
     * Also returns the newly overridden values in an array.
     *
     * @param $contextKey
     * @return array
     */
    public function loadContextSettingsFromNamespace($contextKey)
    {
        $config = array();

        $c = $this->modx->newQuery('modContextSetting');
        $c->where(array(
            'context_key' => $contextKey,
            'key:LIKE' => $this->namespace . '.%'
        ));
        $c->limit(0);

        /** @var \modSystemSetting[] $iterator */
        $iterator = $this->modx->getIterator('modContextSetting', $c);
        foreach ($iterator as $setting) {
            $key = $setting->get('key');
            $key = substr($key, strlen($this->namespace) + 1);
            $config[$key] = $setting->get('value');
        }
        $this->config = array_merge($this->config, $config);

        return $config;
    }

    /**
     * Set the internal working context for grabbing context-specific options.
     *
     * @param $key
     * @return bool|\modContext
     */
    public function setWorkingContext($key)
    {
        if ($key instanceof \modResource) {
            $key = $key->get('context_key');
        }

        if (empty($key)) {
            return false;
        }

        $this->wctx = $this->modx->getContext($key);
        if (!$this->wctx) {
            $this->modx->log(\modX::LOG_LEVEL_ERROR, 'Error loading working context ' . $key, '', __METHOD__, __FILE__,
                __LINE__);

            return false;
        }

        $this->loadContextSettingsFromNamespace($key);

        return $this->wctx;
    }

    /**
     * Grabs a setting value by its key, looking at the current working context (see setWorkingContext) first.
     *
     * @param $key
     * @param null $options
     * @param null $default
     * @param bool $skipEmpty
     *
     * @return mixed
     */
    public function getOption($key, $options = null, $default = null, $skipEmpty = false)
    {
        if ($this->wctx) {
            $value = $this->wctx->getOption($key, $default, $options);
            if ($skipEmpty && $value === '') {
                return $default;
            } else {
                return $value;
            }
        }

        return $this->modx->getOption($key, $options, $default, $skipEmpty);
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

    /**
     * Generate XML sitemap.
     *
     * @param array  $contextKey
     * @param string $allowSymlinks
     * @param array  $options
     *
     * @return string
     * @internal param string $type
     * @internal param string $templates
     *
     */
    public function sitemap($contextKey = array('web'), $allowSymlinks = '', $options = array())
    {
        $outerTpl = $options['outerTpl'];
        $rowTpl   = $options['rowTpl'];

        $c = $this->buildQuery($contextKey, $allowSymlinks, $options);
        $resources = $this->modx->getCollection('modResource', $c);

        if ($options['type'] === 'index') {
            $outerTpl = $options['indexOuterTpl'];
            $rowTpl   = $options['indexRowTpl'];
        }

        if ($options['type'] === 'images') {
            return $this->sitemapImages($contextKey, $resources, $options);
        }

        /* If resources should be displayed based upon parent/ultimate parent properties. */
        $sitemapDependsOnUltimateParent = (bool) $this->getOption('stercseo.xmlsitemap.dependent_ultimateparent', null, false);
        if ($sitemapDependsOnUltimateParent) {
            $resources = $this->transformArray($resources);
            $resources = $this->filterResourcesByParentProperties($resources);
        }

        $output = '';
        foreach ($resources as $resource) {
            $properties = $resource->getProperties('stercseo');
            $lastmod    = $this->getLastModTime($options['type'], $resource);

            $output .= $this->getChunk(
                $rowTpl,
                array_merge(
                    $resource->toArray(),
                    array(
                        'url'        => $this->modx->makeUrl($resource->get('id'), '', '', 'full'),
                        'alternates' => $this->getAlternateLinks($resource, $options),
                        'lastmod'    => date('c', $lastmod),
                        'changefreq' => (!empty($properties['changefreq']) ? $properties['changefreq'] : $this->defaults['changefreq']),
                        'priority'   => (!empty($properties['priority']) ? $properties['priority'] : $this->defaults['priority']),
                    )
                )
            );
        }

        return $this->getChunk($outerTpl, array('wrapper' => $output));
    }

    /**
     * Transform array so it is indexed by resource id.
     *
     * @param $resources
     * @return array
     */
    public function transformArray($resources)
    {
        $array = [];

        if  ($resources) {
            foreach ($resources as $resource) {
                $array[$resource->get('id')] = $resource;
            }
        }

        return $array;
    }

    public function filterResourcesByParentProperties($resources)
    {
        foreach ($resources as $resourceId => $resource) {
            if ($resource->get('parent') > 0) {
                if (!array_key_exists($resource->get('parent'), $resources)) {
                    unset($resources[$resource->get('id')]);
                }
            }
        }

        return $resources;
    }

    /**
     * Adds alternative language links to sitemap XML.
     *
     * @param $resource
     * @param $options
     * @return string
     */
    public function getAlternateLinks($resource, $options)
    {
        /* Return if babel model path does not exist */
        $babelModelPath = $this->modx->getOption('babel.core_path', null, $this->modx->getOption('core_path') . 'components/babel/').'model/babel/';
        if (!file_exists($babelModelPath)) {
            return '';
        }

        /* Include current resource. */
        $babel = &$this->modx->getService(
            'babel',
            'Babel',
            $this->modx->getOption(
                'babel.core_path',
                null,
                $this->modx->getOption('core_path') . 'components/babel/'
            ) . 'model/babel/'
        );

        /* Return if babel is not installed or the alternate links option is set to false or type is index or images. */
        if (!$babel ||
            (int) $this->modx->getOption('stercseo.xmlsitemap.babel.add_alternate_links') !== 1 ||
            (isset($options['type']) && in_array($options['type'], array('index', 'images'), true))
        ) {
            return '';
        }

        $alternates   = [];
        $translations = $babel->getLinkedResources($resource->get('id'));
        foreach ($translations as $contextKey => $resourceId) {
            $this->modx->switchContext($contextKey);

            $alternates[] = $this->getChunk($options['alternateTpl'], array(
                'cultureKey' => $this->modx->getOption('cultureKey', ['context_key' => $contextKey], 'en'),
                'url' => $this->modx->makeUrl($resourceId, '', '', 'full')
            ));
        }

        return implode(PHP_EOL, $alternates);
    }

    /**
     * Get last modification time for a sitemap type of a specific resource.
     *
     * @param $type
     * @param $resource
     *
     * @return int
     */
    public function getLastModTime($type, $resource)
    {
        $lastmod = 0;

        if ($type === 'index') {
            $content = $resource->get('content');

            preg_match_all('/\[\[[^[]*]]/', $content, $matches);
            if (count($matches) > 0) {
                foreach ($matches as $match) {

                    $match = trim($match[0], '[]!');
                    if (0 === strpos($match, 'StercSeoSiteMap')) {
                        /* Get snippet parameter values. */
                        preg_match('/&type=`(.*)`/', $match, $type);
                        preg_match('/&templates=`(.*)`/', $match, $templates);
                        preg_match('/&allowSymlinks=`(.*)`/', $match, $allowSymlinks);
                        preg_match('/&contexts=`(.*)`/', $match, $contexts);

                        $type          = (isset($type[1])) ? $type[1] : '';
                        $allowSymlinks = (isset($allowSymlinks[1])) ? $allowSymlinks[1] : 0;
                        $contexts      = (isset($contexts[1])) ? explode(',',str_replace(' ', '', $contexts[1])) : array($this->modx->resource->get('context_key'));
                        $templates     = (isset($templates[1])) ? $templates[1] : '';

                        /* If the sitemap type is images, set the last mod time to current time. */
                        if ($type === 'images') {
                            $lastmod = time();

                            continue;
                        }

                        $c = $this->buildQuery($contexts, $allowSymlinks, array('type' => $type, 'templates' => $templates));

                        $resources = $this->modx->getIterator('modResource', $c);
                        if ($resources) {
                            foreach($resources as $resource) {
                                $createdon       = $resource->get('createdon');
                                $editedon        = $resource->get('editedon');
                                $resourceLastmod = strtotime((($editedon > 0) ? $editedon : $createdon));

                                if ($resourceLastmod > $lastmod) {
                                    $lastmod = $resourceLastmod;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $editedon  = $resource->get('editedon');
            $createdon = $resource->get('createdon');

            $lastmod = strtotime((($editedon > 0) ? $editedon : $createdon));
        }

        return $lastmod;
    }

    /**
     * Build query to retrieve resources.
     *
     * @param $contextKey
     * @param $allowSymlinks
     * @param $options
     *
     * @return mixed
     */
    public function buildQuery($contextKey, $allowSymlinks, $options) {
        $c = $this->modx->newQuery('modResource');
        $c->where(
            array(
                array(
                    'context_key:IN'         => $contextKey,
                    'published'              => 1,
                    'deleted'                => 0
                )
            )
        );

        /* Exclude pages with noindex and nofollow. */
        $c->where(
            array(
                'properties:LIKE'    => '%"index":"1"%',
                'OR:properties:LIKE' => '%"follow":"1"%'
            )
        );

        if ($options['type'] !== 'index') {
            $c->where(
                array('properties:LIKE' => '%"sitemap":"1"%', 'OR:properties:LIKE' => '%"sitemap":null%', 'OR:properties:IS' => null)
            );
        }

        if (!$allowSymlinks) {
            $c->where(array('class_key:!=' => 'modSymLink'));
        }

        if ($options['type'] === 'index') {
            $parent = $this->modx->resource->get('id');
            $c->where(array('parent' => $parent));
        }

        if (!empty($options['templates'])) {
            $notAllowedTemplates = array();
            $allowedTemplates    = array();
            $this->parseTemplatesParam($options['templates'], $notAllowedTemplates, $allowedTemplates);

            if (count($notAllowedTemplates) > 0) {
                $c->where(array('template:NOT IN' => $notAllowedTemplates));
            }

            if (count($allowedTemplates) > 0) {
                $c->where(array('template:IN' => $allowedTemplates));
            }
        }

        return $c;
    }

    /**
     * Generate sitemap for images.
     *
     * @param $contextKey
     * @param $resources
     * @param $options
     *
     * @return string
     */
    public function sitemapImages($contextKey, $resources, $options)
    {
        $usedMediaSourceIds = array();

        $resourceIds = array();
        if ($resources) {
            foreach ($resources as $resource) {
                $resourceIds[] = $resource->get('id');
            }
        }

        /* Get all image tvs of the retrieved resources and return all image tv's chained to resource. */
        $q = $this->modx->newQuery('modTemplateVar');
        $q->select('modTemplateVar.*, Value.*');
        $q->leftJoin('modTemplateVarResource', 'Value', array('modTemplateVar.id = Value.tmplvarid'));
        $q->where(
            array(
                'Value.contentid:IN'     => $resourceIds,
                'Value.value:!='         => '',
                'modTemplateVar.type:IN' => array('image','migx')
            )
        );

        $imageTVs = $this->modx->getIterator('modTemplateVar', $q);
        if ($imageTVs) {
            $q = $this->modx->newQuery('sources.modMediaSourceElement');
            $q->where(
                array(
                    'object_class'   => 'modTemplateVar',
                    'context_key:IN' => $contextKey
                )
            );

            $getTVSources = $this->modx->getIterator('sources.modMediaSourceElement', $q);
            $tvSources    = array();
            if ($getTVSources) {
                foreach ($getTVSources as $tvSource) {
                    $tvSources[$tvSource->get('object')] = $tvSource->get('source');
                }
            }

            foreach ($imageTVs as $imageTV) {
                $imageTV = $imageTV->toArray();
                $cid     = $imageTV['contentid'];

                if ($imageTV['type'] === 'migx') {
                    $this->getImagesValuesFromMIGX($cid, $imageTV, $tvSources);
                } else {
                    $this->images[$cid][] = array(
                        'id'     => $imageTV['id'],
                        'value'  => $imageTV['value'],
                        'source' => $tvSources[$imageTV['tmplvarid']]
                    );
                }

                /* Store used mediasource ID's in an array. */
                if (!in_array($tvSources[$imageTV['tmplvarid']], $usedMediaSourceIds)) {
                    $usedMediaSourceIds[] = $tvSources[$imageTV['tmplvarid']];
                }
            }
        }

        $output = '';
        if ($resources) {
            $mediasources = array();

            if (count($usedMediaSourceIds) > 0) {
                foreach ($usedMediaSourceIds as $mediaSourceId) {
                    $this->modx->loadClass('sources.modMediaSource');
                    $source = modMediaSource::getDefaultSource($this->modx, $mediaSourceId, false);
                    if ($source) {
                        $source->initialize();
                        /*
                         * CDN TV's are saved with full path, therefore only set full path for modFileMediaSource image tv types.
                         */
                        $url = ($source->get('class_key') === 'sources.modFileMediaSource') ? rtrim(MODX_SITE_URL, '/') . '/' . ltrim($source->getBaseUrl(), '/') : '';
                        $mediasources[$mediaSourceId] = array_merge(array('full_url' => $url), $source->toArray());
                    }
                }
            }

            foreach ($resources as $resource) {
                $imagesOutput = '';
                if (isset($this->images[$resource->get('id')])) {
                    foreach ($this->images[$resource->get('id')] as $image) {
                        /* Set correct full url for image based on context and mediasource. */
                        $image = $this->setImageUrl($mediasources, $image);

                        $imagesOutput .= $this->getChunk($options['imageTpl'], array(
                            'url' => $image['value']
                        ));
                    }

                    $output .= $this->getChunk($options['imagesRowTpl'], array(
                        'url'    => $this->modx->makeUrl($resource->get('id'), '', '', 'full'),
                        'images' => $imagesOutput
                    ));
                }
            }
        }

        return $this->getChunk($options['imagesOuterTpl'], array('wrapper' => $output));
    }

    /**
     * @param $cid
     * @param $imageTV
     * @param $tvSources
     *
     * @return bool
     */
    public function getImagesValuesFromMIGX($cid, $imageTV, $tvSources)
    {
        $imageFieldNames = array();

        $fields = array();
        if (!empty($imageTV['input_properties']['configs'])) {
            /* Load image fields from MIGX Config. */
            $getMigx = $this->modx->getService(
                'migx',
                'Migx',
                $this->modx->getOption('migx.core_path', null, $this->modx->getOption('core_path') . 'components/migx/') . 'model/migx/'
            );

            if (!($getMigx instanceof Migx)) {
                return false;
            }

            $migx = $this->modx->getObject('migxConfig', array('name' => $imageTV['input_properties']['configs']));
            if ($migx) {
                $migx     = $migx->toArray();
                $formtabs = json_decode($migx['formtabs'], true);
                $fields   = $formtabs[0]['fields'];
            }
        } else {
            $formtabs = json_decode($imageTV['input_properties']['formtabs'], true);
            if ($formtabs[0] && $formtabs[0]['fields']) {
                $fields = $formtabs[0]['fields'];
            }
        }

        if ($fields) {
            /* Check if MIGX contains images, then add field name to array to retrieve values for. */
            foreach ($fields as $field) {
                if ($field['inputTVtype'] === 'image') {
                    $imageFieldNames[] = $field['field'];
                }
            }

            /* Retrieve image values from MIGX values. */
            if (count($imageFieldNames) > 0) {
                $values = json_decode($imageTV['value'], true);
                if ($values) {
                    foreach ($values as $row) {
                        foreach ($imageFieldNames as $imageFieldName) {
                            if (!empty($row[$imageFieldName])) {
                                $this->images[$cid][] = [
                                    'id'     => $imageTV['id'],
                                    'value'  => $row[$imageFieldName],
                                    'source' => $tvSources[$imageTV['tmplvarid']]
                                ];
                            }
                        }
                    }
                }
            }
        }

        return true;
    }

    /**
     * Set the image URL based on related mediasource.
     *
     * @param $mediasources
     * @param $image
     *
     * @return mixed
     */
    public function setImageUrl($mediasources, $image)
    {
        if (array_key_exists($image['source'], $mediasources)) {
            $image['value'] = rtrim($mediasources[$image['source']]['full_url'], '/') . '/' . ltrim($image['value'], '/');
        }

        return $image;
    }

    /**
     * Parse templates parameter and set allowed and non-allowed templates as arrays.
     *
     * @param $templates
     * @param $notAllowedTemplates
     * @param $allowedTemplates
     */
    public function parseTemplatesParam($templates, &$notAllowedTemplates, &$allowedTemplates)
    {
        $templates = explode(',', $templates);
        foreach ($templates as $template) {
            $template = trim($template, ' ');
            $char     = substr($template, 0, 1);

            if ($char === '-') {
                $notAllowedTemplates[] = trim($template, '-');
            } else {
                $allowedTemplates[] = $template;
            }
        }
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
        $exclUsergroups = array_filter(explode(',', $this->modx->getOption('stercseo.hide_from_usergroups')));
        if (!empty($exclUsergroups)) {
            foreach ($exclUsergroups as $exclUserGroup) {
                if ($user->isMember($exclUserGroup)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function checkResourceAccess($id = 0)
    {
        if ($id) {
            $resources = array_filter(explode(',', $this->modx->getOption('stercseo.hide_for_resources')));
            if(!empty($resources) && in_array($id, $resources)) {
                return false;
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

    /**
     * When saving a resource this checks if a redirect URL already exists for the provided freeze URI.
     *
     * @param $resource
     * @return bool
     */
    public function checkIfFreezeUriExistsAsRedirect($resource)
    {
        if ($resource->get('uri_override') === 1) {
            $siteUrl = $this->getOption('site_url', '', $this->modx->getOption('site_url'));
            $url     = str_replace(array('http://', 'https://'), '', $siteUrl . $resource->get('uri'));

            $query = $this->modx->newQuery('seoUrl');
            $query->where(array(
                array(
                    'url' => urlencode('http://' . $url)
                ),
                array(
                    'url' => urlencode('https://' . $url)
                )
            ), xPDOQuery::SQL_OR);

            $query->where(array('context_key' => $resource->get('context_key')));

            $count = $this->modx->getCount('seoUrl', $query);
            if ($count > 0) {
                $this->modx->event->output(
                    $this->modx->lexicon(
                        'stercseo.resource.freeze_uri.redirect_exists',
                        array(
                            'uri' => $siteUrl . $resource->get('uri')
                        )
                    )
                );
                return false;
            }
        }
    }
}
