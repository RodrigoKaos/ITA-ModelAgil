<?php

namespace Controller;

use DAO\Book as BookDAO;
use Main\App;
use Network\Router;
use Network\IhttpGet;
use Network\IhttpPost;

class Book implements IhttpGet, IhttpPost {
  
  public static function get($args){ //TODO: update variables
    $book = null;
    $bookId = intval($args[1]);//TODO: refactor
    
    if(intval($bookId) > 0){
      $book = BookDAO::getBook($bookId);
      $book_status = BookDAO::checkStatus( $bookId, $_SESSION['UID'] );

      if( empty($book_status) )
        $book_status = 0;
  
      $str_status = '';
      if( $book_status )
        $str_status = "disabled";
    }else {//TODO:Fix
      $book = new \stdClass();
      $book->title = "Book not found!";
    }

    require 'app/view/Book.php';        
  } 

  public static function post($args){    
    if(! empty( $_POST ) ){
      if( isset( $_POST['book']) && isset($_POST['status']) ){
        $app = new App();
        $app->markBook($_POST['book'], $_SESSION['UID']);
        Router::redirect("/book" . DIRECTORY_SEPARATOR . $_POST['book']);
      }
    }        
  }

}