<?php
require_once $modx->getOption('stercseo.core_path',null,$modx->getOption('core_path').'components/stercseo/').'model/stercseo/stercseo.class.php';
$stercseo       = new StercSeo($modx,$scriptProperties);
$allowSymlinks  = (isset($allowSymlinks)) ? $allowSymlinks : 0;
$contexts       = (isset($contexts)) ? explode(',',str_replace(' ','',$contexts)) : array($modx->resource->get('context_key'));
$outerTpl       = (isset($outerTpl)) ? $outerTpl : 'sitemap/outerTpl';
$rowTpl         = (isset($rowTpl)) ? $rowTpl : 'sitemap/rowTpl';

return $stercseo->sitemap($contexts, $rowTpl, $outerTpl, $allowSymlinks);