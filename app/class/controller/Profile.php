<?php

namespace Controller;

use DAO\Book;
use DAO\User;
use DAO\Login;
use Network\Router;
use Network\IhttpGet;

class Profile implements IhttpGet {
  
  public static function get($args){
    if(!Login::isLogged())
      Router::redirect("/login");

    $userId = $args[1];
    $user = User::getProfile( $userId );
    $bookList = Book::getBookListFromUser($userId);
    
    $bookListCount = count($bookList);
    $trophiesTemplate = '';
    $bookListTemplate = '';

    if(count($bookList) > 0){
      $booksByGenre = User::getTrophies($userId);
      if( $booksByGenre[0]->quantity > 4){
        foreach ($booksByGenre as $book) {
          if( $book->quantity > 4 ){
            #load thophies template and parse variables
          }
        }
      }

      foreach( $bookList as $book ){
         #load bookItem template and parse variables
      }


    }

    $data = array(
      'user.name' => $user->name,
      'user.points' => $user->points,
      'book.count' => $bookListCount,
      'user.trophies' => $trophiesTemplate,
      'bookList' => $bookListTemplate
    );

    require 'app/view/profile.php';
  }  

}