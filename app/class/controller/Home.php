<?php

namespace Controller;

use Network\IhttpGet;

class Home implements IhttpGet {
  
  public static function get($args){
    if(!isset($_SESSION['UID']))
      header("Location: /login");
    
    require 'app/view/Home.php';
  }  

}