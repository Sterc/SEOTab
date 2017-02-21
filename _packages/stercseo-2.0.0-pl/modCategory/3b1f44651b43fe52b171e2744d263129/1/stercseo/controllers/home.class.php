<?php
require_once dirname(dirname(__FILE__)) . '/index.class.php';
/**
 * Loads the home page.
 *
 * @package modxminify
 * @subpackage controllers
 */
class StercSeoHomeManagerController extends StercSeoBaseManagerController
{
    public function process(array $scriptProperties = array())
    {

    }
    public function getPageTitle()
    {
        return $this->modx->lexicon('stercseo.seotab');
    }
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->stercseo->config['jsUrl'].'mgr/widgets/redirects.grid.js');
        $this->addJavascript($this->stercseo->config['jsUrl'].'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->stercseo->config['jsUrl'].'mgr/sections/home.js');
    }

    public function getTemplateFile()
    {
        return $this->stercseo->config['templatesPath'].'home.tpl';
    }
}
