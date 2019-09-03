<?php

namespace Core;

use Network\Router;
use Network\Request;

class App {  

  private static $routes = array(
    '/'         => 'Home',
    '/home'     => 'Home',
    '/login'    => 'Login',
    '/book'     => 'Book',
    '/profile'  => 'Profile',
    '/ranking'  => 'Ranking',
    '/logout'   => 'Logout',
  );

  public static function init() {
    Router::set(self::$routes);
    Router::on(new Request($_SERVER));
  }
 
}