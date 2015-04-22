<?php

require('siteApi.php');

// Ok, now you have access...

$modelCatalogCategory = $api->getCategory();
$category = $modelCatalogCategory->getCategory(30);
die(var_dump($category));