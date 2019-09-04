<?php

namespace Controllers;

use Network\IHTTPGet;
use Network\IHTTPPost;
use Controllers\Controller;

class Book extends Controller implements IHTTPGet, IHTTPPost {

  public function get($args) { //TODO: update variables
    if(!$this->loginDAO->isLogged()) {
      $this->router->redirect("/login");
    }

    $book = null;
    $bookId = intval($args[1]);//TODO: refactor
    if(intval($bookId) > 0) {
      $book = $this->bookDAO->getBook($bookId);
      $book_status = $this->bookDAO->checkStatus( $bookId, $_SESSION['UID'] );

      if( empty($book_status) ) $book_status = 0;
  
      $str_status = '';
      if( $book_status ) $str_status = "disabled";

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
    $this->renderer->renderTemplate('/book/index.tpl.html', $data);
  } 

  public function post($args) {
    if(! empty( $_POST ) ){
      if( isset( $_POST['book']) && isset($_POST['status']) ){
        $this->markBook($_POST['book'], $_SESSION['UID']);
        $this->router->redirect("/book" . DIRECTORY_SEPARATOR . $_POST['book']);
      }
    }
  }

  private function markBook($bookId, $userId) {
    //TODO: Add rollback...
    $marked = $this->bookDAO->setStatus($bookId, $userId);
    if($marked){
      $points = $this->calculatePointsByPages(
                                $this->bookDAO->getBook($bookId)->total_pages);
      $saved = $this->bookDAO->savePoints($userId, $points);
    }
  }

  private function calculatePointsByPages($pages) {
    return $pages > 99 ? 1 + intdiv($pages, 100) : 1;
  }
}