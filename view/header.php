<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_title ?> | Esse eu já li!</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/public/css/style.css">
    
</head>
<body class="center">
    <?php if( isset($_SESSION['UID']) ){ ?>
        <header>
            
            <div class="logo">
                <h1>
                    <a href="/">Esse eu já li!</a>
                </h1>
            </div>

            <nav class="menu">
                <a href="?ranking=<?php echo $_SESSION['UID']; ?>">Ranking</a>
                <a href="?profile=<?php echo $_SESSION['UID']; ?>">Profile</a>
                <a href="logout.php" class="logout">Logout</a>
            </nav>

        </header>
    <?php } ?>