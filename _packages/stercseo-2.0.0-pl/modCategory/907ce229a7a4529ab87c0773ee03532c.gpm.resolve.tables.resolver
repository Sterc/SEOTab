<?php
/**
 * Resolve creating db tables
 *
 * THIS RESOLVER IS AUTOMATICALLY GENERATED, NO CHANGES WILL APPLY
 *
 * @package stercseo
 * @subpackage build
 */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modelPath = $modx->getOption('stercseo.core_path', null, $modx->getOption('core_path') . 'components/stercseo/') . 'model/';
            
            $modx->addPackage('stercseo', $modelPath, null);


            $manager = $modx->getManager();

            $manager->createObjectContainer('seoUrl');

            break;
    }
}

return true;