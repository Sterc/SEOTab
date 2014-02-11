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
$events['OnHandleRequest']= $modx->newObject('modPluginEvent');
$events['OnHandleRequest']->fromArray(array(
    'event' => 'OnHandleRequest',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);
$events['OnPageNotFound']= $modx->newObject('modPluginEvent');
$events['OnPageNotFound']->fromArray(array(
    'event' => 'OnPageNotFound',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

return $events;
?>
