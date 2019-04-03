<?php

require 'config.php';

function __autoload($fullClassName){
  $namespaces = explode('\\', $fullClassName);
  $className = end($namespaces);
  unset( $namespaces[sizeof($namespaces)-1]);  
  $path = strtolower(join('/', $namespaces));
  $fullClassName = $path . DIRECTORY_SEPARATOR . $className;
  require $fullClassName . '.php';
}

?>