<?php
/**
 * Get resource list
 *
 * @package stercseo
 * @subpackage processors
 */
class StercSeoResourceGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modResource';
    public $languageTopics = array('stercseo:default');
    public $defaultSortField = 'menuindex';
    public $defaultSortDirection = 'ASC';

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c->where(array(
            'published' => 1,
            'deleted' => 0,
        ));
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'pagetitle:LIKE' => '%'.$query.'%',
                'OR:longtitle:LIKE' => '%'.$query.'%'
            ));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object)
    {
        $context_key = $object->get('context_key');
        if ($context_key) {
            $object->set('pagetitle', $object->get('pagetitle').' ('.$context_key.')');
        }

        return parent::prepareRow($object);
    }

}
return 'StercSeoResourceGetListProcessor';
