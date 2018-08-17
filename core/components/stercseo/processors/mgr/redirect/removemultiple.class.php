<?php
include_once __DIR__ . '/remove.class.php';
/**
 * Remove multiple redirects
 *
 * @param string $redirects Comma-separated redirect ids
 */

class StercSeoRemoveMultipleProcessor extends StercSeoRemoveProcessor
{
    public $redirects = array();

    public function initialize()
    {
        $redirects = $this->getProperty('redirects', '');
        if (empty($redirects)) {
            return $this->modx->lexicon('stercseo.uri_remove_bulk.redirect_err_ns');
        }
        $this->redirects = explode(',', $redirects);

        return true;
    }

    public function process()
    {
        foreach ($this->redirects as $redirect) {
            $this->setProperty('id', $redirect);
            $initialized = parent::initialize();
            if ($initialized === true) {
                $process = parent::process();
                if (!$process['success']) {
                    return $process;
                }
            } else {
                return $this->failure($initialized);
            }
        }
        return $this->success();
    }
}

return 'StercSeoRemoveMultipleProcessor';
