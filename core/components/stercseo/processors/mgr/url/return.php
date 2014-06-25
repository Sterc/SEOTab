<?php

$page = $modx->getObject('modResource', $scriptProperties['id']);
$convertedUrl = str_replace('/', '_/', $scriptProperties['url']);
$w = array(
	'properties:LIKE' => '%"'.$convertedUrl.'"%'
);
if($modx->getOption('stercseo.context-aware-alias', null, '0')){
	$w['context_key'] = $page->get('context_key');
}
$alreadyExists = $modx->getObject('modResource', $w);
if($alreadyExists){
	return $modx->error->failure($modx->lexicon('stercseo.alreadyexists', array('+site_URI' => $modx->getOption('site_url'), 'URI' => $scriptProperties['url'], 'id' => $alreadyExists->get('id'), 'pagetitle' => $alreadyExists->get('pagetitle'))));
}
return $modx->error->success('',$scriptProperties);