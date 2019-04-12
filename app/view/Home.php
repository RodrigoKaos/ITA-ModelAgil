<?php

use DAO\Book;

include 'app/view/header.php';
?>

<div class="home content">

  <h1>Book List</h1>
  
  <div class="book list center">
    <?php foreach( Book::getBookList() as $book ){ ?>
      <div class="book item">
        <img src="public/assets/img/default_book.jpg" alt="Default book image">
        <h3>
          <a href="?book=<?php echo $book->id; ?>">
              <?php echo $book->title; ?>
          </a>
        </h3>
      </div>
    <?php } ?>
  </div>

</div>

<?php include 'app/view/footer.php'; ?>