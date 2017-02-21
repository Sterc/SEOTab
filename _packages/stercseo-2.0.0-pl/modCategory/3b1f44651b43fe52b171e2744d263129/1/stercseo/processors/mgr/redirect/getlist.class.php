<?php
/**
 * Get list Items
 *
 * @package stercseo
 * @subpackage processors
 */

class StercSeoGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'seoUrl';
    public $languageTopics = array('stercseo:default');
    public $defaultSortField = 'url';
    public $defaultSortDirection = 'ASC';

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'url:LIKE' => '%'.$query.'%',
                'OR:resource:LIKE' => '%'.$query.'%',
            ));
        }
        $context_key = $this->getProperty('context_key');
        if (!empty($context_key)) {
            $c->where(array(
                    'context_key' => $context_key,
                ));
        }
        $resource_id = $this->getProperty('resource_id');
        if (!empty($resource_id)) {
            $c->where(array(
                    'resource' => $resource_id,
                ));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object)
    {
        $resourceId = $object->get('resource');
        if ($resourceId) {
            $resourceObject = $this->modx->getObject('modResource', $resourceId);
            if ($resourceObject) {
                $pagetitle = $resourceObject->get('pagetitle');
                $object->set('target', $pagetitle.' ('.$resourceId.')<br><i><small>'.$this->modx->makeUrl($resourceId, '', '', 'full').'</small></i>');
            }
        }
        $object->set('url', urldecode($object->get('url')));

        /* Get context name from context. Defaults to context_key */
        $contextName = $object->get('context_key');
        $context = $this->modx->getContext($object->get('context_key'));
        if ($context && $context->get('name')) {
            $contextName = $context->get('name');
        }
        $object->set('context_name', $contextName);
        return parent::prepareRow($object);
    }
}
return 'StercSeoGetListProcessor';
