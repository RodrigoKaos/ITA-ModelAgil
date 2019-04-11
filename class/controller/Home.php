<?php

namespace Controller;

class Home implements IController {
  
  public static function get($args){
    if(!$args)
      // header("Location: /login");
    
      echo 'Home method GET';
      require 'view/Home.php';
  }  

}