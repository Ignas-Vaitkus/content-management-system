<?php

use Controllers\Application;

require_once('bootstrap.php');

$app = new Application();

// $app->router->get('/', function () {
//     return 'Hello world';
// });

$app->run();
