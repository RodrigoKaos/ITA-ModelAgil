<?php

$app = new App();

?>

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
        foreach( $app->getRankingList() as $user ){ ?>
            <tr>
                <td><?php echo $position; $position++; ?></td>
                <td><?php echo $user->U_NAME; ?></td>
                <td><?php echo $user->U_POINTS;?></td>
            </tr>
        <?php } ?>
    </table>

</div>