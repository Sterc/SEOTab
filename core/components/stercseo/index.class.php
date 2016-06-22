<?php
require_once dirname(__FILE__) . '/model/stercseo/stercseo.class.php';
/**
 * @package modxminify
 */

abstract class StercSeoBaseManagerController extends modExtraManagerController
{
    /** @var modxMinify $modxminify */
    public $stercseo;
    public function initialize()
    {
        $this->stercseo = new StercSEO($this->modx);
        parent::initialize();
    }
    public function getLanguageTopics()
    {
        return array('stercseo:default');
    }
    public function checkPermissions()
    {
        return true;
    }
}
