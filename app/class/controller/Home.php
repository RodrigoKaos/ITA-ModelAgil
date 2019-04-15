<?php

namespace Controller;

use DAO\Login;
use Network\IhttpGet;

class Home implements IhttpGet {
  
  public static function get($args){
    if(!Login::isLogged())
      header("Location: /login");
    
    require 'app/view/Home.php';
  }  

}