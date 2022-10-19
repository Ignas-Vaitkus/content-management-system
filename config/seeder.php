<?php

use Models\Page;

require_once('bootstrap.php');

$titles = ['Home', 'About', 'Services', 'News', 'Contact'];
$content = [
    '<h1>Welcome</h1>',
    "<h2>We're the best at what we do</h2>",
    '<h3>What we do is what you want.</h3>',
    '<h4>This is relevant for you.</h4>',
    "<h5>We're always here for you.</h5>"
];

for ($i = 0; $i < sizeof($titles); $i++) {
    $page = new Page();
    $page->setTitle($titles[$i]);
    $page->setContent($content[$i]);
    $entityManager->persist($page);
}

$entityManager->flush();
