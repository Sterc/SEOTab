<?php
/**
 * SEO Tab
 *
 * Copyright 2013 by Sterc internet & marketing <modx@sterc.nl>
 *
 * This file is part of SEO Tab.
 *
 * SEO Tab is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * SEO Tab is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * SEO Tab; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package stercseo
 */
/**
 * SEO Tab Plugin
 *
 *
 * Events:
 * OnDocFormPrerender,OnDocFormSave,OnHandleRequest,OnPageNotFound, OnResourceDuplicate, OnEmptyThrash, OnResourceBeforeSort
 *
 * @author Sterc internet & marketing <modx@sterc.nl>
 *
 * @package stercseo
 *
 */
$stercseo = $modx->getService('stercseo', 'StercSEO', $modx->getOption('stercseo.core_path', null, $modx->getOption('core_path').'components/stercseo/').'model/stercseo/', array());

if (!($stercseo instanceof StercSEO)) {
    return;
}

switch ($modx->event->name) {
    case 'OnDocFormPrerender':
        if (!$stercseo->checkUserAccess()) {
            return;
        }

        $resource =& $modx->event->params['resource'];
        if ($resource) {
            //First check if SEO Tab is allowed in this context
            if (!$stercseo->isAllowed($resource->get('context_key'))) {
                return;
            }
            $properties = $resource->getProperties('stercseo');
            $properties['searchable'] = $resource->get('searchable');
            $urls = $modx->getCollection('seoUrl', array('resource' => $resource->get('id')));
        }

        if (empty($properties)) {
            $properties = array(
                'index' => $modx->getOption('stercseo.index', null, '1'),
                'follow' => $modx->getOption('stercseo.follow', null, '1'),
                'sitemap' => $modx->getOption('stercseo.sitemap', null, '1'),
                'priority' => $modx->getOption('stercseo.priority', null, '0.5'),
                'changefreq' => $modx->getOption('stercseo.changefreq', null, 'weekly'),
                'searchable' => $modx->getOption('search_default', null, '1')
            );
        }
        $properties['urls'] = '';
        // Fetch urls from seoUrl collection
        if ($urls && is_object($urls)) {
            foreach ($urls as $url) {
                $properties['urls'][]['url'] = urldecode($url->get('url'));
            }
        }

        $modx->regClientStartupHTMLBlock('<script type="text/javascript">
        Ext.onReady(function() {
            StercSEO.config = '.$modx->toJSON($stercseo->config).';
            StercSEO.config.connector_url = "'.$stercseo->config['connectorUrl'].'";
            StercSEO.record = '.$modx->toJSON($properties).';
        });
        </script>');
        $version = $modx->getVersionData();

        /* include CSS and JS*/
        if ($version['version'] == 2 && $version['major_version'] == 2) {
            $modx->regClientCSS($stercseo->config['cssUrl'].'stercseo.css');
        }
        $modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/stercseo.js');
        $modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/sections/resource.js');
        $modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/widgets/resource.grid.js');
        $modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/widgets/resource.vtabs.js');

        //add lexicon
        $modx->controller->addLexiconTopic('stercseo:default');

        break;

    case 'OnBeforeDocFormSave':
        $oldResource = ($mode == 'upd') ? $modx->getObject('modResource', $resource->get('id')) : $resource;
        if (!$stercseo->isAllowed($oldResource->get('context_key'))) {
            return;
        }
        $properties = $oldResource->getProperties('stercseo');

        if (isset($_POST['urls'])) {
            $urls = $modx->fromJSON($_POST['urls']);
            foreach ($urls as $url) {
                $check = $modx->getObject('seoUrl', array( 'url' => urlencode($url['url']), 'resource' => $oldResource->get('id'), 'context_key' => $oldResource->get('context_key')));
                if (!$check) {
                    $redirect = $modx->newObject('seoUrl');
                    $data = array(
                        'url' => urlencode($url['url']),
                        'resource' => $oldResource->get('id'),
                        'context_key' => $oldResource->get('context_key'),
                    );
                    $redirect->fromArray($data);
                    $redirect->save();
                }
            }
        }

        if ($mode == 'upd') {
            $newProperties = array(
                'index' => (isset($_POST['index']) ? $_POST['index'] : $properties['index']),
                'follow' => (isset($_POST['follow']) ? $_POST['follow'] : $properties['follow']),
                'sitemap' => (isset($_POST['sitemap']) ? $_POST['sitemap'] : $properties['sitemap']),
                'priority' => (isset($_POST['priority']) ? $_POST['priority'] : $properties['priority']),
                'changefreq' => (isset($_POST['changefreq']) ? $_POST['changefreq'] : $properties['changefreq'])
            );
        } else {
            $newProperties = array(
                'index' => (isset($_POST['index']) ? $_POST['index'] : $modx->getOption('stercseo.index', null, '1')),
                'follow' => (isset($_POST['follow']) ? $_POST['follow'] : $modx->getOption('stercseo.follow', null, '1')),
                'sitemap' => (isset($_POST['sitemap']) ? $_POST['sitemap'] : $modx->getOption('stercseo.sitemap', null, '1')),
                'priority' => (isset($_POST['priority']) ? $_POST['priority'] : $modx->getOption('stercseo.priority', null, '0.5')),
                'changefreq' => (isset($_POST['changefreq']) ? $_POST['changefreq'] : $modx->getOption('stercseo.changefreq', null, 'weekly'))
            );
        }

        // If uri is changed or alias (with freeze uri off) has changed, add a new redirect
        if (($oldResource->get('uri') != $resource->get('uri') ||
                ($oldResource->get('uri_override') == 0 && $oldResource->get('alias') != $resource->get('alias'))) &&
            $oldResource->get('uri') != '') {
            $url = urlencode($modx->getOption('site_url').$oldResource->get('uri'));
            if (!$modx->getCount('seoUrl', array('url' => $url))) {
                $data = array(
                    'url' => $url,
                    'resource' => $resource->get('id'),
                    'context_key' => $resource->get('context_key'),
                );
                $redirect = $modx->newObject('seoUrl');
                $redirect->fromArray($data);
                $redirect->save();
            }
            // Recursive set all children resources as redirects
            if ($modx->getOption('use_alias_path')) {
                $resourceOldBasePath = $oldResource->getAliasPath($oldResource->get('alias'), $oldResource->toArray() + array('isfolder' => 1));
                $resourceNewBasePath = $resource->getAliasPath($resource->get('alias'), $resource->toArray() + array('isfolder' => 1));
                $childResources = $modx->getIterator('modResource', array(
                    'uri:LIKE' => $resourceOldBasePath . '%',
                    'uri_override' => '0',
                    'published' => '1',
                    'deleted' => '0',
                    'context_key' => $resource->get('context_key')
                ));
                foreach ($childResources as $childResource) {
                    $url = urlencode($modx->getOption('site_url').$childResource->get('uri'));
                    if (!$modx->getCount('seoUrl', array('url' => $url))) {
                        $data = array(
                            'url' => $url,
                            'resource' => $childResource->get('id'),
                            'context_key' => $resource->get('context_key'),
                        );
                        $redirect = $modx->newObject('seoUrl');
                        $redirect->fromArray($data);
                        $redirect->save();
                    }
                }
            }
        }
        $resource->setProperties($newProperties, 'stercseo');
        break;

    case 'OnDocFormSave':
        if (!$stercseo->isAllowed($resource->context_key)) {
            return;
        }

        $url       = urlencode($modx->makeUrl($resource->id, $resource->context_key, '', 'full'));
        $urlExists = $modx->getObject('seoUrl', array(
            'url'         => $url,
            'context_key' => $resource->context_key
        ));

        if ($urlExists) {
            $modx->removeObject('seoUrl', array(
                'url'         => $url,
                'context_key' => $resource->context_key
            ));
        }
        break;

    case 'OnLoadWebDocument':
        if ($modx->resource) {
            if (!$stercseo->isAllowed($modx->resource->get('context_key'))) {
                return;
            }
            $properties = $modx->resource->getProperties('stercseo');
            if (empty($properties)) {
                // Properties not available
                // This means an this resource has nog SEO Tab properties, which means it is a pre-SEO Tab resource
                // Fallback to system defaults
                $properties = array(
                    'index' => $modx->getOption('stercseo.index', null, 1),
                    'follow' => $modx->getOption('stercseo.follow', null, 1)
                );
            }
            $metaContent = array(
                (int)$properties['index'] ? 'index' : 'noindex',
                (int)$properties['follow'] ? 'follow' : 'nofollow'
            );

            $modx->setPlaceholder('seoTab.robotsTag', implode(',', $metaContent));
        }
        break;

    case 'OnPageNotFound':
        $options      = array();
        $url          = ($_SERVER['HTTPS'] ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $convertedUrl = urlencode($url);

        $w = array(
            'url' => $convertedUrl
        );

        if ($modx->getOption('stercseo.context-aware-alias', null, '0')) {
            $w['context_key'] = $modx->context->key;
        }

        $alreadyExists = $modx->getObject('seoUrl', $w);

        if (isset($alreadyExists) && ($modx->context->key !== $alreadyExists->get('context_key'))) {
            $q = $modx->newQuery('modContextSetting');
            $q->where(array(
                'context_key' => $alreadyExists->get('context_key'),
                'key'         => 'site_url'
            ));
            $q->prepare();

            $siteUrl = $modx->getObject('modContextSetting', $q);
            if ($siteUrl) {
                $options['site_url'] = $siteUrl->get('value');
            }
        }

        if ($alreadyExists) {
            $url = $modx->makeUrl($alreadyExists->get('resource'), $alreadyExists->get('context_key'), '', 'full', $options);

            $modx->sendRedirect($url, 0, 'REDIRECT_HEADER', 'HTTP/1.1 301 Moved Permanently');
        }
        break;

    case 'OnResourceBeforeSort':
        list($sourceCtx, $resource) = explode('_', $modx->getOption('source', $_POST));
        list($targetCtx, $target) = explode('_', $modx->getOption('target', $_POST));
        switch ($modx->getOption('point', $_POST)) {
            case 'above':
            case 'below':
                $tmpRes = $modx->getObject('modResource', $target);
                if ($tmpRes) {
                    $target = $tmpRes->get('parent');
                    unset($tmpRes);
                }
                break;
        }
        $oldResource = $modx->getObject('modResource', $resource);
        $resource = $modx->getObject('modResource', $resource);
        if ($oldResource && $resource) {
            $resource->set('parent', $target);
            $resource->set('uri', '');
            $uriChanged = false;
            if ($oldResource->get('uri') != $resource->get('uri') && $oldResource->get('uri') != '') {
                $uriChanged = true;
            }

            // Recursive set redirects for drag/dropped resource, and its children (where uri_override is not set)
            if ($uriChanged && $modx->getOption('use_alias_path')) {
                $oldResource->set('isfolder', true);
                $resourceOldBasePath = $oldResource->getAliasPath(
                    $oldResource->get('alias'),
                    $oldResource->toArray()
                );
                $resourceNewBasePath = $resource->getAliasPath(
                    $resource->get('alias'),
                    $resource->toArray() + array('isfolder' => 1)
                );
                $cond = $modx->newQuery('modResource');
                $cond->where(array(
                    array(
                        'uri:LIKE' => $resourceOldBasePath . '%',
                        'OR:id:=' => $oldResource->id
                    ),
                    'uri_override' => '0',
                    'published' => '1',
                    'deleted' => '0',
                    'context_key' => $resource->get('context_key')
                ));

                $ctx = $modx->getContext($resource->get('context_key'));
                $site_url = $ctx->getOption('site_url', '', $modx->getOption('site_url'));

                $childResources = $modx->getIterator('modResource', $cond);
                foreach ($childResources as $childResource) {
                    $url = urlencode($site_url . $childResource->get('uri'));
                    if (!$modx->getCount('seoUrl', array('url' => $url))) {
                        $data = array(
                            'url' => $url,
                            'resource' => $childResource->get('id'),
                            'context_key' => $targetCtx
                        );
                        $redirect = $modx->newObject('seoUrl');
                        $redirect->fromArray($data);
                        $redirect->save();
                    }
                }
            } // endif $uriChanged
        } // endif $oldResource && $resource
        break;

    case 'OnResourceDuplicate':
        if (!$stercseo->isAllowed($newResource->get('context_key'))) {
            return;
        }
        $props = $newResource->getProperties('stercseo');
        $newResource->setProperties($props, 'stercseo');
        $newResource->save();
        break;

    case 'OnManagerPageBeforeRender':
        if (!$stercseo->checkUserAccess()) {
            return;
        }
        // If migration status is false, show migrate alert message bar in manager
        if (!$stercseo->redirectMigrationStatus()) {
            $modx->regClientStartupHTMLBlock($stercseo->getChunk('migrate/alert', array('message' => $modx->lexicon('stercseo.migrate_alert'))));
            $modx->regClientCSS($stercseo->config['cssUrl'].'migrate.css');
        }
        break;

    case 'OnEmptyTrash':
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $modx->removeCollection('seoUrl', array(
                    'resource' => $id
                ));
            }
        }
}
return;
