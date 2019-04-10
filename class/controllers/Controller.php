<?php

namespace Controllers;

class Controller {
  
  public static function createView(){
    // include 'views/pages/' . $viewName . '.php';
    echo 'ok '. $_GET['url'];
    //views/pages/home.php
  }

}