<?php

// Database info
$host = 'mysql';
$db   = 'ita_jali';
$user = 'root';
$pass = '123.456';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

define('DB_HOST', $host );
define('DB_NAME', $db );
define('DB_USER', $user );
define('DB_PASS', $pass );
define('DB_DSN', $dsn );
define('DB_OPT', $opt);