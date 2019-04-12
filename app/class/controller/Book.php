<?php

namespace Controller;

use DAO\Book as BookDAO;
use Main\App;
use Network\IhttpGet;
use Network\IhttpPost;

class Book implements IhttpGet, IhttpPost {
  
  public static function get($args){ //TODO: update variables
    $book = BookDAO::getBook($_GET['book']);
    $book_status = BookDAO::checkStatus( $_GET['book'], $_SESSION['UID'] );

    if( empty($book_status) )
      $book_status = 0;

    $str_status = '';
    if( $book_status )
      $str_status = "disabled";

    require 'app/view/Book.php';        
  }

  public static function post($args){    

    if(! empty( $_POST ) ){
      if( isset( $_POST['book']) && isset($_POST['status']) ){
        $app = new App();
        $app->markBook($_POST['book'], $_SESSION['UID']);
      }
    }        
  }

}