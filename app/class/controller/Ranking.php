<?php

namespace Controller;

use DAO\User;
use DAO\Login;
use View\Renderer;
use Network\Router;
use Network\IhttpGet;

class Ranking implements IhttpGet {
  
  public static function get($args){
    if(!Login::isLogged())
      Router::redirect("/login");
      
    $rankList = User::getRankingList();
    $rankingTemplate = '';
      
    $position = 1;
    foreach( $rankList as $user ){
      $arr = array(
        'user.position' => $position,
        'user.name' => $user->name,
        'user.points' => $user->points
      );
      $templateAux = Renderer::load('/ranking/rankingItem.tpl.html');
      $templateAux = Renderer::parseData($templateAux, $arr);
      $rankingTemplate .= $templateAux;
      $position++;
    }

    $data = array(
      'page.title' => 'Ranking',
      'rankingList' => $rankingTemplate
    );
    
    Renderer::renderTemplate('/ranking/index.tpl.html', $data);
  }  

}