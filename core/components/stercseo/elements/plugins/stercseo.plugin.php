<?php
/**
 * StercSEO
 *
 * Copyright 2013 by Wieger Sloot, Sterc internet & marketing <modx@sterc.nl>
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
 * @author Wieger Sloot, Sterc internet & marketing <modx@sterc.nl>
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
			$properties = $resource->getProperties('stercseo');
		}
		if(empty($properties)){
			$properties = array(
				'index' => '1',
				'follow' => '1',
				'sitemap' => '1',
				'priority' => '0.5',
				'changefreq' => 'weekly',
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

		/* include CSS and JS*/
		$modx->regClientCSS($stercseo->config['cssUrl'].'stercseo.css');
		$modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/stercseo.js');
		$modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/sections/resource.js');
		$modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/widgets/resource.grid.js');
		$modx->regClientStartupScript($stercseo->config['jsUrl'].'mgr/widgets/resource.vtabs.js');

		//add lexicon
		$modx->controller->addLexiconTopic('stercseo:default');

		break;

	case 'OnBeforeDocFormSave':
	        $oldResource = ($mode == 'upd') ? $modx->getObject('modResource',$resource->get('id')) : $resource;
			if($_POST['urls'] != 'false'){
				$newProperties = array(
					'index' => $_POST['index'],
					'follow' => $_POST['follow'],
					'sitemap' => $_POST['sitemap'],
					'priority' => $_POST['priority'],
					'changefreq' => $_POST['changefreq'],
					'urls' => $modx->fromJSON($_POST['urls'])
				);
			}else{
				$properties = $oldResource->getProperties('stercseo');
				$newProperties = array(
					'index' => $_POST['index'],
					'follow' => $_POST['follow'],
					'sitemap' => $_POST['sitemap'],
					'priority' => $_POST['priority'],
					'changefreq' => $_POST['changefreq'],
					'urls' => $properties['urls']
				);
			}
			if($oldResource->get('uri') != $resource->get('uri') && $oldResource->get('uri') != ''){
				$newProperties['urls'][] = array('url' => $oldResource->get('uri'));
			}

        	$resource->setProperties($newProperties,'stercseo');
		break;
	case 'OnHandleRequest':
		if ($modx->context->get('key') == 'mgr') return;
		$uri = $_REQUEST[$modx->getOption('request_param_alias', null, 'q')];
		$resource = $modx->getObject('modResource', array('uri' => $uri));
		if($resource){
			$properties = $resource->getProperties('stercseo');
			$metaContent = array('noopd', 'noydir');
			if($properties){
				if(!$properties['index']) $metaContent[] = 'noindex';
				if(!$properties['follow']) $metaContent[] = 'nofollow';
			}
			$modx->regClientStartupHTMLBlock('<meta name="robots" content="'.implode(',', $metaContent).'" />');
		}

		break;

	case 'OnPageNotFound':
		$url = $_REQUEST[$modx->getOption('request_param_alias', null, 'q')];
		$alreadyExists = $modx->getObject('modResource', array(
			'properties:LIKE' => '%"'.$url.'"%'
		));
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

			if($oldResource->get('uri') != $resource->getAliasPath($resource->get('alias')) && $oldResource->get('uri') != ''){
				$newProperties = $oldResource->getProperties('stercseo');
				$newProperties['urls'][] = array('url' => $oldResource->get('uri'));
				$oldResource->setProperties($newProperties,'stercseo');
				$oldResource->save();
			}
		}
		return true;
}
return;
