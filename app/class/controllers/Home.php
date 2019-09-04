<?php

namespace Controllers;

use Network\IHTTPGet;
use Controllers\Controller;

class Home extends Controller implements IHTTPGet {
  
  public  function get($args) {

    if(! $this->loginDAO->isLogged()){
      $this->router->redirect("/login");
    }
       
    foreach ($this->bookDAO->getBookList() as $book) {
      $arr = array(
        'book.id' => $book->id,
        'book.title' => $book->title
      );
      $bookListTemplate .= $this->renderer->loadAndParse(
                              '/home/bookItem.tpl.html', $arr);
    }

    $data = array(
      'page.title' => 'Home',
      'bookList' => $bookListTemplate
    );
    $this->renderer->renderTemplate('/home/index.tpl.html', $data); 
  }
}