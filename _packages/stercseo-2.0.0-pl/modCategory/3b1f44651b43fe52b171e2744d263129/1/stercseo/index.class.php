<?php
require_once dirname(__FILE__) . '/model/stercseo/stercseo.class.php';
/**
 * @package modxminify
 */

abstract class StercSeoBaseManagerController extends modExtraManagerController
{
    public $stercseo;
    public function initialize()
    {
        $this->stercseo = new StercSEO($this->modx);

        $this->addCss($this->stercseo->getOption('cssUrl').'mgr.css');
        $this->addJavascript($this->stercseo->getOption('jsUrl').'mgr/stercseo.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            StercSEO.config = '.$this->modx->toJSON($this->stercseo->config).';
            StercSEO.config.connector_url = "'.$this->stercseo->getOption('connectorUrl').'";
        });
        </script>');

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
