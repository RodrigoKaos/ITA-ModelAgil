<?php

namespace Controller;

use DAO\Book;
use DAO\Login;
use View\Renderer;
use Network\Router;
use Network\IhttpGet;

class Home implements IhttpGet {
  
  public static function get($args){
    if(!Login::isLogged()){
      Router::redirect("/login");// header("Location: /login");
    }
    
    $bookList = array();
    foreach (Book::getBookList() as $book) {
      $bookList[] = book2Html($book);
    }
    $view = new Renderer('home.php', array('bookList' => join(' ', $bookList))); 
  }

  private function book2Html($book){
    $imgStr = "<img src='public/assets/img/default_book.jpg' alt='Default book image'>";
    
    $titleStr = " <h3><a href='/book/%s'>%s</a></h3>";
    $titleStr = sprintf($titleStr, $book->id, $book->title);
    
    $divStr = "<div class='book item'> %s %s </div>";
    $bookHtml = sprintf($divStr, $imgStr, $titleStr);
    return $bookHtml;
  }

}