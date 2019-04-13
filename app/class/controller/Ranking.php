<?php

namespace Controller;

use Network\IhttpGet;
use DAO\User;

class Ranking implements IhttpGet {
  
  public static function get($args){
    if(!Login::isLogged())
      header("Location: /login");
      
    $rankList = User::getRankingList();
    require 'app/view/ranking.php';
  }  

}