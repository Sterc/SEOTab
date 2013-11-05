<?php
if(!empty($scriptProperties['id'])){
	$resource = $modx->getObject('modResource', $scriptProperties['id']);
	if($resource){
		$properties = $resource->getProperties('stercseo');
		if($properties['urls']){
			return $this->outputArray($properties['urls'], count($properties['urls']));
		}
	}
}
return $this->outputArray(array(),0);