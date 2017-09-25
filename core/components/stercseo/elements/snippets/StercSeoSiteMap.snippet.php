<?php
require_once $modx->getOption('stercseo.core_path', null, $modx->getOption('core_path').'components/stercseo/').'model/stercseo/stercseo.class.php';
$stercseo       = new StercSeo($modx, $scriptProperties);
$allowSymlinks  = (isset($allowSymlinks)) ? $allowSymlinks : 0;
$contexts       = (isset($contexts)) ? explode(',',str_replace(' ', '', $contexts)) : array($modx->resource->get('context_key'));
$outerTpl       = (isset($outerTpl)) ? $outerTpl : 'sitemap/outertpl';
$rowTpl         = (isset($rowTpl)) ? $rowTpl : 'sitemap/rowtpl';
$type           = (isset($type)) ? $type : '';
$indexOuterTpl  = (isset($indexOuterTpl)) ? $indexOuterTpl : 'sitemap/index/outertpl';
$indexRowTpl    = (isset($indexRowTpl)) ? $indexRowTpl : 'sitemap/index/rowtpl';
$imagesOuterTpl = (isset($imageOuterTPl)) ? $imagesOuterTpl : 'sitemap/images/outertpl';
$imagesRowTpl   = (isset($imagesRowTpl)) ? $imagesRowTpl : 'sitemap/images/rowtpl';
$imageTpl       = (isset($imageTpl)) ? $imageTpl : 'sitemap/images/imagetpl';
$templates      = (isset($templates)) ? $templates : '';

$options = array(
    'outerTpl'       => $outerTpl,
    'rowTpl'         => $rowTpl,
    'type'           => $type,
    'indexOuterTpl'  => $indexOuterTpl,
    'indexRowTpl'    => $indexRowTpl,
    'imagesOuterTpl' => $imagesOuterTpl,
    'imagesRowTpl'   => $imagesRowTpl,
    'imageTpl'       => $imageTpl,
    'templates'      => $templates
);

return $stercseo->sitemap($contexts, $allowSymlinks, $options);