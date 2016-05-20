<?php
if(!empty($scriptProperties['url']) && !empty($scriptProperties['id'])){
    $urlObject = $modx->getObject('seoUrl',array('url'=> urlencode($scriptProperties['url']),'resource' => $scriptProperties['id']));
    if($urlObject) {
        $urlObject->remove();
    }
}
return true;