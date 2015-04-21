# Opencart API for CLI

Простенький API для создания CLI приложений под Opencart 1.5

Другие версии Opencart - не испробовано.

## Суть проделанной работы

Копирование `index.php` и `admin/index.php` в отдельный каталог вне дерева web-документов, удаление лишнего ($_SERVER, COOKIES, etc)
и смена рабочего каталога `(chdir('/absolute/path/to/site')`.

Объекты `OCAdminApi` (админка) и `OCSiteApi` (сайт) возвращают необходимые объекты для работы с ними в контексте своего не-opencart приложения.

## Установка

Вся конфигурация автоматически подцепляется из каталога сайта, который следует указать.

* Скопировать `etc/config.distr.json` в `etc/config.json`
* Отредактировать `config.json`

В случае нескольких магазинов - отредактировать выбор в коде `index.php`:

```
$config->set('config_store_id', 0);
```

## API

### Site

Пример создания и вызова для получения категории 30:

```
$modelCatalogCategory = $api->getCategory();
$category = $modelCatalogCategory->getCategory(30);
die(var_dump($category));
```

### Admin

Пример добавления новой категории:
```
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
```

* `common` - обязательные поля, требуются при вызове
* `not usually` - поля, обычно не заполняемые
* остальные поля желательно, но не обязательно заполнять
* 1 - английский язык, 2 - русский (фактические номера могут отличаться - смотри админку)