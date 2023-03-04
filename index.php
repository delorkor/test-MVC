<?php

require('./vendor/autoload.php');
require_once('.' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'parameters.php');

use Test\Test\Component\Router;
use Test\Test\Component\Database;
use Symfony\Component\Dotenv\Dotenv;


(new Dotenv())->load(ROOT_DIR . DIRECTORY_SEPARATOR . '.env');
Database::initConnection();
$router = new Router(require_once(ROUTES_CONFIG));
$router->run();
