<?php

use Controllers\Application;

require('bootstrap.php');

$app = new Application($entityManager);

$app->router->get('/', 'BasicUser');

$app->router->get('/admin', 'adminNav');
$app->router->get('/admin/view', 'adminNav');

$app->run();
