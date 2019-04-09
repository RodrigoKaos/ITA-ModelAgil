<?php

namespace Main;

use PDO;
use DAO\Book;
use DAO\Login;
use Connection\Database;

class App {

  public function __construct() {}

  public function login() {
    if( !empty($_POST) ){
      if( isset($_POST['login'])  && isset($_POST['password']) ) {
        $user = Login::verify($_POST['login'], $_POST['password']);

        if( !$user ) {
          $err_msg = 'Invalid username or password...';
          $_SESSION['LOGERROR'] = $err_msg;
        } else {
          $_SESSION['UID'] = $user->id;
          $_SESSION['UNAME'] = $user->name;
        }        
      }
    }
  }

  private function isLogged() {
    return isset($_SESSION['UID']);
  }

  public function createView() {
    $str_view = '_view/pages/login.php';
    $page_title = 'Login';
    
    if( $this->isLogged() ){
      $str_view = '_view/pages/home.php';        
      $page_title = 'Home';
      
      if( isset( $_GET['book']) && $_GET['book'] != '' ){
        $str_view = '_view/pages/book.php';        
        $page_title = Book::getBook($_GET['book'])->title;
      }

      if( isset( $_GET['ranking']) && $_GET['ranking'] != '' ){
        $str_view = '_view/pages/ranking.php';        
        $page_title = 'Ranking';
      }

      if( isset( $_GET['profile']) && $_GET['profile'] != '' ){
        $str_view = '_view/pages/profile.php';        
        $page_title = 'Profile';
      }
    }
    
    include_once('_view/header.php');
    include_once( $str_view );
    include_once('_view/footer.php');
  }

  public function markBook($bookId, $userId) {
    //TODO: Add rollback...
    $marked = Book::setStatus($bookId, $userId);
    if($marked){
      $points = $this->calculatePointsByPages(Book::getBook($bookId)->total_pages);
      $saved = Book::savePoints($userId, $points);
    }
  }

  private function calculatePointsByPages($pages){
    return $pages > 99 ? 1 + intdiv($pages, 100) : 1; 
  }

}