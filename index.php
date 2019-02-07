<?php
session_start();

require_once('app.php');

$app = new App();

$app->login();

$app->createView();

