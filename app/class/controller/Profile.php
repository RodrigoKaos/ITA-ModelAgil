<?php

namespace Controller;

use Network\IhttpGet;
use DAO\User;
use DAO\Login;
use DAO\Book;

class Profile implements IhttpGet {
  
  public static function get($args){
    if(!Login::isLogged())
      header("Location: /login");

    $userId = $args[1];
    $user = User::getProfile( $userId );
    $bookList = Book::getBookListFromUser($userId);
    $booksByGenre = User::getTrophies($userId);
    require 'app/view/profile.php';
  }  

}