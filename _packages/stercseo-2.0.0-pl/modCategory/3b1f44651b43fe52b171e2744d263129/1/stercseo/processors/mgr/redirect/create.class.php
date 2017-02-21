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
        $pagetitle  = '';
        $resource   = $this->modx->getObject('modResource', $this->getProperty('resource'));
        $encodedUrl = urlencode($this->getProperty('url'));
        $url        = parse_url($this->getProperty('url'));

        if ($url['scheme'] === null) {
            $this->addFieldError('url', $this->modx->lexicon('stercseo.url_missing_protocol'));

            // $encodedUrl = urlencode($this->modx->config['server_protocol'] . '://' . $this->getProperty('url'));
        }

        if ($resource) {
            $this->object->set('context_key', $resource->get('context_key'));
            $pagetitle = $resource->get('pagetitle');
        }

        $seoUrl = $this->modx->getObject($this->classKey, array('url' => $encodedUrl));

        if ($seoUrl) {
            $this->addFieldError(
                'url',
                $this->modx->lexicon(
                    'stercseo.alreadyexists',
                    array(
                        'url'       => $this->getProperty('url'),
                        'id'        => $seoUrl->get('resource'),
                        'pagetitle' => $pagetitle,
                        'link'      => $this->modx->getOption('manager_url') . '?a=resource/update&id=' . $seoUrl->get('resource')
                    )
                )
            );
        }

        $this->object->set('url', $encodedUrl);

        return parent::beforeSave();
    }
}

return 'StercSeoCreateProcessor';
