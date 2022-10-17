<?php

use Controllers\Application;

require('vendor/autoload.php');

$app = new Application();

$app->router->get('/', function () {
    return 'Hello World';
});

$app->router->get('/contact', function () {
    return 'Contact';
});

$app->run();
