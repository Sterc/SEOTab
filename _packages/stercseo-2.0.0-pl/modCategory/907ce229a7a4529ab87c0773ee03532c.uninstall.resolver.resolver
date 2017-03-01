<?php
/**
 * StercSEO uninstall resolver.
 *
 * @package stercseo
 * @subpackage build
 */
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_UNINSTALL:
        /* Remove the custom migration_status system setting */
        $migrationStatusSetting = $object->xpdo->getObject('modSystemSetting', array(
            'key'       => 'stercseo.migration_status',
            'namespace' => 'stercseo_custom'
        ));
        if ($migrationStatusSetting) {
            $migrationStatusSetting->remove();
        }
        break;
}
return true;