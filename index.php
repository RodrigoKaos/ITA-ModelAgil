<?php

session_start();

require 'app/functions.php';
use Core\App;

$app = new App();
$app->init();
