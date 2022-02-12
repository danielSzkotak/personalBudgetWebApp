<?php

class Categories extends Dbh {

   protected function getIncomeCategories($userID){

      $stmt = $this->connect()->prepare('SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id=?;');
      
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

         $_SESSION['incomeUserCat'] = $categories;
   
         $stmt = NULL;
   }

   protected function getExpenseCategories($userID){

      $stmt = $this->connect()->prepare('SELECT id, name FROM expenses_category_assigned_to_users WHERE user_id=?;');
      
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
         $_SESSION['expenseUserCat'] = $categories;      
                 
         $stmt = NULL;
   }

   protected function getPaymentMethods($userID){

      $stmt = $this->connect()->prepare('SELECT id, name  FROM payment_methods_assigned_to_users WHERE user_id=?;');
      
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
         $_SESSION['paymentUserMet'] = $paymentMethods;
                 
         $stmt = NULL;
   }

}