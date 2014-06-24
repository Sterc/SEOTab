<?php
/**
 * @package stercSEO
 * @subpackage build
 */
$settings = array();

$settings['stercseo.context-aware-alias']= $modx->newObject('modSystemSetting');
$settings['stercseo.context-aware-alias']->fromArray(array(
    'key' => 'stercseo.context-aware-alias',
     'value' => '0',
     'xtype' => 'combo-boolean',
    'namespace' => 'stercseo',
     'area' => 'general',
),'',true,true);
$settings['stercseo.index']= $modx->newObject('modSystemSetting');
$settings['stercseo.index']->fromArray(array(
    'key' => 'stercseo.google-index',
     'value' => '1',
     'xtype' => 'combo-boolean',
    'namespace' => 'stercseo',
     'area' => 'general',
),'',true,true);
$settings['stercseo.follow']= $modx->newObject('modSystemSetting');
$settings['stercseo.follow']->fromArray(array(
    'key' => 'stercseo.google-follow',
     'value' => '1',
     'xtype' => 'combo-boolean',
    'namespace' => 'stercseo',
     'area' => 'general',
),'',true,true);
$settings['stercseo.search']= $modx->newObject('modSystemSetting');
$settings['stercseo.search']->fromArray(array(
    'key' => 'stercseo.search',
     'value' => '1',
     'xtype' => 'combo-boolean',
    'namespace' => 'stercseo',
     'area' => 'general',
),'',true,true);
$settings['stercseo.sitemap']= $modx->newObject('modSystemSetting');
$settings['stercseo.sitemap']->fromArray(array(
    'key' => 'stercseo.sitemap',
     'value' => '1',
     'xtype' => 'combo-boolean',
    'namespace' => 'stercseo',
     'area' => 'general',
),'',true,true);
$settings['stercseo.priority']= $modx->newObject('modSystemSetting');
$settings['stercseo.priority']->fromArray(array(
    'key' => 'stercseo.priority',
     'value' => '0.5',
     'xtype' => 'textfield',
    'namespace' => 'stercseo',
     'area' => 'general',
),'',true,true);
$settings['stercseo.changefreq']= $modx->newObject('modSystemSetting');
$settings['stercseo.changefreq']->fromArray(array(
    'key' => 'stercseo.changefreq',
     'value' => 'weekly',
     'xtype' => 'textfield',
    'namespace' => 'stercseo',
     'area' => 'general',
),'',true,true);

return $settings;