<?php

session_start();

require 'functions.php';
use Core\App;
use Network\Router;
use Network\Request;

// App::start();

$arr = array(
  '/' => 'Controller\Home',
  '/login' => 'Controller\Login',
  '/book' => 'Controller\Book'
);

Router::set($arr);
Router::on(new Request($_SERVER));
  
