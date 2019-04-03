<?php

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
// Database info
$host = 'mysql';
$db   = 'JALI';
$user = 'root';
$pass = '123.456';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db";
