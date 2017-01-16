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

    public function beforeSave()
    {
        $url = urlencode($this->object->get('url'));
        $pagetitle = '';
        $resource = $this->modx->getObject('modResource', $this->object->get('resource'));
        if ($resource) {
            $this->object->set('context_key', $resource->get('context_key'));
            $pagetitle = $resource->get('pagetitle');
        }
        if ($existing = $this->modx->getObject($this->classKey, array('url' => $url))) {
            $this->addFieldError(
                'url',
                $this->modx->lexicon(
                    'stercseo.alreadyexists',
                    array(
                        'url' => $this->object->get('url'),
                        'id' => $existing->get('resource'),
                        'pagetitle' => $pagetitle,
                        'link' => $this->modx->getOption('manager_url').'?a=resource/update&id='.$existing->get('resource')
                    )
                )
            );
        }
        $this->object->set('url', $url);
        return parent::beforeSave();
    }
}
return 'StercSeoCreateProcessor';
