<?php

namespace DAO;

use Connection\Query;
use Connection\Database;

class Book {
  
  public function getBook($id) {
    return Database::select([$id], Query::get(__FUNCTION__), true);
  }

  public function getBooklist() {
    return Database::queryAll(Query::get(__FUNCTION__));
  }

  public function getBooklistFromUser($id) {
    return Database::select([$id], Query::get(__FUNCTION__));
  }

  public function checkStatus($bookId, $userId) {
    return Database::select([$userId, $bookId], Query::get(__FUNCTION__), true)->status;
  }

  public function setStatus($bookId, $userId) {
    //TODO: Refactor to change status
    return Database::insert([$userId, $bookId], Query::get(__FUNCTION__), true);
  }

  public function savePoints($userId, $points) {
    return Database::update([$points, $userId], Query::get(__FUNCTION__));
  }

}