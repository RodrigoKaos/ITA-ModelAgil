<?php

namespace Controller;

use Network\IhttpGet;
use DAO\User;

class Ranking implements IhttpGet {
  
  public static function get($args){
    $rankList = User::getRankingList();
    require 'app/view/ranking.php';
  }  

}