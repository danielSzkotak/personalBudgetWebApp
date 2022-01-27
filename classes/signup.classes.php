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

      protected function setCategories($uid){

      $stmtExpenses = $this->connect()->prepare('INSERT INTO expenses_category_assigned_to_users (user_id, name) SELECT users.id, expenses_category_default.name FROM expenses_category_default, users WHERE users.username=?;');

      $stmtIncomes = $this->connect()->prepare('INSERT INTO incomes_category_assigned_to_users (user_id, name) SELECT users.id, incomes_category_default.name FROM incomes_category_default, users WHERE users.username=?;');

      $stmtPayments = $this->connect()->prepare('INSERT INTO payment_methods_assigned_to_users (user_id, name) SELECT users.id, payment_methods_default.name FROM payment_methods_default, users WHERE users.username=?;');

      if((!$stmtExpenses->execute(array($uid))) || (!$stmtIncomes->execute(array($uid))) || (!$stmtPayments->execute(array($uid)))){
         $stmtExpenses = null;
         $stmtIncomes = null;
         $stmtPayments = null;
         header("location: ../index.php?error=copycategories");
         exit();
      }

      $stmtExpenses = null;
      $stmtIncomes = null;
      $stmtPayments = null;
     
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