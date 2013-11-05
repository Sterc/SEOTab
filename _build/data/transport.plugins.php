<?php

if (! function_exists('getPluginContent')) {
    function getPluginContent($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<?php','',$o);
        $o = str_replace('?>','',$o);
        $o = trim($o);
        return $o;
    }
}
$plugins = array();

$plugins[1]= $modx->newObject('modplugin');
$plugins[1]->fromArray(array(
    'id' => 1,
    'name' => 'StercSEO',
    'description' => 'Plugin to render the seo tab and save all the data',
    'plugincode' => getPluginContent($sources['source_core'].'/elements/plugins/stercseo.plugin.php'),
), '', true, true);
unset($properties);

return $plugins;

?>