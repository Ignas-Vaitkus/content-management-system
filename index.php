<?php

use Controllers\Application;
use Models\Page;

require('bootstrap.php');

$app = Application::getApp($entityManager, __DIR__, '/Admin');

//Set session for a day
session_start([
    'cookie_lifetime' => 3600 * 24
]);

$app->router->get('/', ['layouts/Main', 'BasicNav']);
$app->router->get('/Admin', ['layouts/Main', 'layouts/AdminNav', 'CRUD']);
$app->router->get('/Login', ['layouts/Main', 'Login']);
$app->router->post('/Login', function () use ($app) {
    //Login values are hardcoded for now
    if (
        isset($_POST['username'])
        && isset($_POST['password'])
        && $_POST['username'] == 'Admin'
        && $_POST['password'] == 'Password'
    ) {
        $_SESSION['role'] = 'admin';
        header("Location: /content-management-system/Admin");
    } else {
        return $app->router->renderView(['layouts/Main', 'Login'], 'Invalid username or password');
    }
});

$app->router->get('/logout', function () {
    session_destroy();
    header("Location: /content-management-system/");
});

$app->router->get('/Admin/view', ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
$app->router->get('/Admin/add', ['layouts/Main', 'layouts/AdminNav', 'AddUpdate']);
$app->router->post('/Admin/add', function () use ($app) {

    if (isset($_SESSION['role'])) {
        //Move the validation to a function to not repeat the code
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
    } else {
        //Unouthorized status code
        $app->response->setStatusCode(401);
    }
});

$pages = Application::$pages;

foreach ($pages as $page) {
    $app->router->get('/' . $page->getTitle(), ['layouts/Main', 'BasicNav']);
    $app->router->get('/Admin/view/' . $page->getTitle(), ['layouts/Main', 'layouts/AdminNav', 'BasicNav']);
    $app->router->get('/Admin/edit/' . $page->getId(), ['layouts/Main', 'layouts/AdminNav', 'AddUpdate']);
    $app->router->post('/Admin/edit/' . $page->getId(), function () use ($page, $app) {

        //If an admin is logged in
        if (isset($_SESSION['role'])) {
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
                //Provide more indication to user that data is invalid (future work)
                $app->response->setStatusCode(400);
            }
        } else {
            //Unouthorized status code
            $app->response->setStatusCode(401);
        }
    });
}

foreach (array_slice($pages, 1) as $page) {
    $app->router->post('/Admin/delete/' . $page->getId(), function () use ($page, $app) {
        //If an admin is logged in
        //Delete page and redirect
        if (isset($_SESSION['role'])) {
            Application::$entityManager->remove($page);
            Application::$entityManager->flush();
            header("Location: /content-management-system/Admin");
        } else {
            //Unouthorized status code
            $app->response->setStatusCode(401);
        }
    });
}

$app->run();
