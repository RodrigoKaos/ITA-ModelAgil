<?php

namespace Controller;

class Book implements IController {
  
  public static function get($args){
    echo '<br>Book method GET';        
  }  

}