<?php
/**
 * Update redirect
 *
 * @package stercseo
 * @subpackage processors
 */
class StercSeoUpdateProcessor extends modObjectUpdateProcessor
{
    public $classKey = 'seoUrl';
    public $languageTopics = array('stercseo:default');

     public function beforeSave() {
    	$this->object->set('url', urlencode($this->object->get('url')));
    	return parent::beforeSave();
    }
}
return 'StercSeoUpdateProcessor';
