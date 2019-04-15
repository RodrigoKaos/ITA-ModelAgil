<?php

namespace Controller;

use DAO\Login as LoginDAO;
use Network\IhttpGet;
use Network\IhttpPost;

class Login implements IhttpGet, IhttpPost {
  
  public static function get($args){
    
    require 'app/view/login.php';       
  }

  public static function post($args){
    if( !empty($_POST) ){
      if( isset($_POST['login'])  && isset($_POST['password']) ) {
        $user = LoginDAO::verify($_POST['login'], $_POST['password']);

        if( !$user ) {
          $err_msg = 'Invalid username or password...';
          $_SESSION['LOGERROR'] = $err_msg;
        } else {
          $_SESSION['UID'] = $user->id;
          $_SESSION['UNAME'] = $user->name;
        }
        header("Location: /");      
      }
    }
  }

}