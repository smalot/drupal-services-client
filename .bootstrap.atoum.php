<?php

/*
This file will automatically be included before EACH test if -bf/--bootstrap-file argument is not used.

Use it to initialize the tested code, add autoloader, require mandatory file, or anything that needs to be done before EACH test.

More information on documentation:
[en] http://docs.atoum.org/en/chapter3.html#Bootstrap-file
[fr] http://docs.atoum.org/fr/chapter3.html#Fichier-de-bootstrap
*/


// AUTOLOADER

// composer
require __DIR__ . '/vendor/autoload.php';

$hostname = rtrim(isset($_ENV['DRUPAL_HOSTNAME']) ? $_ENV['DRUPAL_HOSTNAME'] : 'http://services.local', '/');

define('DRUPAL_HOSTNAME', $hostname . '/rest');
define('DRUPAL_LOGIN', isset($_ENV['DRUPAL_LOGIN']) ? $_ENV['DRUPAL_LOGIN'] : 'admin');
define('DRUPAL_PASSWORD', isset($_ENV['DRUPAL_PASSWORD']) ? $_ENV['DRUPAL_PASSWORD'] : 'admin');
