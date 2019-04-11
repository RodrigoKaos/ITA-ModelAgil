<?php

namespace Network;

class Request
{
  public $method;
  public $uri;
  public $params;

  public function __construct($req){
    $this->method = strtolower($req['REQUEST_METHOD']);
    $this->uri = $req['REQUEST_URI'];
    $this->params = $this->parseUriToParams($req['REQUEST_URI']);
  }

  private function parseUriToParams($uri){
    $params = explode('/', $uri);
    $newParams = [];
    
    $length = sizeof($params);
    for ($i=1; $i < $length; $i++) { 
      $newParams[] = $params[$i];
    }
    $newParams[0] = "/$newParams[0]";
    return $newParams;
  }
  
}