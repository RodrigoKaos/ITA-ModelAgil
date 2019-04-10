<?php

namespace Controllers;

class Home extends Controller {
  public static function get($args){
    if(!self::isLogged())
        header("Location: /login");
        
  }  

}