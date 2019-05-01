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
    $trophiesTemplate = '';
    $bookListTemplate = '';

    if(count($bookList) > 0){
      $booksByGenre = User::getTrophies($userId);
      if( $booksByGenre[0]->quantity > 4){
        foreach ($booksByGenre as $book) {
          if( $book->quantity > 4 ){
            $arr = array('book.genre' => $book->genre);
            $templateAux = Renderer::load('/profile/trophies.tpl.html');
            $templateAux = Renderer::parseData($templateAux, $arr);
            $trophiesTemplate .= $templateAux;
          }
        }
      }

      foreach( $bookList as $book ){
        $arr = array(
          'book.title' => $book->title,
          'book.genre' => $book->genre
        );
        $templateAux = Renderer::load('/profile/bookItem.tpl.html');
        $templateAux = Renderer::parseData($templateAux, $arr);
        $bookListTemplate .= $templateAux;
      }
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