<div class="login content">
    <h1 class="title">Esse eu já li!</h1>
    
    <form class="login" method="post">
        <div class="login field">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" pattern="^\w+$" required>
        </div>
        
        <div class="password field">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="button field">
            <button type="submit">Login</button>
        </div>
    </form>

    <?php if( isset($_SESSION['LOGERROR']) ) { ?>
        <div class="alert error">
            <?php echo $_SESSION['LOGERROR']; ?>
    </div>
    <?php } ?>

</div>