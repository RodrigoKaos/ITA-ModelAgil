<?php

namespace Controllers;

use DAO\Book;
use DAO\Login;
use View\Renderer;
use Network\Router;

class Controller
{
    protected $router;
    protected $renderer;
    protected $loginDAO;
    protected $bookDAO;

    function __construct() {
      $this->router = new Router();
      $this->renderer = new Renderer();
      $this->loginDAO = new Login();
      $this->bookDAO = new Book();
    }
}