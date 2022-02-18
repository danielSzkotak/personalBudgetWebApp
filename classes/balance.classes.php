<?php

class Balance extends Dbh {

   protected function getCurrentMonthBalance($userID){

      $firstDayOfTheMonth = date('Y-m-01');
      $lastDayOfTheMonth = date('Y-m-t');

      $stmt = $this->connect()->prepare("SELECT incomes_category_assigned_to_users.name, ROUND(SUM(incomes.amount),2) AS category_sum FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id) GROUP BY incomes_category_assigned_to_users.name ORDER BY category_sum DESC;");

      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromBalance'] = 'Brak wyników dla wybranego okresu';
         header("location: ../balancePeriod.php");
         //exit();
      }

         $currentMonthBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['balance'] = $currentMonthBalance;
         $stmt = NULL;
   }

   protected function getCurrentMonthSum($userID){

      $firstDayOfTheMonth = date('Y-m-01');
      $lastDayOfTheMonth = date('Y-m-t');

      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(incomes.amount),2) AS total FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromBalance'] = 'Brak sumy dla wybranego okresu';
         header("location: ../balancePeriod.php?brakSumy");
         //exit();
      }

         $currentMonthSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['total'] = $currentMonthSum;
         $stmt = NULL;
        
   }

   protected function getPreviousMonthBalance($userID){

      $firstDayOfTheMonth = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
      $lastDayOfTheMonth = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));

      $stmt = $this->connect()->prepare("SELECT incomes_category_assigned_to_users.name, ROUND(SUM(incomes.amount),2) AS category_sum FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id) GROUP BY incomes_category_assigned_to_users.name ORDER BY category_sum DESC;");
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromBalance'] = 'Brak wyników dla wybranego okresu';
         header("location: ../balancePeriod.php");
         
         //exit();
      }

         $previousMonthBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['balance'] = $previousMonthBalance;
         $stmt = NULL;
   }

   protected function getPrevioustMonthSum($userID){   

      $firstDayOfTheMonth = date("Y-m-01", mktime(0, 0, 0, date("m")-1, 1));
      $lastDayOfTheMonth = date("Y-m-t", mktime(0, 0, 0, date("m"), 0));

      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(incomes.amount),2) AS total FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromBalance'] = 'Brak sumy dla wybranego okresu';
         header("location: ../balancePeriod.php?brakSumy");
         //exit();
      }

         $previousMonthSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['total'] = $previousMonthSum;
         $stmt = NULL;
        
   }

   protected function getCurrentYearBalance($userID){

      $firstDayOfTheYear = date("Y-01-01");
      $lastDayOfTheYear = date('Y') . '-12-31';

      $stmt = $this->connect()->prepare("SELECT incomes_category_assigned_to_users.name, ROUND(SUM(incomes.amount),2) AS category_sum FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$firstDayOfTheYear' AND '$lastDayOfTheYear') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id) GROUP BY incomes_category_assigned_to_users.name ORDER BY category_sum DESC;");
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromBalance'] = 'Brak wyników dla wybranego okresu';
         header("location: ../balancePeriod.php");
         
         //exit();
      }

         $currentYearBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['balance'] = $currentYearBalance;
         $stmt = NULL;
   }

   protected function getCurrentYearSum($userID){   

      $firstDayOfTheYear = date("Y-01-01");
      $lastDayOfTheYear = date('Y') . '-12-31';

      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(incomes.amount),2) AS total FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$firstDayOfTheYear' AND '$lastDayOfTheYear') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromBalance'] = 'Brak sumy dla wybranego okresu';
         header("location: ../balancePeriod.php?brakSumy");
         //exit();
      }

         $currentYearSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['total'] = $currentYearSum;
         $stmt = NULL;
        
   }


}