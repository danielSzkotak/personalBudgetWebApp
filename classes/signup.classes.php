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

   protected function checkUser($uid){
      $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ?;');
      
      if(!$stmt->execute(array($uid))){
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

   protected function checkEmail($email){
      $stmt = $this->connect()->prepare('SELECT username FROM users WHERE email = ?;');
      
      if(!$stmt->execute(array($email))){
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