<?php
require_once dirname(dirname(__FILE__)) . '/index.class.php';
/**
 * Loads the home page.
 *
 * @package modxminify
 * @subpackage controllers
 */
class StercSeoIndexManagerController extends StercSeoBaseManagerController
{
    public function process(array $scriptProperties = array())
    {
        $placeholders = array(
            '_lang' => $this->modx->lexicon->fetch(),
        );
        $this->setPlaceholders(array_merge($placeholders, $this->stercseo->options));
    }
    public function getPageTitle()
    {
        return $this->modx->lexicon('stercseo');
    }
    public function loadCustomCssJs()
    {
        
    }

    public function getTemplateFile()
    {
        return $this->stercseo->config['templatesPath'].'index.tpl';
    }
}
