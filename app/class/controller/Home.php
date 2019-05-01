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
    
    $bookListStr = "";
    foreach (Book::getBookList() as $book) {
      $bookListStr .= self::book2Html($book);
    }
    $arr = array(
      'page.title' => 'Home',
      'bookList' => $bookListStr
    );
    Renderer::renderTemplate('/home.php', $arr); 
  }

  private function book2Html($book){//REFACTOR
    $imgStr = "<img src='public/assets/img/default_book.jpg' alt='Default book image'>";
    
    $titleStr = " <h3><a href='/book/%s'>%s</a></h3>";
    $titleStr = sprintf($titleStr, $book->id, $book->title);
    
    $divStr = "<div class='book item'> %s %s </div>";
    $bookHtml = sprintf($divStr, $imgStr, $titleStr);
    return $bookHtml;
  }

}