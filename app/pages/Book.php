<?php

getHeader();

?>

<div class="book content">
  <div class="book info">
      
    <h1><?php echo $book->title; ?></h1>
    <?php echo $book->genre . "<br>"; ?>
    <?php echo $book->total_pages . " pages"; ?>
    
    <form method="post">            
      <input type="hidden" name="book" value="<?php echo $book->id;?>">
      <input type="hidden" name="status" value="<?php echo $book_status;?>">
      <button type="submit"<?php echo $str_status; ?> >Já li!</button>        
    </form>
  </div>

</div>

<?php getFooter(); ?>