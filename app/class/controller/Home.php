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
    
    // $bookListTemplate = "";
    foreach (Book::getBookList() as $book) {
      $arr = array(
        'book.id' => $book->id,
        'book.title' => $book->title
      );
      $bookListTemplate .= Renderer::loadAndParse('/home/bookItem.tpl.html', $arr);
    }

    $data = array(
      'page.title' => 'Home',
      'bookList' => $bookListTemplate
    );
    Renderer::renderTemplate('/home/index.tpl.html', $data); 
  }

}