<?php
require_once dirname(dirname(__FILE__)) . '/index.class.php';
/**
 * Loads the home page.
 *
 * @package modxminify
 * @subpackage controllers
 */
class StercSeoMigrateManagerController extends StercSeoBaseManagerController
{
    public function process(array $scriptProperties = array())
    {

    }
    public function getPageTitle()
    {
        return $this->modx->lexicon('stercseo.migrate');
    }
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->stercseo->config['jsUrl'].'mgr/widgets/migrate.panel.js');
        $this->addLastJavascript($this->stercseo->config['jsUrl'].'mgr/sections/migrate.js');
    }

    public function getTemplateFile()
    {
        return $this->stercseo->config['templatesPath'].'migrate.tpl';
    }
}
