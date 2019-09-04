<?php

namespace Controllers;

use DAO\User;
use Network\IHTTPGet;
use Controllers\Controller;

class Profile extends Controller implements IHTTPGet {
  
  public function get($args) {
    
    if(!$this->loginDAO->isLogged()){
      $this->router->redirect("/login");
    }

    $userDAO = new User();
    $userId = $args[1];

    $bookList = $this->bookDAO->getBookListFromUser($userId);    
    $bookListCount = count($bookList);

    if($bookListCount > 0) {
      $booksByGenre = $userDAO->getTrophies($userId);
      if( $booksByGenre[0]->quantity > 4){
        foreach ($booksByGenre as $book) {
          if( $book->quantity > 4 ){
            $arr = array('book.genre' => $book->genre);
            $trophiesTemplate .= $this->renderer->loadAndParse(
                                      '/profile/trophies.tpl.html', $arr);
          }
        }
      }

      foreach( $bookList as $book ){
        $arr = array(
          'book.title' => $book->title,
          'book.genre' => $book->genre
        );
        $bookItemsTemplate .= $this->renderer->loadAndParse(
                                  '/profile/bookItem.tpl.html', $arr);
      }

      $bookListTemplate = $this->renderer->loadAndParse(
                                '/profile/bookList.tpl.html',
                                array('bookItems' => $bookItemsTemplate));
    }

    $user = $userDAO->getProfile( $userId );
    $data = array(
      'page.title' => $user->name,
      'user.name' => $user->name,
      'user.points' => $user->points,
      'book.count' => $bookListCount,
      'user.trophies' => $trophiesTemplate,
      'bookList' => $bookListTemplate
    );

    $this->renderer->renderTemplate('/profile/index.tpl.html', $data);
  }
}