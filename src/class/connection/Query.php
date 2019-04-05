<?php

namespace Connection;

class Query
{
  private static $queries  = array(
    //Book queries
    'getBook' => 'SELECT id, title, genre, pages FROM books WHERE id =:bookid',
    'getBooklist' => 'SELECT id, title FROM books',
    'getBooklistFromUser' => 'SELECT u.book_id, b.title, b.genre, u.status FROM user_books u LEFT JOIN books b ON b.id = u.book_id WHERE u.user_id = ? AND u.status = 1',
    'checkStatus' => 'SELECT status FROM user_books WHERE user_id=:userid AND book_id=:bookid',
    'setStatus' => 'INSERT INTO user_books(user_id, book_id, status) VALUES(?, ?, 1)',
    'savePoints' => 'UPDATE users SET points = points + ? WHERE id = ?',
    
    //User queries
    'getProfile' => 'SELECT name, points FROM users WHERE id = ?',
    'getTrophies' => 'SELECT Count(u.book_id) AS quantity, b.genre FROM user_books u LEFT JOIN books b ON b.id = u.book_id WHERE u.user_id = ? AND u.status = 1 GROUP BY b.genre ORDER BY quantity DESC', 
    'getRankingList' => 'SELECT id, name, points FROM users ORDER BY points DESC LIMIT 10',

    //Login queries
    'verify' => 'SELECT id, name FROM users WHERE login=? AND password=?',
    
  );
  public static function get($functionName) {
    return self::$queries[$functionName];
  }
}