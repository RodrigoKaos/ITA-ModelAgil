<?php

namespace Controller;

use DAO\Book;
use DAO\User;
use DAO\Login;
use View\Renderer;
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

    if($bookListCount > 0){
      $booksByGenre = User::getTrophies($userId);
      if( $booksByGenre[0]->quantity > 4){
        foreach ($booksByGenre as $book) {
          if( $book->quantity > 4 ){
            $arr = array('book.genre' => $book->genre);
            $trophiesTemplate .= Renderer::loadAndParse('/profile/trophies.tpl.html', $arr);
          }
        }
      }

      foreach( $bookList as $book ){
        $arr = array(
          'book.title' => $book->title,
          'book.genre' => $book->genre
        );
        $bookItemsTemplate .= Renderer::loadAndParse('/profile/bookItem.tpl.html', $arr);
      }

      $bookListTemplate = Renderer::loadAndParse(
                                '/profile/bookList.tpl.html',
                                array('bookItems' => $bookItemsTemplate));
    }

    $data = array(
      'page.title' => $user->name,
      'user.name' => $user->name,
      'user.points' => $user->points,
      'book.count' => $bookListCount,
      'user.trophies' => $trophiesTemplate,
      'bookList' => $bookListTemplate
    );

    Renderer::renderTemplate('/profile/index.tpl.html', $data);
  }  

}