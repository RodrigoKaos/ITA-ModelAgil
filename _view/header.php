<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_title ?></title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <?php if( isset($_SESSION['UID']) ){ ?>
        <header>    
            Logged Header <a href="logout.php" class="logout">Logout</a>
        </header>
    <?php } ?>