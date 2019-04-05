<?php

namespace Connection;

class Query
{
  private static $queries  = array(
    //Book queries
    'getBook' => 'SELECT B_ID, B_TITLE, B_GENRE, B_PAGES FROM BOOKS WHERE B_ID =:bookid',
    'getBooklist' => 'SELECT B_ID, B_TITLE FROM BOOKS',
    'getBooklistFromUser' => 'SELECT u.UB_BOOK_ID, b.B_TITLE, b.B_GENRE, u.UB_STATUS FROM USER_BOOKS u LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID WHERE u.UB_USER_ID = ? AND u.UB_STATUS = 1',
    'checkStatus' => 'SELECT UB_STATUS FROM USER_BOOKS WHERE UB_USER_ID=:userid AND UB_BOOK_ID=:bookid',
    'setStatus' => 'INSERT INTO USER_BOOKS(UB_USER_ID, UB_BOOK_ID, UB_STATUS) VALUES(?, ?, 1)',
    'savePoints' => 'UPDATE USERS SET U_POINTS = U_POINTS + ? WHERE U_ID = ?',
    
    //User queries
    'getProfile' => 'SELECT U_NAME, U_POINTS FROM USERS WHERE U_ID = ?',
    'getTrophies' => 'SELECT Count(u.UB_BOOK_ID) AS B_QUANTITY, b.B_GENRE FROM USER_BOOKS u LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID WHERE u.UB_USER_ID = ? AND u.UB_STATUS = 1 GROUP BY b.B_GENRE ORDER BY B_QUANTITY DESC', 
    'getRankingList' => 'SELECT U_ID, U_NAME, U_POINTS FROM USERS ORDER BY U_POINTS DESC LIMIT 10',

    //Login queries
    'verify' => 'SELECT U_ID, U_NAME FROM USERS WHERE U_LOGIN=? AND U_PASSWORD=?',
    
  );
  public static function get($functionName) {
    return self::$queries[$functionName];
  }
}