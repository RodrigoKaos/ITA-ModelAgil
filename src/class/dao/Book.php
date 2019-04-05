<?php

namespace DAO;

use Connection\Database;

class Book {
  
  public static function getBook($id) {
    $query = 'SELECT B_ID, B_TITLE, B_GENRE, B_PAGES 
              FROM BOOKS WHERE B_ID =:bookid';
    return Database::select([$id], $query, true);
  }

  public static function getBooklist() {
    $query = 'SELECT B_ID, B_TITLE FROM BOOKS';
    return Database::queryAll($query);
  }

  public static function getBooklistFromUser($id) {
    $query = 'SELECT u.UB_BOOK_ID, b.B_TITLE, b.B_GENRE, u.UB_STATUS    
              FROM USER_BOOKS u LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID  
              WHERE u.UB_USER_ID = ? AND u.UB_STATUS = 1';
    
    return Database::select([$id], $query);
  }

  public static function checkStatus($bookId, $userId) {
    $query = 'SELECT UB_STATUS FROM USER_BOOKS WHERE UB_USER_ID=:userid 
              AND UB_BOOK_ID=:bookid';
    return Database::select([$userId, $bookId], $query, true)->UB_STATUS;
  }

  public static function setStatus($bookId, $userId) {
    $query = 'INSERT INTO USER_BOOKS(UB_USER_ID, UB_BOOK_ID, UB_STATUS)
              VALUES(?, ?, 1)';//TODO: Refactor to change status
    return Database::insert([$userId, $bookId], $query);
  }

  public static function savePoints($userId, $points) {
    $query = 'UPDATE USERS SET U_POINTS = U_POINTS + ? WHERE U_ID = ?';
    return Database::update([$points, $userId], $query);
  }

}