<?php

namespace Controllers;

use Network\IHTTPGet;
use Controllers\Controller;

class Logout extends Controller implements IHTTPGet
{
    public function get($args) {
      session_start();
      session_destroy();
      $this->router->redirect("/");
    }
}