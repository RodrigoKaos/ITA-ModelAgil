<?php

namespace Main;

use PDO;
use DAO\Book;
use DAO\Login;
use Connection\Database;

class App {
    
  private $dbConnection;

  public function __construct() {
    $this->dbConnection = Database::getConnection();
  }

  public function login() {
    if( !empty($_POST) ){
      if( isset($_POST['login'])  && isset($_POST['password']) ) {
        $result = Login::verify($_POST['login'], $_POST['password']);

        if( !$result ) {
          $err_msg = 'Invalid username or password...';
          $_SESSION['LOGERROR'] = $err_msg;
        } else {
          $_SESSION['UID'] = $result->U_ID;
          $_SESSION['UNAME'] = $result->U_NAME;
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
        $page_title = Book::getBook($_GET['book'])->B_TITLE;
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

  public function markBook($bookId, $userId, $status = 1) {
    //TODO: Add rollback...
    $marked = Book::setStatus($bookId, $userId, $status);
    if($marked){
      $points = $this->calculatePointsByPages(Book::getBook($bookId)->B_PAGES);
      $saved = $this->savePoints($userId, $points);
    }
  }

  private function calculatePointsByPages($pages){
    return $pages > 99 ? 1 + intdiv($pages, 100) : 1; 
  }

    private function savePoints($userId, $points){
        $pointsQuery = 'UPDATE USERS 
                            SET U_POINTS = U_POINTS + ? 
                            WHERE U_ID = ?';
        
        $this->dbConnection->prepare($pointsQuery)
                            ->execute([$points, $userId]);
    }

    public function getTrophies($userId){
        $trophiesQuery = 'SELECT 
                        Count(u.UB_BOOK_ID) AS B_QUANTITY, b.B_GENRE    
                        FROM USER_BOOKS u     
                        LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID     
                        WHERE u.UB_USER_ID = ? AND u.UB_STATUS = 1
                        GROUP BY b.B_GENRE ORDER BY B_QUANTITY DESC';
        $query = $this->dbConnection->prepare($trophiesQuery);
        $query->execute([$userId]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getBookListFromUser($userId){
        $listQuery = 'SELECT 
                        u.UB_BOOK_ID, b.B_TITLE, b.B_GENRE, u.UB_STATUS    
                        FROM USER_BOOKS u     
                        LEFT JOIN BOOKS b ON b.B_ID = u.UB_BOOK_ID  
                        WHERE u.UB_USER_ID = ? AND u.UB_STATUS = 1';
        $query = $this->dbConnection->prepare($listQuery);
        $query->execute([$userId]);
        return $query->fetchAll(PDO::FETCH_OBJ);

    }
    
    public function getRankingList(){
        $rankingQuery = 'SELECT U_ID, U_NAME, U_POINTS FROM USERS 
                            ORDER BY U_POINTS DESC
                            LIMIT 10';
        return Database::queryAll($rankingQuery);
    }

    public function getProfile($userId){
        $userQuery = 'SELECT U_NAME, U_POINTS FROM USERS 
                        WHERE U_ID = ?';
        $query = $this->dbConnection->prepare($userQuery);
        $query->execute([$userId]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}