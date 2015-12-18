<?php
/**
 * StercSEO
 *
 * Copyright 2013 by Sterc internet & marketing <modx@sterc.nl>
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
 * StercSEO Plugin
 *
 *
 * Events:
 * OnDocFormPrerender,OnDocFormSave,OnHandleRequest,OnPageNotFound
 *
 * @author Sterc internet & marketing <modx@sterc.nl>
 *
 * @package stercseo
 *
 */
$stercseo = $modx->getService('stercseo','StercSEO',$modx->getOption('stercseo.core_path',null,$modx->getOption('core_path').'components/stercseo/').'model/stercseo/',array());

if (!($stercseo instanceof StercSEO)) return;

switch ($modx->event->name) {
	case 'OnDocFormPrerender':
		$resource =& $modx->event->params['resource'];
		if($resource){
			//First check if SEOTab is allowed in this context
			if(!$stercseo->isAllowed($resource->get('context_key'))) return;
			$properties = $resource->getProperties('stercseo');
		}
		if(empty($properties)){
			$properties = array(
				'index' => $modx->getOption('stercseo.index', null, '1'),
				'follow' => $modx->getOption('stercseo.follow', null, '1'),
				'sitemap' => $modx->getOption('stercseo.sitemap', null, '1'),
				'priority' => $modx->getOption('stercseo.priority', null, '0.5'),
				'changefreq' => $modx->getOption('stercseo.changefreq', null, 'weekly'),
				//'urls' => $modx->fromJSON($_POST['urls'])
			);
		}
		//$output .= '<div id="stercseo-box">'.$errorMessage.$outputLanguageItems.'</div>';
		//$modx->event->output($output);
		$modx->regClientStartupHTMLBlock('<script type="text/javascript">
        Ext.onReady(function() {
            StercSEO.config = '.$modx->toJSON($stercseo->config).';
            StercSEO.config.connector_url = "'.$stercseo->config['connectorUrl'].'";
            StercSEO.record = '.$modx->toJSON($properties).';
        });
        </script>');
	    $version = $modx->getVersionData();

		/* include CSS and JS*/
		if($version['version'] == 2 && $version['major_version'] == 2){
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
	        $oldResource = ($mode == 'upd') ? $modx->getObject('modResource',$resource->get('id')) : $resource;
			if(!$stercseo->isAllowed($oldResource->get('context_key'))) return;
			$properties = $oldResource->getProperties('stercseo');
			if($_POST['urls'] != 'false' && isset($_POST['urls'])){
				if($mode == 'upd'){
					$newProperties = array(
						'index' => (isset($_POST['index']) ? $_POST['index'] : $properties['index']),
						'follow' => (isset($_POST['follow']) ? $_POST['follow'] : $properties['follow']),
						'sitemap' => (isset($_POST['sitemap']) ? $_POST['sitemap'] : $properties['sitemap']),
						'priority' => (isset($_POST['priority']) ? $_POST['priority'] : $properties['priority']),
						'changefreq' => (isset($_POST['changefreq']) ? $_POST['changefreq'] : $properties['changefreq']),
						'urls' => $modx->fromJSON($_POST['urls'])
					);
				}else{
					$newProperties = array(
						'index' => (isset($_POST['index']) ? $_POST['index'] : $modx->getOption('stercseo.index', null, '1')),
						'follow' => (isset($_POST['follow']) ? $_POST['follow'] : $modx->getOption('stercseo.follow', null, '1')),
						'sitemap' => (isset($_POST['sitemap']) ? $_POST['sitemap'] : $modx->getOption('stercseo.sitemap', null, '1')),
						'priority' => (isset($_POST['priority']) ? $_POST['priority'] : $modx->getOption('stercseo.priority', null, '0.5')),
						'changefreq' => (isset($_POST['changefreq']) ? $_POST['changefreq'] : $modx->getOption('stercseo.changefreq', null, 'weekly')),
						'urls' => $modx->fromJSON($_POST['urls'])
					);
				}
			}else{
			   	if($mode == 'upd'){
					$newProperties = array(
						'index' => (isset($_POST['index']) ? $_POST['index'] : $properties['index']),
						'follow' => (isset($_POST['follow']) ? $_POST['follow'] : $properties['follow']),
						'sitemap' => (isset($_POST['sitemap']) ? $_POST['sitemap'] : $properties['sitemap']),
						'priority' => (isset($_POST['priority']) ? $_POST['priority'] : $properties['priority']),
						'changefreq' => (isset($_POST['changefreq']) ? $_POST['changefreq'] : $properties['changefreq']),
						'urls' => $properties['urls']
					);
				}else{
					$newProperties = array(
						'index' => (isset($_POST['index']) ? $_POST['index'] : $modx->getOption('stercseo.index', null, '1')),
						'follow' => (isset($_POST['follow']) ? $_POST['follow'] : $modx->getOption('stercseo.follow', null, '1')),
						'sitemap' => (isset($_POST['sitemap']) ? $_POST['sitemap'] : $modx->getOption('stercseo.sitemap', null, '1')),
						'priority' => (isset($_POST['priority']) ? $_POST['priority'] : $modx->getOption('stercseo.priority', null, '0.5')),
						'changefreq' => (isset($_POST['changefreq']) ? $_POST['changefreq'] : $modx->getOption('stercseo.changefreq', null, 'weekly')),
						'urls' => $properties['urls']
					);
				}
			}
			
			if($oldResource->get('alias') != $resource->get('alias') && $oldResource->get('alias') != ''){
				$newProperties['urls'][] = array('url' => $oldResource->get('uri'));
			}
			if($oldResource->get('uri') != $resource->get('uri') && $oldResource->get('uri') != ''){
				$newProperties['urls'][] = array('url' => $oldResource->get('uri'));
			}

        	$resource->setProperties($newProperties,'stercseo');
		break;
	case 'OnLoadWebDocument':
		if($modx->resource){
			if(!$stercseo->isAllowed($modx->resource->get('context_key'))) return;
			$properties = $modx->resource->getProperties('stercseo');
			$metaContent = array('noopd', 'noydir');
			if(!$properties['index']) $metaContent[] = 'noindex';
			if(!$properties['follow']) $metaContent[] = 'nofollow';
			$modx->setPlaceholder('seoTab.robotsTag',implode(',', $metaContent));
		}
		break;

	case 'OnPageNotFound':
		$url = urldecode($_SERVER['REQUEST_URI']);
        
		$convertedUrl = str_replace('/', '_/', ltrim($url, '/'));
        $convertedUrl = json_encode($convertedUrl);
        $convertedUrl = str_replace("\u", "\\\\u", $convertedUrl);
        $convertedUrl = str_replace('"', '', $convertedUrl);
        
		$w = array(
			'properties:LIKE' => '%'.$convertedUrl.'%'
		);
		
		if($modx->getOption('stercseo.context-aware-alias', null, '0')){
			$w['context_key'] = $modx->context->key;
		}

		$alreadyExists = $modx->getObject('modResource', $w);
		if($alreadyExists){
			$id = $modx->makeUrl($alreadyExists->get('id'));
			$modx->sendRedirect($id, 0, 'REDIRECT_HEADER', 'HTTP/1.1 301 Moved Permanently');
		}
		break;
	case 'OnResourceBeforeSort':
		foreach($nodes as $node) {
			$oldResource = $modx->getObject('modResource',$node['id']);
			$resource 	 = $modx->getObject('modResource',$node['id']);
			$resource->set('parent', $node['parent']);

			if(!$stercseo->isAllowed($resource->get('context_key'))) return;

			if($oldResource->get('uri') != $resource->getAliasPath($resource->get('alias')) && $oldResource->get('uri') != ''){
				$newProperties = $oldResource->getProperties('stercseo');
				$newProperties['urls'][] = array('url' => $oldResource->get('uri'));
				$oldResource->setProperties($newProperties,'stercseo');
				$oldResource->save();
			}
		}
		break;
	case 'OnResourceDuplicate':
		if(!$stercseo->isAllowed($newResource->get('context_key'))) return;
		$props = $newResource->getProperties('stercseo');
		$props['urls'] = array();
		$newResource->setProperties($props,'stercseo');
		$newResource->save();
		break;

}
return;
