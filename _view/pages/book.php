<?php

$app = new App();
$book = $app->getBook($_GET['book']);

?>

<div class="book content">
    <div class="book info">
        
        <h1><?php echo $book->B_TITLE; ?></h1>
        <?php echo $book->B_GENRE . "<br>"; ?>
        <?php echo $book->B_PAGES . " pages"; ?>
        
        <form method="post">
            <input type="hidden" name="status" value="0">
            <button type="submit">Já li!</button>
        </form>

    </div>

</div>