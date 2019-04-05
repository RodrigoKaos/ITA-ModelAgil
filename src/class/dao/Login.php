<?php

namespace DAO;

use Connection\Database;

class Login {

  public static function verify($user, $password){
    $query = "SELECT U_ID, U_NAME FROM USERS 
                  WHERE U_LOGIN=? AND U_PASSWORD=?";
    
    return Database::select([$user, $password], $query, true);    
  }
  
}