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

            foreach ($categories as $value)
            { 
               array_push($incomeUserCategories, $value['name']);
               //echo $name['name'];
            }

            $_SESSION['categories'] = $incomeUserCategories;
        
         $stmt = NULL;

   }


}