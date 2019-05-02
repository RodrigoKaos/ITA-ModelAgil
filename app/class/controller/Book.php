<?php

namespace Controller;

use DAO\Login;
use View\Renderer;
use Network\Router;
use Network\IhttpGet;
use Network\IhttpPost;
use DAO\Book as BookDAO;

class Book implements IhttpGet, IhttpPost {
  
  public static function get($args){ //TODO: update variables
    if(!Login::isLogged())
      Router::redirect("/login");

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

    $data = array(
      'page.title' => $book->title,
      'book.id' => $book->id,
      'book.status'=> $book->status,
      'book.str_status' => $str_status,
      'book.title' => $book->title,
      'book.genre' => $book->genre,
      'book.total_pages' => $book->total_pages,
    );
    Renderer::renderTemplate('/book/index.tpl.html', $data);
  } 

  public static function post($args){    
    if(! empty( $_POST ) ){
      if( isset( $_POST['book']) && isset($_POST['status']) ){
        self::markBook($_POST['book'], $_SESSION['UID']);
        Router::redirect("/book" . DIRECTORY_SEPARATOR . $_POST['book']);
      }
    }        
  }

  private function markBook($bookId, $userId) {    
    //TODO: Add rollback...
    $marked = BookDAO::setStatus($bookId, $userId);
    if($marked){
      $points = self::calculatePointsByPages(BookDAO::getBook($bookId)->total_pages);
      $saved = BookDAO::savePoints($userId, $points);
    }
  }

  private function calculatePointsByPages($pages){
    return $pages > 99 ? 1 + intdiv($pages, 100) : 1; 
  }

}