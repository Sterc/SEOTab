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

}
return 'StercSeoResourceGetListProcessor';
