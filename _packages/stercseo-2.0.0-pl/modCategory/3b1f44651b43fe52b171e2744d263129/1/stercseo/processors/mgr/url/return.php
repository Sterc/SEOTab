<?php
$convertedUrl = urlencode($scriptProperties['url']);
$url          = parse_url($scriptProperties['url']);

if ($url['scheme'] === null) {
    return $modx->error->failure($this->modx->lexicon('stercseo.url_missing_protocol'));
}

$w = array(
    'url' => $convertedUrl
);

$resource = $modx->getObject('modResource', $scriptProperties['id']);
if ($modx->getOption('stercseo.context-aware-alias', null, '0') && $resource) {
    $w['context_key'] = $resource->get('context_key');
}

$alreadyExists = $modx->getObject('seoUrl', $w);
if ($alreadyExists) {
    $target = $modx->getObject('modResource', $alreadyExists->get('resource'));
    return $modx->error->failure(
        $modx->lexicon('stercseo.alreadyexists', array(
            'url'       => $scriptProperties['url'],
            'id'        => $alreadyExists->get('resource'),
            'pagetitle' => ($target ? $target->get('pagetitle') : ''),
            'link'      => $modx->getOption('manager_url') . '?a=resource/update&id=' . $alreadyExists->get('resource')
        ))
    );
}

return $modx->error->success('', $scriptProperties);
