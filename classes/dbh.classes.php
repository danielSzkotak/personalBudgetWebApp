<?php

class Dbh{

  protected function connect(){
    
      try {
         $username = "root";
         $password = "";
         $dbh = new PDO('mysql:host=localhost;dbname=personalBudget;charset=utf8', $username, $password, [
               PDO::ATTR_EMULATE_PREPARES => false,  
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]);

         return $dbh;
      } 
      catch (PDOException $e) {
         print "Error: " . $e->getMessage() . "<br/>";
         die();
      }
  }

 
}