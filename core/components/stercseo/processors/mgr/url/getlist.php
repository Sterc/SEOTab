<?php
if(!empty($scriptProperties['id'])){
	$resource = $modx->getObject('modResource', $scriptProperties['id']);
	if($resource){
		//Fetch urls from seo_urls
        $urls = $modx->getCollection('seoUrl',array('resource' => $resource->get('id')));
        
        foreach ($urls as $url) {
            $properties['urls'][]['url'] = urldecode($url->get('url'));
        }
        
		if($properties['urls']){
			return $this->outputArray($properties['urls'], count($properties['urls']));
		}
	}
}
return $this->outputArray(array(),0);