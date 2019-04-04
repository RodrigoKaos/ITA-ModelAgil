<?php

use DAO\Book;
use Main\App;

$app = new App();

if(! empty( $_POST ) ){
  if( isset( $_POST['book']) && isset($_POST['status']) ){
    $app->markBook( $_SESSION['UID'], $_POST['book'] );
  }
}

$book = Book::getBook($_GET['book']);
$book_status = Book::checkStatus( $_GET['book'], $_SESSION['UID'] );

if( empty($book_status) )
  $book_status = 0;

$str_status = '';
if( $book_status )
  $str_status = "disabled";

?>

<div class="book content">
  <div class="book info">
      
    <h1><?php echo $book->B_TITLE; ?></h1>
    <?php echo $book->B_GENRE . "<br>"; ?>
    <?php echo $book->B_PAGES . " pages"; ?>
    
    <form method="post">            
      <input type="hidden" name="book" value="<?php echo $book->B_ID;?>">
      <input type="hidden" name="status" value="<?php echo $book_status;?>">
      <button type="submit"<?php echo $str_status; ?> >Já li!</button>        
    </form>
  </div>

</div>