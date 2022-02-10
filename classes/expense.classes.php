<?php

class Expense extends Dbh {

   protected function addExpense($uID, $categoryID, $paymentID, $amount, $date){

      $stmt = $this->connect()->prepare('INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense) 
         VALUES (?, ?, ?, ?, ?)');

      
      if(!$stmt->execute(array($uID, $categoryID, $paymentID, $amount, $date))){
         $stmt = null;
         header("location: ../addIncome.php?error=stmtfailed");
         exit();
      }

      $stmt = NULL;
     
   }

}