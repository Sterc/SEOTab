<?php
/**
 * Build StercSEO package
 *
 * @package stercSEO
 * @subpackage build
 * @author Wieger Sloot at Sterc <modx@sterc.nl>
 */

define('PKG_NAME', 'StercSEO');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));
define('PKG_VERSION', '1.0.8');
define('PKG_RELEASE', 'pl');
define('PKG_CATEGORY', PKG_NAME);

// start timer
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

// sources
$root = dirname(dirname(__FILE__)) . '/';
$sources = array (
    'root' => $root,
    'build' => $root.'_build/',
    /* note that the next two must not have a trailing slash */
    'source_core' => $root.'core/components/'.PKG_NAME_LOWER,
    'source_assets' => $root.'assets/components/'.PKG_NAME_LOWER,
    'validators'=> $root.'_build/validators/',
    'data' => $root.'_build/data/',
    'docs' => $root.'core/components/'.PKG_NAME_LOWER.'/docs/',
    'install_options' => $root.'_build/install.options/',
    'packages' => $root.'core/packages',
);
unset($root);
// load MODX
require_once $sources['build'].'build.config.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$modx->setLogLevel(xPDO::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

// load builder
$modx->loadClass('transport.modPackageBuilder', '', false, true);
$builder = new modPackageBuilder($modx);
$builder->createPackage(PKG_NAME_LOWER, PKG_VERSION, PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER, false, true, '{core_path}components/'.PKG_NAME_LOWER.'/');

// create required category
$category= $modx->newObject('modCategory');
$category->set('id', 1);
$category->set('category', PKG_CATEGORY);

// adding snippets
$modx->log(modX::LOG_LEVEL_INFO, 'Adding in snippets...');
$snippets = include $sources['data'].'transport.snippets.php';
if(is_array($snippets)) {
	$category->addMany($snippets);
} else { $modx->log(modX::LOG_LEVEL_FATAL,'Adding snippets failed...'); }

// create category attributes
$attr = array(
	xPDOTransport::UNIQUE_KEY => 'category',
	xPDOTransport::PRESERVE_KEYS => false,
	xPDOTransport::UPDATE_OBJECT => true,
	xPDOTransport::RELATED_OBJECTS => true,
	xPDOTransport::ABORT_INSTALL_ON_VEHICLE_FAIL => true,
	xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
		'Snippets' => array(
			xPDOTransport::PRESERVE_KEYS => false,
			xPDOTransport::UPDATE_OBJECT => true,
			xPDOTransport::UNIQUE_KEY => 'name',
		),
	),
);

// create vehicle of all
$vehicle = $builder->createVehicle($category, $attr);

// put vehicle in builder
$builder->putVehicle($vehicle);

/* create the plugin object */
$plugin= $modx->newObject('modPlugin');
$plugin->set('id',1);
$plugin->set('name', 'StercSEO');
$plugin->set('description', 'Plugin to render the seo tab and save all the data');
$plugin->set('plugincode', getSnippetContent($sources['source_core'].'/elements/plugins/stercseo.plugin.php'));

/* add plugin events */
$events = include $sources['data'].'transport.plugin.events.php';
if (is_array($events) && !empty($events)) {
    $plugin->addMany($events);
    $modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' Plugin Events.'); flush();
} else {
    $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events!');
}

$attributes= array(
    xPDOTransport::UNIQUE_KEY => 'name',
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'PluginEvents' => array(
            xPDOTransport::PRESERVE_KEYS => true,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => array('pluginid','event'),
        ),
    ),
);
$vehicle = $builder->createVehicle($plugin, $attributes);

// add in core and assets
$vehicle->resolve('file',array(
	'source' => $sources['source_core'],
	'target' => "return MODX_CORE_PATH . 'components/';",
));
$vehicle->resolve('file',array(
	'source' => $sources['source_assets'],
	'target' => "return MODX_ASSETS_PATH . 'components/';",
));

// put vehicle in builder
$builder->putVehicle($vehicle);

/* load system settings */
 $settings = include $sources['data'].'transport.settings.php';
 if (is_array($settings) && !empty($settings)) {
     $attributes= array(
         xPDOTransport::UNIQUE_KEY => 'key',
         xPDOTransport::PRESERVE_KEYS => true,
         xPDOTransport::UPDATE_OBJECT => false,
     );
     foreach ($settings as $setting) {
         $vehicle = $builder->createVehicle($setting,$attributes);
         $builder->putVehicle($vehicle);
     }
     $modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($settings).' System Settings.'); flush();
 } else {
     $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not package System Settings.');
 }
 unset($settings,$setting);

// add some textfiles
$builder->setPackageAttributes(array(
	'license' => file_get_contents($sources['docs'].'license.txt'),
	'readme' => file_get_contents($sources['docs'].'readme.txt'),
	'changelog' => file_get_contents($sources['docs'].'changelog.txt'),
	'setup-options' => array(
        'source' => $sources['build'].'_setup.options.php',
    ),
));

// Last step - zip up the package
$modx->log(modX::LOG_LEVEL_INFO,'Packing up transport package zip...');
$builder->pack();

// report how long it took
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tend = $mtime;
$totalTime = ($tend - $tstart);
$totalTime = sprintf("%2.4f s", $totalTime);

$modx->log(xPDO::LOG_LEVEL_INFO, "Package Built.");
$modx->log(xPDO::LOG_LEVEL_INFO, "Execution time: {$totalTime}");

?>
