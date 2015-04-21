<?php

abstract class OCApi {

  protected $config;
  public function __construct() {
    $configFileName = __DIR__ . '/etc/config.json';

    if(!file_exists($configFileName)) throw new Exception("Error loading config $configFileName");
    $this->config = json_decode(file_get_contents($configFileName));
    if(!is_object($this->config)) throw new Exception("Wrong config $configFileName");

    $this->config->apiDir = __DIR__;
  }

  public function __set($name, $val) {
    $this->config->opencart->{$name} = $val;
  }

  public function getConfig() {
    return $this->config;
  }

}