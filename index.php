<?php

use Controllers\Application;

require('bootstrap.php');

$app = Application::getApp($entityManager, __DIR__);

$app->router->get('/', 'BasicUserNav');

$app->router->get('/admin', 'AdminNav');
$app->router->get('/admin/view', 'AdminNav');

$app->run();
