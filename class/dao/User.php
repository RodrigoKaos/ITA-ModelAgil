<?php

namespace DAO;

use Connection\Query;
use Connection\Database;

class User {

  public static function getProfile($id) { 
    return Database::select([$id], Query::get(__FUNCTION__), true);
  }

  public static function getTrophies($id) {
    return Database::select([$id], Query::get(__FUNCTION__));
  }

  public static function getRankingList() {
    return Database::queryAll(Query::get(__FUNCTION__));
  }

}