<?php

namespace DAO;

use Connection\Query;
use Connection\Database;

class User {

  public function getProfile($id) { 
    return Database::select([$id], Query::get(__FUNCTION__), true);
  }

  public function getTrophies($id) {
    return Database::select([$id], Query::get(__FUNCTION__));
  }

  public function getRankingList() {
    return Database::queryAll(Query::get(__FUNCTION__));
  }
}