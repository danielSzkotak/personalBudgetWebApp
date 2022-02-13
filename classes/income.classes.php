<?php

class Income extends Dbh {

   protected function addIncome($uID, $category, $amount, $date){

      $stmt = $this->connect()->prepare('INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income) 
               VALUES (?, ?, ?, ?)');

      
      if(!$stmt->execute(array($uID, $category, $amount, $date))){
         $stmt = null;
         header("location: ../addIncome.php?error=stmtfailed");
         exit();
      }

      $stmt = NULL;
     
   }

}