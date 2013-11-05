<?php

$modx =& $object->xpdo;

$pluginEvents = array('OnBeforeDocFormSave', 'OnBeforeDocFormSave', 'OnDocFormPrerender', 'OnDocFormSave', 'OnEmptyTrash', 'OnPageNotFound', 'OnResourceDuplicate');
$plugins = array('StercSEO');

$success = true;

$modx->log(xPDO::LOG_LEVEL_INFO, 'Running PHP Resolver...');
switch($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
		// Assign plugins to System events
        $pluginObj = $modx->getObject('modPlugin', array('name' => 'StercSEO'));
		if(!$pluginObj) { $modx->log(xPDO::LOG_LEVEL_INFO, 'Cannot get object: StercSEO...'); }
		if($pluginObj) {
			$modx->log(xPDO::LOG_LEVEL_INFO, 'Assigning "OnSiteRefresh" to Plugin StercSEO...');

			foreach ($pluginEvents as $pluginEvent) {
				$intersect = $modx->newObject('modPluginEvent');
				$intersect->set('event', $pluginEvent);
				$intersect->set('pluginid', $pluginObj->get('id'));
				$intersect->save();
			}
		}

	break;

	case xPDOTransport::ACTION_UPGRADE:
		// put any upgrade tasks (if any) here such as removing
		// obsolete files, settings, elements, resources, etc.
		$success = true;
	break;

    case xPDOTransport::ACTION_UNINSTALL:
		$modx->log(xPDO::LOG_LEVEL_INFO, 'Uninstalling...');
		$success = true;
	break;
}

?>