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
