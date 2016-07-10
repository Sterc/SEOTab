<?php
/**
 * Create redirect
 *
 * @package stercseo
 * @subpackage processors
 */
class StercSeoCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'seoUrl';
    public $languageTopics = array('stercseo:default');

    public function beforeSave() {
    	$this->object->set('url', urlencode($this->object->get('url')));
    	return parent::beforeSave();
    }
}
return 'StercSeoCreateProcessor';
