<?php

namespace DAO;

use Connection\Database;

class User {

  public static function getProfile($id) {
    $query = 'SELECT U_NAME, U_POINTS FROM USERS WHERE U_ID = ?';
    return Database::select([$id], $query, true);
  }

  public static function getTrophies($id) {
    $query = 'SELECT Count(u.UB_BOOK_ID) AS B_QUANTITY, b.B_GENRE    
    FROM USER_BOOKS u LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID     
    WHERE u.UB_USER_ID = ? AND u.UB_STATUS = 1
    GROUP BY b.B_GENRE ORDER BY B_QUANTITY DESC';
    return Database::select([$id], $query);
  }

  public static function getRankingList() {
    $query = 'SELECT U_ID, U_NAME, U_POINTS FROM USERS 
              ORDER BY U_POINTS DESC LIMIT 10';
    return Database::queryAll($query);
  }

}