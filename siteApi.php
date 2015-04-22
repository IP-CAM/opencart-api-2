<?php

require('api.php');

class OCSiteApi extends OCApi {

  // returns ModelCatalogCategory
  // TODO: factory methods or singleton
  public function getCategory() {
    $modelCatalogCategory = new ModelCatalogCategory($this->config->opencart->registry);
    return $modelCatalogCategory;
  }

}

$api = new OCSiteApi();
$config = $api->getConfig();

if(!chdir($config->opencart->realpath)) throw new Exception("Can not change directory to {$this->config->opencart->realpath}");
require($config->apiDir . '/opencart/index-site.php');

$api->registry = $registry;