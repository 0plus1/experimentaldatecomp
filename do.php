<?php

// Composer
require __DIR__ . '/bootstrap/autoload.php';

$application = new Symfony\Component\Console\Application();

$application->add(new \App\Console\DateDiff());

$application->run();