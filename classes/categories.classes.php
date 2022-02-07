<?php

class Categories extends Dbh {

   protected function getIncomeCategories($userID){

      $stmt = $this->connect()->prepare('SELECT * FROM incomes_category_assigned_to_users WHERE user_id=?;');
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../index.php?error=bladzapytaniastmt");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         header("location: ../login.php?zerowierszy");
         exit();
      }

         $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

         //session_start();

         $incomeUserCategories = [];

            foreach ($categories as $value){ 
               array_push($incomeUserCategories, $value['name']);
            }
            $_SESSION['incomesCategories'] = $incomeUserCategories;
         $stmt = NULL;
   }

   protected function getExpenseCategories($userID){

      $stmt = $this->connect()->prepare('SELECT * FROM expenses_category_assigned_to_users WHERE user_id=?;');
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../index.php?error=bladzapytaniastmt");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         header("location: ../login.php?zerowierszy");
         exit();
      }

         $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

         //session_start();
         $expenseUserCategories = [];

            foreach ($categories as $value){ 
               array_push($expenseUserCategories, $value['name']);
            }
            $_SESSION['expenseCategories'] = $expenseUserCategories;
                 
         $stmt = NULL;
   }

   protected function getPaymentMethods($userID){

      $stmt = $this->connect()->prepare('SELECT * FROM payment_methods_assigned_to_users WHERE user_id=?;');
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../index.php?error=bladzapytaniastmt");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         header("location: ../login.php?norowsIncategories");
         exit();
      }

         $paymentMethods = $stmt->fetchAll(PDO::FETCH_ASSOC);

         //session_start();
         $userPaymentMethods = [];

            foreach ($paymentMethods as $value){ 
               array_push($userPaymentMethods, $value['name']);
            }
            $_SESSION['paymentMethods'] = $userPaymentMethods;
                 
         $stmt = NULL;
   }

}