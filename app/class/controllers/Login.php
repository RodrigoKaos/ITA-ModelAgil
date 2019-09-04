<?php

namespace Controllers;

use Network\IHTTPGet;
use Network\IHTTPPost;
use Controllers\Controller;

class Login extends Controller implements IHTTPGet, IHTTPPost {
  
  public function get($args) {
    
    if($this->loginDAO->isLogged())
      $this->router->redirect('/home');
    
    if(isset($_SESSION['LOGERROR'])){
      $arr = array(
        'error' => $_SESSION['LOGERROR']
      );
      $errTemplate = $this->renderer->loadAndParse(
                                        '/login/error.tpl.html', $arr);   
    }
    
    $arr = array(
      'page.title' => 'Login',
      'msg.error' => $errTemplate
    );
    $this->renderer->renderTemplate('/login/index.tpl.html', $arr); 
  }

  public function post($args) {
    
    if( !empty($_POST) ){
      if( isset($_POST['login'])  && isset($_POST['password']) ) {
        $user = $this->loginDAO->verify($_POST['login'], $_POST['password']);

        if( !$user ) {
          $err_msg = 'Invalid username or password...';
          $_SESSION['LOGERROR'] = $err_msg;
        } else {
          $_SESSION['UID'] = $user->id;
          $_SESSION['UNAME'] = $user->name;
        }
        $this->router->redirect("/home");
      }
    }
  }
}