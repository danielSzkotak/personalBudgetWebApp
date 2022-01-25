<?php

class Signup extends Dbh {

   protected function setUser($uid, $passwd, $email){
      $stmt = $this->connect()->prepare('INSERT INTO users (username, password, email) 
               VALUES (?, ?, ?);');

      $hashedPwd = password_hash($passwd, PASSWORD_DEFAULT);
      
      if(!$stmt->execute(array($uid, $hashedPwd, $email))){
         $stmt = null;
         header("location: ../index.php?error=stmtfailed");
         exit();
      }

      $stmt = NULL;

   }

   protected function checkUser($uid, $email){
      $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR email = ?;');
      
      if(!$stmt->execute(array($uid, $email))){
         $stmt = null;
         header("location: ../index.php?error=stmtfailed");
         exit();
      }

      
      if($stmt->rowCount() > 0){
         $resultCheck = false;
      } else {
         $resultCheck = true;
      }
      return $resultCheck;

   }

}