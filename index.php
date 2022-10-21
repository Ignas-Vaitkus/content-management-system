<?php

use Controllers\Application;

require('bootstrap.php');

$app = Application::getApp($entityManager, __DIR__, '/Admin');

$app->router->get('/', ['layouts/Main', 'BasicNav']);
$app->router->get('/Admin', ['layouts/Main', 'layouts/AdminNav', 'CRUD']);
$app->router->get('/Admin/view', ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);

$pages = Application::$pages;

foreach ($pages as $page) {
    $app->router->get('/' . $page->getTitle(), ['layouts/Main', 'BasicNav']);
    $app->router->get('/Admin/view/' . $page->getTitle(), ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
}

$app->run();
