<?php

namespace Controllers;

use DAO\User;
use Network\IHTTPGet;
use Controllers\Controller;

class Ranking extends Controller implements IHTTPGet {
  
  public function get($args) {
    
    if(!$this->loginDAO->isLogged()){
      $this->router->redirect("/login");
    }
    
    $user = new User();
    $rankList = $user->getRankingList();
    
    $position = 1;
    foreach( $rankList as $user ){
      $arr = array(
        'user.position' => $position,
        'user.name' => $user->name,
        'user.points' => $user->points
      );
      $rankingTemplate .= $this->renderer->loadAndParse(
                                        '/ranking/rankingItem.tpl.html', $arr);
      $position++;
    }

    $data = array(
      'page.title' => 'Ranking',
      'rankingList' => $rankingTemplate
    );
    
    $this->renderer->renderTemplate('/ranking/index.tpl.html', $data);
  }
}