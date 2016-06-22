<?php

(@include_once 'config.core.php') or die ("Config file not found. Are you sure this file is in your root folder?");

require_once MODX_CORE_PATH.'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('web');

$stercseo = $modx->getService('stercseo', 'StercSEO', $modx->getOption('stercseo.core_path', null, $modx->getOption('core_path').'components/stercseo/').'model/stercseo/', array());

if (!($stercseo instanceof StercSEO)) {
    return;
}

$output = array();

$contexts = $modx->getCollection('modContext', array('key:!=' => 'mgr'));
foreach ($contexts as $context) {
    $name = $context->get('name');
    if ($name == '' || empty($name)) {
        $name = $context->get('key');
    }
    $site_url = $modx->getOption('site_url');

    $resources = $modx->getCollection('modResource', array('context_key' => $context->get('key')));
    foreach ($resources as $resource) {
        $context_key = $resource->get('context_key');
        $properties = $resource->getProperties('stercseo');
        foreach ($properties['urls'] as $urls) {
            foreach ($urls as $url) {
                // $redirect = $modx->newObject('seoUrl');
                // $data = array(
                //    'url' => urlencode($site_url.$url),
                //    'resource' => $resource->get('id'),
                //    'context_key' => $context_key,
                // );
                // $redirect->fromArray($data);
                // $redirect->save();
                echo urlencode($site_url.$url).'<br/>';
            }
        }

        // $newProperties = array(
        //     'follow' => $properties['follow'],
        //     'sitemap' => $properties['sitemap'],
        //     'priority' => $properties['priority'],
        //     'changefreq' => $properties['changefreq'],
        // );
        // $resource->setProperties($newProperties, 'stercseo');
    }
}
