<?php

use Controllers\Application;

require('bootstrap.php');

$app = Application::getApp($entityManager, __DIR__);

$app->router->get('/', ['layouts/Main', 'BasicNav']);

$pages = Application::getApp()->pages;

foreach ($pages as $page) {

    $app->router->get('/' . $page->getTitle(), ['layouts/Main', 'BasicNav']);
}

$app->router->get('/Admin', ['layouts/Main', 'layouts/AdminNav', 'CRUD']);
$app->router->get('/Admin/view', ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);

foreach ($pages as $page) {
    $app->router->get("/Admin/view/$page", ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
}

$app->run();
