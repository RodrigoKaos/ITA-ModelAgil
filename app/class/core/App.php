<?php

namespace Core;

use Network\Router;
use Network\Request;

class App {  

  private $routes = array(
    '/'         => 'Home',
    '/home'     => 'Home',
    '/login'    => 'Login',
    '/book'     => 'Book',
    '/profile'  => 'Profile',
    '/ranking'  => 'Ranking',
    '/logout'   => 'Logout',
  );

  public function init() {
    $router = new Router();
    $router->set($this->routes);
    $router->on(new Request($_SERVER));
  }
 
}