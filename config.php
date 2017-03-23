<?php

ini_set('display_errors', 1);

// データベースの設定
define('DSN', 'mysql:host=localhost;dbname=quiz_myapp');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWARD', 'htmr821');

session_start();

require_once(__DIR__ . '/function.php');
require_once(__DIR__ . '/autoload.php');
