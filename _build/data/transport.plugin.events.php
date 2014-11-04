<?php
$events = array();

$events['OnDocFormPrerender']= $modx->newObject('modPluginEvent');
$events['OnDocFormPrerender']->fromArray(array(
    'event' => 'OnDocFormPrerender',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);
$events['OnBeforeDocFormSave']= $modx->newObject('modPluginEvent');
$events['OnBeforeDocFormSave']->fromArray(array(
    'event' => 'OnBeforeDocFormSave',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);
$events['OnLoadWebDocument']= $modx->newObject('modPluginEvent');
$events['OnLoadWebDocument']->fromArray(array(
    'event' => 'OnLoadWebDocument',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);
$events['OnPageNotFound']= $modx->newObject('modPluginEvent');
$events['OnPageNotFound']->fromArray(array(
    'event' => 'OnPageNotFound',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);
$events['OnResourceDuplicate']= $modx->newObject('modPluginEvent');
$events['OnResourceDuplicate']->fromArray(array(
    'event' => 'OnResourceDuplicate',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

return $events;
?>
