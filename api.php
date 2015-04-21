<?php

class OCApi {

  private $config;
  public function __construct() {
    $configFileName = __DIR__ . '/config.json';

    if(!file_exists($configFileName)) throw new Exception("Error loading config $configFileName");
    $this->config = json_decode(file_get_contents($configFileName));
    if(!is_object($this->config)) throw new Exception("Wrong config $configFileName");

    $this->config->apiDir = __DIR__;
  }

  public function getConfig() {
    return $this->config;
  }

  // returns ModelCatalogCategory
  public function getCategory() {
    $modelCatalogCategory = new ModelCatalogCategory($this->config->opencart->registry);
    return $modelCatalogCategory;
  }

  public function __set($name, $val) {
    $this->config->opencart->$name = $val;
  }
}

$api = new OCApi();
$config = $api->getConfig();

if(!chdir($config->opencart->realpath)) throw new Exception("Can not change directory to {$this->config->opencart->realpath}");
require($config->apiDir . '/index.php');

$api->registry = $registry;
die(var_dump($api->getCategory()));