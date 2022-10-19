<?php

require_once 'bootstrap.php';

$tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
$classes = array(
    $entityManager->getClassMetadata('Models\Page')
);

$tool->updateSchema($classes);
