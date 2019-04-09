<?php

function __autoload($fullClassName){
  $classFolder = 'class' . DIRECTORY_SEPARATOR;
  $namespaces = explode('\\', $fullClassName);
  $className = end($namespaces);
  unset( $namespaces[sizeof($namespaces)-1]);  
  $path = $classFolder . strtolower(join('/', $namespaces));
  $fullClassName = $path . DIRECTORY_SEPARATOR . $className;
  require $fullClassName . '.php';
}

?>