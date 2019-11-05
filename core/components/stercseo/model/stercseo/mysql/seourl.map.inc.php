<?php
/**
 * @package stercseo
 */
$xpdo_meta_map['seoUrl']= array (
  'package' => 'stercseo',
  'version' => NULL,
  'table' => 'seo_urls',
  'extends' => 'xPDOSimpleObject',
  'fields' =>
  array (
    'resource' => 0,
    'url' => '',
    'context_key' => '',
    'uri_ignore_params' => 0
  ),
  'fieldMeta' =>
  array (
    'resource' =>
    array (
      'dbtype' => 'integer',
      'precision' => '10',
      'phptype' => 'int',
      'null' => false,
      'default' => 0,
    ),
    'url' =>
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'context_key' =>
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
   'uri_ignore_params' =>
    array (
      'dbtype' => 'integer',
      'precision' => '1',
      'phptype' => 'int',
      'null' => false,
      'default' => 0,
    )
  ),
);
