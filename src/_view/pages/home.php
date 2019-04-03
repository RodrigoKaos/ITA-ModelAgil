<?php

use Main\App;

$app = new App();

?>

<div class="home content">

    <h1>Book List</h1>
    
    <div class="book list center">
        <?php foreach( $app->getBookList() as $book ){ ?>
            <div class="book item">
                <img src="assets/img/default_book.jpg" alt="Default book image">
                <h3>
                    <a href="?book=<?php echo $book->B_ID; ?>">
                        <?php echo $book->B_TITLE; ?>
                    </a>
                </h3>
            </div>
        <?php } ?>
    </div>

</div>