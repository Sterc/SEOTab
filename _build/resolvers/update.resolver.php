<?php
/**
 * StercSEO update package resolver
 * Replaces all the index/sitemap/: true/false values with 1/0
 *
 * @package StercSEO
 * @subpackage build
*/
$package = 'StercSEO';
$modx =& $object->xpdo;

$success = false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_UPGRADE:
        // index: true
        $modx->exec("UPDATE {$modx->getTableName('modResource')} 
            SET {$modx->escape('properties')} = replace(properties,'index\":\"true\",\"follow','index\":\"1\",\"follow')  
            WHERE {$modx->escape('properties')} LIKE '%index\":\"true\",\"follow%'");
        // index: false
        $modx->exec("UPDATE {$modx->getTableName('modResource')} 
            SET {$modx->escape('properties')} = replace(properties,'index\":\"false\",\"follow','index\":\"0\",\"follow')  
            WHERE {$modx->escape('properties')} LIKE '%index\":\"false\",\"follow%'");
        // follow: true
        $modx->exec("UPDATE {$modx->getTableName('modResource')} 
            SET {$modx->escape('properties')} = replace(properties,'follow\":\"true\",\"sitemap','follow\":\"1\",\"sitemap')  
            WHERE {$modx->escape('properties')} LIKE '%follow\":\"true\",\"sitemap%'");
        // follow: false
        $modx->exec("UPDATE {$modx->getTableName('modResource')} 
            SET {$modx->escape('properties')} = replace(properties,'follow\":\"false\",\"sitemap','follow\":\"0\",\"sitemap')  
            WHERE {$modx->escape('properties')} LIKE '%follow\":\"false\",\"sitemap%'");
        // sitemap: true
        $modx->exec("UPDATE {$modx->getTableName('modResource')} 
            SET {$modx->escape('properties')} = replace(properties,'sitemap\":\"true\",\"priority','sitemap\":\"1\",\"priority')  
            WHERE {$modx->escape('properties')} LIKE '%sitemap\":\"true\",\"priority%'");
        // sitemap: false
        $modx->exec("UPDATE {$modx->getTableName('modResource')} 
            SET {$modx->escape('properties')} = replace(properties,'sitemap\":\"false\",\"priority','sitemap\":\"0\",\"priority')  
            WHERE {$modx->escape('properties')} LIKE '%sitemap\":\"false\",\"priority%'");
        $success = true;
        break;
}

return $success;