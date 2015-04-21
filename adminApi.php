<?php

require('api.php');

class OCAdminApi extends OCApi {

  public function __construct() {
    parent::__construct();
    $this->config->opencart->realpath .= '/admin';
  }

  // returns ModelCatalogCategory
  // TODO: factory methods or singleton
  public function getCategory() {
    $this->config->opencart->loader->model('catalog/category');
    $modelCatalogCategory = new ModelCatalogCategory($this->config->opencart->registry);
    return $modelCatalogCategory;
  }

}

$api = new OCAdminApi();
$config = $api->getConfig();

if(!chdir($config->opencart->realpath)) throw new Exception("Can not change directory to {$this->config->opencart->realpath}");
require($config->apiDir . '/opencart/index-admin.php');

$api->registry = $registry;
$api->loader = $loader;

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