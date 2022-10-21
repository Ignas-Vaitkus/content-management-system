<?php

use Controllers\Application;

require('bootstrap.php');

$app = Application::getApp($entityManager, __DIR__, '/Admin');

$app->router->get('/', ['layouts/Main', 'BasicNav']);
$app->router->get('/Admin', ['layouts/Main', 'layouts/AdminNav', 'CRUD']);
$app->router->get('/Admin/view', ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
$app->router->get('/Admin/add', ['layouts/Main', 'layouts/AdminNav', 'Create']);

$pages = Application::$pages;

foreach ($pages as $page) {
    $app->router->get('/' . $page->getTitle(), ['layouts/Main', 'BasicNav']);
    $app->router->get('/Admin/view/' . $page->getTitle(), ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
    $app->router->get('/Admin/edit/' . $page->getId(), ['layouts/Main', 'Update']);
}

foreach (array_slice($pages, 1) as $page) {
    $app->router->post('/Admin/delete/' . $page->getId(), function () use ($page) {
        //Delete page and redirect

        Application::$entityManager->remove($page);
        Application::$entityManager->flush();
        header("Location: /content-management-system/Admin");
    });
}

$app->run();
