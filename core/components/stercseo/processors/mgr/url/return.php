<?php

$page = $modx->getObject('modResource', $scriptProperties['id']);
$convertedUrl = urlencode($scriptProperties['url']);
$w = array(
	'url' => $convertedUrl
);
if($modx->getOption('stercseo.context-aware-alias', null, '0')){
	$w['context_key'] = $page->get('context_key');
}
$alreadyExists = $modx->getObject('seoUrl', $w);
if($alreadyExists){
	return $modx->error->failure($modx->lexicon('stercseo.alreadyexists', array('URI' => $scriptProperties['url'], 'id' => $alreadyExists->get('resource'))));
}
return $modx->error->success('',$scriptProperties);