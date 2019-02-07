<?php

class App{
    
    private $dbConnection;

    public function __construct(){
        include('config.php');
        $this->dbConnection = new PDO( $dsn, $user, $pass, $opt );
    }

    private function loginHelper($username, $password){
        try{
            $loginQuery = 'SELECT 
                            U_ID, U_NAME FROM USERS 
                        WHERE 
                            U_LOGIN=:login AND U_PASSWORD=:password';

            $query = $this->dbConnection->prepare( $loginQuery );
            $query->bindParam("login", $username, PDO::PARAM_STR);
            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->execute();

            if( $query->rowCount() > 0 )
                return $query->fetch( PDO::FETCH_OBJ );
        
        }catch( PDOException $e ){
            print "Error: " . $e->getMessage() . "<br/>";
        }

        return false;
    }

    public function login(){
        if(! empty( $_POST ) ){    
            if(
                isset( $_POST['login'] )  && 
                isset( $_POST['password'] ) 
            ){
                $result = $this->loginHelper(
                                    $_POST['login'], 
                                    $_POST['password'] );
                
                if( ! $result ){
                    $err_msg = 'Invalid username or password...';
                    $_SESSION['LOGERROR'] = $err_msg;
                }else{
                    $_SESSION['UID'] = $result->U_ID;
                    $_SESSION['UNAME'] = $result->U_NAME;
                }        
            }
        }
    }

    private function isLogged(){
        return isset($_SESSION['UID']);
    }

    public function createView(){
        $str_view = '_view/pages/home.php';        
        $page_title = 'Home';

        if( ! $this->isLogged() ){
            $str_view = '_view/pages/login.php';
            $page_title = 'Login';
        }
        
        include_once('_view/header.php');
        include_once( $str_view );
        include_once('_view/footer.php');
    }

    public function createHeader(){

    }

    
}