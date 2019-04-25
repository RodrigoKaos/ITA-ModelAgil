<?php

getHeader();

?>

<div class="profile content">
  <h1><?php echo $user->name; ?></h1>
  <span class="points"><?php echo $user->points; ?> points</span>

  <?php if( $booksByGenre[0]->quantity > 4){ ?>
    <div class="trophies">
      <?php foreach ($booksByGenre as $book) {
        if( $book->quantity > 4 )
          echo '<h3><em>' . $book->genre . '\'s Reader</em></h3>';
        }
      ?>
    </div>    
  <?php } ?>

  <div class="book read">
    <span>
      <strong><?php echo count($bookList) . " ";?> Books read</strong>
    </span>

    <?php if(count($bookList) > 0): ?>
      <table class="center">
      <tr>
        <th>Title</th>
        <th>Genre</th>
        <th></th>
      </tr>

      <?php foreach( $bookList as $item ){ ?>        
        <tr>
          <td><?php echo $item->title; ?></td>
          <td><?php echo $item->genre; ?></td>
          <td><?php if( $item->status) echo "Já li!!"; ?></td>
        </tr>
      <?php } ?>            
      </table>
    <?php endif; ?>
  </div>
</div>

<?php getFooter(); ?>