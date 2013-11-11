<?php

if (! function_exists('getSnippetContent')) {
    function getSnippetContent($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<?php','',$o);
        $o = str_replace('?>','',$o);
        $o = trim($o);
        return $o;
    }
}
$snippets = array();

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'StercSeoSiteMap',
    'description' => 'Outputs the sitemap based on the page settings made in SEO-tab',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/StercSeoSiteMap.snippet.php'),
), '', true, true);
unset($properties);

return $snippets;

?>
