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
         $_SESSION['noResultFromBilans'] = 'Brak wyników dla wybranego okresu';
         header("location: ../balancePeriod.php");
         
         //exit();
      }

         $currentMonthBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['currentMonthBalance'] = $currentMonthBalance;
         $stmt = NULL;
   }


}