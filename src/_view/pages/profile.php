<?php

$app = new App();
$userId = $_GET['profile'];
$user = $app->getProfile( $userId );
$bookList = $app->getBookListFromUser($userId);
$booksByGenre = $app->getTrophies($userId);

?>

<div class="profile content">
    <h1><?php echo $user->U_NAME; ?></h1>
    <span class="points"><?php echo $user->U_POINTS; ?> points</span>
    
    <?php if( $booksByGenre[0]->B_QUANTITY > 4){ ?>
        <div class="trophies">
            <?php 
                foreach ($booksByGenre as $book) {
                    if( $book->B_QUANTITY > 4 )
                        echo '<h3><em>' . $book->B_GENRE . '\'s Reader</em></h3>';
                }
            ?>
        </div>    
    <?php } ?>
    
    <div class="book read">
        <span>
            <strong>
                <?php echo count($bookList) . " ";?>
                Books read
            </strong>
        </span>
        
        <?php if(count($bookList) > 0): ?>
            <table class="center">
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th></th>
                </tr>
                
                <?php foreach( $bookList as $book ){ ?>        
                    <tr>
                        <td><?php echo $book->B_TITLE; ?></td>
                        <td><?php echo $book->B_GENRE; ?></td>
                        <td><?php if( $book->UB_STATUS) echo "Já li!!"; ?></td>
                    </tr>
                <?php } ?>            
            </table>
        <?php endif; ?>

    </div>

</div>