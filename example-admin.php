<?php

require('adminApi.php');

// Ok, now you have access...

$modelCatalogCategory = $api->getCategory();

$data = array(
  'parent_id' => 0, // top level [common]
  'top' => 1, // show in menu
  'column' => 3, // count of columns [common]
  'sort_order' => 0, // order [common]
  'status' => 1, // active [common]
  'keyword' => 'keyword', // alias [common]
  'image' => null, // image
  'category_description' => array( // category description for each language [common]
    1 => array('name' => 'sample name', 'meta_keyword' => 'meta keywords',
      'meta_description' => 'meta description', 'description' => 'description'), // en
    2 => array('name' => 'sample name ru', 'meta_keyword' => 'meta keywords',
      'meta_description' => 'meta description', 'description' => 'description') // ru
  ),
  'category_store' => array(0), // store ids
  // category_filter => array($id1, $id2, $id3), [not usually]
  // category_layout => array($store_id_1 => $layout_1, $store_id_2 => $layout_2), [not usually]
);

$modelCatalogCategory->addCategory($data);