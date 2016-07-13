<?php
(@include_once 'config.core.php') or die("Config file not found. Are you sure this file is in your root folder?");

require_once MODX_CORE_PATH.'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('web');

$stercseo = $modx->getService('stercseo', 'StercSEO', $modx->getOption('stercseo.core_path', null, $modx->getOption('core_path').'components/stercseo/').'model/stercseo/', array());

if (!($stercseo instanceof StercSEO)) {
    return;
}

$output = array();
$count = 0;
$site_url = $modx->getOption('site_url');
$resources = $modx->getCollection('modResource', array('context_key:!=' => 'mgr'));
foreach ($resources as $resource) {
    $context_key = $resource->get('context_key');
    $site_url_setting = $modx->getObject('modContextSetting', array('context_key' => $context_key, 'key' => 'site_url'));
    if ($site_url_setting) {
        $site_url = $site_url_setting->get('value');
    }
    $base_url_setting = $modx->getObject('modContextSetting', array('context_key' => $context_key, 'key' => 'base_url'));
    if ($base_url_setting) {
        $base_url = $base_url_setting->get('value');
    }
    if (isset($base_url) && !empty($base_url)) {
        $site_url = str_replace($base_url, '/', $site_url);
    }
    $properties = $resource->getProperties('stercseo');
    foreach ($properties['urls'] as $urls) {
        foreach ($urls as $url) {
            $encoded_url = urlencode($site_url.ltrim($url, '/'));
            $redirect = $modx->getObject('seoUrl', array('url' => $encoded_url));
            if (!$redirect) {
                $redirect = $modx->newObject('seoUrl');
                $data = array(
                   'url' => $encoded_url,
                   'resource' => $resource->get('id'),
                   'context_key' => $context_key,
                );
                $redirect->fromArray($data);
                $redirect->save();
                echo $context_key.' -- '.($site_url.$url).' >>>> '.$resource->get('uri').' -- Redirect added for resource '.$resource->get('id').'<br>';
                $count++;
            } else {
                echo $site_url.$url.' already exist for resource '.$resource->get('id').'<br>';
            }
        }
    }
    // reset the urls in properties
    unset($properties['urls']);
    $resource->setProperties($properties, 'stercseo');
    $resource->save();
}

if ($count == 0) {
    echo '<br>No 301 redirect urls found in resource properties.';
} else {
    echo '<br><br>-------------------------------<br><br>';
    echo $count.' Redirect urls migrated from resource properties to seoUrl object.';
}
