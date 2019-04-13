<?php

namespace DAO;

use Connection\Query;
use Connection\Database;

class Book {
  
  public static function getBook($id) {
    return Database::select([$id], Query::get(__FUNCTION__), true);
  }

  public static function getBooklist() {
    return Database::queryAll(Query::get(__FUNCTION__));
  }

  public static function getBooklistFromUser($id) {
    return Database::select([$id], Query::get(__FUNCTION__));
  }

  public static function checkStatus($bookId, $userId) {
    return Database::select([$userId, $bookId], Query::get(__FUNCTION__), true)->status;
  }

  public static function setStatus($bookId, $userId) {
    //TODO: Refactor to change status
    return Database::insert([$userId, $bookId], Query::get(__FUNCTION__), true);
  }

  public static function savePoints($userId, $points) {
    return Database::update([$points, $userId], Query::get(__FUNCTION__));
  }

}