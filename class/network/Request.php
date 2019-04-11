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
    $this->$params = explode('/', $req['REQUEST_URI']);
  }
  
}