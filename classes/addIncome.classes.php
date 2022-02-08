<?php

class AddIncome extends Dbh {

   protected function addIncome($uID, $amount, $date, $category){
      $stmt = $this->connect()->prepare('INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income) 
               VALUES (?, ?, ?, ?);');

      
      if(!$stmt->execute(array($uID, $amount, $date, $category))){
         $stmt = null;
         header("location: ../addIncome.php?error=stmtfailed");
         exit();
      }

      $stmt = NULL;
     
   }

}