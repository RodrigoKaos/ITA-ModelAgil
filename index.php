<?php

session_start();

require 'functions.php';
use Main\App;

// echo $_GET['url'];
// echo( $_SERVER["REQUEST_METHOD"] );

App::start();

