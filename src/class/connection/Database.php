<?php

namespace Connection;

use PDO;
use PDOException;

require 'database.config.php';

class Database
{
  private static $databaseConnection;

  private function __contruct(){}

  public static function getConnection() {
    try {
      if(!isset(self::$databaseConnection))
      self::$databaseConnection = new PDO( DB_DSN, DB_USER, DB_PASS, DB_OPT );
    } catch (PDOException $e) {
      print "getConnection - Error: " . $e->getMessage() . "<br/>";
    }
    return self::$databaseConnection;
  }

  public static function select(array $params, $query, bool $bind = false) {
    $connection = self::getConnection();
    try {
      $statement = self::prepare($query);
      
      if($bind){
        self::binding($params, $statement);
        $statement->execute();
      } else {
        $statement->execute($params);
        return $statement->fetchAll( PDO::FETCH_OBJ );
      }

      if( $statement->rowCount() > 0 )
        return $statement->fetch( PDO::FETCH_OBJ );      
      
      return false;
      
    } catch (PDOException $e) {
      print "Select - Error: " . $e->getMessage() . "<br/>";
    }
    return false;
  }

  public static function queryAll($query) {
    $connection = self::getConnection();
    try {
      return $connection->query($query)
                        ->fetchAll(PDO::FETCH_OBJ);
    
    } catch (PDOException $e) {
      print "SelectAll - Error: " . $e->getMessage() . "<br/>";
    }
  }

  private function prepare($query) {
    return self::$databaseConnection->prepare($query);
  }
  
  private function binding(array $params, $statement) {
    //TODO: Identify the type of the parameter
    foreach ($params as $key => $value) {
      $statement->bindParam($key+1, $params[$key], PDO::PARAM_STR);
    }   
  }

  public static function insert(array $params, $query) {
    $statement = self::prepare($query);
    return $statement->execute($params);
  }
}

