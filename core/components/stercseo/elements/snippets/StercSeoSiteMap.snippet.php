<?php
require_once $modx->getOption('stercseo.core_path',null,$modx->getOption('core_path').'components/stercseo/').'model/stercseo/stercseo.class.php';
$stercseo = new StercSeo($modx,$scriptProperties);
$allowSymlinks = (isset($allowSymlinks)) ? $allowSymlinks : 0;
$contexts = (isset($contexts)) ? explode(',',str_replace(' ','',$contexts)) : array($modx->resource->get('context_key'));
return $stercseo->sitemap($contexts, 'sitemap/rowTpl', 'sitemap/outerTpl', $allowSymlinks);