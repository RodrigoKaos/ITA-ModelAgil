<?php

namespace DAO;

use Connection\Query;
use Connection\Database;

class Login {

  public function verify($user, $password){
    return Database::select([$user, $password], Query::get(__FUNCTION__), true);
  }

  public function isLogged() {//refactor
    return isset($_SESSION['UID']);
  }
  
}