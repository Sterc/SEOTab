<?php
require_once $modx->getOption('stercseo.core_path',null,$modx->getOption('core_path').'components/stercseo/').'model/stercseo/stercseo.class.php';
$stercseo = new StercSeo($modx,$scriptProperties);
return $stercseo->sitemap('sitemap/rowTpl', 'sitemap/outerTpl');