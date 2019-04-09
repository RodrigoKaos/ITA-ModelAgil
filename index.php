<?php

session_start();

require 'functions.php';

use Main\App;

// require_once('app.php');

$app = new App();

$app->login();

$app->createView();

