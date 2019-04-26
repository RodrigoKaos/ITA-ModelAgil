<?php getHeader(); ?>

<div class="ranking content">
  <h1>Ranking</h1>
  <table class="center">
    <tr>
      <th>Position</th>
      <th>Name</th>
      <th>Points</th>
    </tr>

    <?php 
    $position = 1;
    foreach( $rankList as $user ){ ?>
      <tr>
        <td><?php echo $position; $position++; ?></td>
        <td><?php echo $user->name; ?></td>
        <td><?php echo $user->points;?></td>
      </tr>
    <?php } ?>
  </table>
</div>

<?php getFooter(); ?>