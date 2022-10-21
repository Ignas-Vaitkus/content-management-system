<?php

use Controllers\Application;
use Models\Page;

require('bootstrap.php');

$app = Application::getApp($entityManager, __DIR__, '/Admin');

$app->router->get('/', ['layouts/Main', 'BasicNav']);
$app->router->get('/Admin', ['layouts/Main', 'layouts/AdminNav', 'CRUD']);
$app->router->get('/Admin/view', ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
$app->router->get('/Admin/add', ['layouts/Main', 'layouts/AdminNav', 'AddUpdate']);
$app->router->post('/Admin/add', function () use ($app) {

    if (
        isset($_POST['Title'])
        && isset($_POST['Content'])
        && strlen($_POST['Title']) <= 255
        && strlen($_POST['Title']) >= 0
        && strlen($_POST['Content']) >= 0
    ) {

        $page = new Page();
        $page->setTitle($_POST['Title']);
        $page->setContent($_POST['Content']);

        Application::$entityManager->persist($page);
        Application::$entityManager->flush();
        header("Location: /content-management-system/Admin");
    } else {
        //Provide more indication to user if data is invalid
        $app->response->setStatusCode(400);
    }
});

$pages = Application::$pages;

foreach ($pages as $page) {
    $app->router->get('/' . $page->getTitle(), ['layouts/Main', 'BasicNav']);
    $app->router->get('/Admin/view/' . $page->getTitle(), ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
    $app->router->get('/Admin/edit/' . $page->getId(), ['layouts/Main', 'layouts/AdminNav', 'AddUpdate']);
    $app->router->post('/Admin/edit/' . $page->getId(), function () use ($page, $app) {

        //Move the validation to a function to not repeat the code
        if (
            isset($_POST['Title'])
            && isset($_POST['Content'])
            && strlen($_POST['Title']) <= 255
            && strlen($_POST['Title']) >= 0
            && strlen($_POST['Content']) >= 0
        ) {
            $page->setTitle($_POST['Title']);
            $page->setContent($_POST['Content']);

            Application::$entityManager->persist($page);
            Application::$entityManager->flush();
            header("Location: /content-management-system/Admin");
        } else {
            //Provide more indication to user that data is invalid
            $app->response->setStatusCode(400);
        }
    });
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
