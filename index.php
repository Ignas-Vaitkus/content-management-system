<?php

use Controllers\Application;

require('bootstrap.php');

$app = new Application($entityManager);

$app->router->get('/', 'BasicUser');

$app->router->get('/admin', 'AdminNav');
$app->router->get('/admin/view', 'AdminNav');

$app->run();
