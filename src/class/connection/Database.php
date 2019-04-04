<?php

namespace Connection;

use PDO;
use PDOException;

require 'database.config.php';

class Database
{
  private static $databaseConnection;

  private function __contruct(){}

  public static function getConnection(){
    try {
      if(!isset(self::$databaseConnection))
      self::$databaseConnection = new PDO( DB_DSN, DB_USER, DB_PASS, DB_OPT );
    } catch (PDOException $e) {
      print "Error: " . $e->getMessage() . "<br/>";
    }
    return self::$databaseConnection;
  }

  public static function select($params, $query){
    $connection = self::getConnection();
    try {
      $statement = $connection->prepare($query);
      foreach ($params as $key => $value) {
        $statement->bindParam(
                      $key + 1, 
                      $params[$key], 
                      PDO::PARAM_STR);
      }    
      $statement->execute();
      
      if( $statement->rowCount() > 0 )
        return $statement->fetch( PDO::FETCH_OBJ );

    } catch (PDOException $e) {
      print "Error: " . $e->getMessage() . "<br/>";
    }
    return false;
  }  
}