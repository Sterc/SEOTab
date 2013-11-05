<?php

$convertedUrl = str_replace('/', '_/', $scriptProperties['url']);
$alreadyExists = $modx->getObject('modResource', array(
	'properties:LIKE' => '%"'.$convertedUrl.'"%'
));
if($alreadyExists){
	return $modx->error->failure($modx->lexicon('stercseo.alreadyexists', array('+site_URI' => $modx->getOption('site_url'), 'URI' => $scriptProperties['url'], 'id' => $alreadyExists->get('id'), 'pagetitle' => $alreadyExists->get('pagetitle'))));
}
return $modx->error->success('',$scriptProperties);