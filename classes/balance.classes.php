<?php

class Balance extends Dbh {


   //--------------------------Incomes Section-------------------------------//

   protected function getCurrentMonthIncomesBalance($userID){

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
         $_SESSION['noResultFromIncomesBalance'] = 'Brak wyników dla wybranego okresu';
        //header("location: ../balancePeriod.php");
         //exit();
      } else{
         
         $currentMonthBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['incomesBalance'] = $currentMonthBalance;
      }
         
         $stmt = NULL;
   }

   protected function getCurrentMonthIncomesSum($userID){

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
         $_SESSION['noResultFromIncomesBalance'] = 'Brak sumy dla wybranego okresu';
       // header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $currentMonthSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalIncomes'] = $currentMonthSum;
      }
         $stmt = NULL;
        
   }

   protected function getPreviousMonthIncomesBalance($userID){

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
         $_SESSION['noResultFromIncomesBalance'] = 'Brak wyników dla wybranego okresu';
        // header("location: ../balancePeriod.php");
         
         //exit();
      } else {

         $previousMonthBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['incomesBalance'] = $previousMonthBalance;
      }
         $stmt = NULL;
   }

   protected function getPrevioustMonthIncomesSum($userID){   

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
         $_SESSION['noResultFromIncomesBalance'] = 'Brak sumy dla wybranego okresu';
        // header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $previousMonthSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalIncomes'] = $previousMonthSum;
      }
         $stmt = NULL;
      
        
   }

   protected function getCurrentYearIncomesBalance($userID){

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
         $_SESSION['noResultFromIncomesBalance'] = 'Brak wyników dla wybranego okresu';
        // header("location: ../balancePeriod.php");
         
         //exit();
      } else {

         $currentYearBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['incomesBalance'] = $currentYearBalance;
      }
         $stmt = NULL;
   }

   protected function getCurrentYearIncomesSum($userID){   

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
         $_SESSION['noResultFromIncomesBalance'] = 'Brak sumy dla wybranego okresu';
         //header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $currentYearSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalIncomes'] = $currentYearSum;
      }
         $stmt = NULL;
        
   }

   protected function getCustomDatesIncomesBalance($userID, $startDate, $endDate){


      $stmt = $this->connect()->prepare("SELECT incomes_category_assigned_to_users.name, ROUND(SUM(incomes.amount),2) AS category_sum FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$startDate' AND '$endDate') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id) GROUP BY incomes_category_assigned_to_users.name ORDER BY category_sum DESC;");

      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromIncomesBalance'] = 'Brak wyników dla wybranego okresu';
        // header("location: ../balancePeriod.php");
         //exit();
      } else {

         $customDatesBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['incomesBalance'] = $customDatesBalance;
         $_SESSION['startDate'] = $startDate;
         $_SESSION['endDate'] = $endDate;
      }
         $stmt = NULL;
   }

   protected function getCustomDatesIncomesSum($userID, $startDate, $endDate){   


      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(incomes.amount),2) AS total FROM incomes_category_assigned_to_users, incomes WHERE (incomes.date_of_income BETWEEN '$startDate' AND '$endDate') AND (incomes_category_assigned_to_users.user_id=?) AND (incomes_category_assigned_to_users.user_id = incomes.user_id) AND (incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromIncomesBalance'] = 'Brak sumy dla wybranego okresu';
         //header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $customDatesSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalIncomes'] = $customDatesSum;
      }
         $stmt = NULL;
        
   }

   //--------------------------Expenses Section-------------------------------//

   protected function getCurrentMonthExpensesBalance($userID){

      $firstDayOfTheMonth = date('Y-m-01');
      $lastDayOfTheMonth = date('Y-m-t');

      $stmt = $this->connect()->prepare("SELECT expenses_category_assigned_to_users.name, ROUND(SUM(expenses.amount),2) AS category_sum FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id) GROUP BY expenses_category_assigned_to_users.name ORDER BY category_sum DESC;");

      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak wyników dla wybranego okresu';
        //header("location: ../balancePeriod.php");
        // exit();
      } else {

         $currentMonthBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['expensesBalance'] = $currentMonthBalance;
      }
         $stmt = NULL;
   }

   protected function getCurrentMonthExpensesSum($userID){

      $firstDayOfTheMonth = date('Y-m-01');
      $lastDayOfTheMonth = date('Y-m-t');

      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(expenses.amount),2) AS total FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak sumy dla wybranego okresu';
        //header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $currentMonthSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalExpenses'] = $currentMonthSum;
      }
         $stmt = NULL;
        
   }

   protected function getPreviousMonthExpensesBalance($userID){

      $firstDayOfTheMonth = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
      $lastDayOfTheMonth = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));

      $stmt = $this->connect()->prepare("SELECT expenses_category_assigned_to_users.name, ROUND(SUM(expenses.amount),2) AS category_sum FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id) GROUP BY expenses_category_assigned_to_users.name ORDER BY category_sum DESC;");
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak wyników dla wybranego okresu';
       // header("location: ../balancePeriod.php?dupal");
         
         //exit();
      } else {

         $previousMonthBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['expensesBalance'] = $previousMonthBalance;
         $stmt = NULL;
      }
   }

   protected function getPrevioustMonthExpensesSum($userID){   

      $firstDayOfTheMonth = date("Y-m-01", mktime(0, 0, 0, date("m")-1, 1));
      $lastDayOfTheMonth = date("Y-m-t", mktime(0, 0, 0, date("m"), 0));

      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(expenses.amount),2) AS total FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$firstDayOfTheMonth' AND '$lastDayOfTheMonth') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak sumy dla wybranego okresu';
       // header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $previousMonthSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalExpenses'] = $previousMonthSum;
      }
         $stmt = NULL;
        
   }

   protected function getCurrentYearExpensesBalance($userID){

      $firstDayOfTheYear = date("Y-01-01");
      $lastDayOfTheYear = date('Y') . '-12-31';

      $stmt = $this->connect()->prepare("SELECT expenses_category_assigned_to_users.name, ROUND(SUM(expenses.amount),2) AS category_sum FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$firstDayOfTheYear' AND '$lastDayOfTheYear') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id) GROUP BY expenses_category_assigned_to_users.name ORDER BY category_sum DESC;");
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak wyników dla wybranego okresu';
       // header("location: ../balancePeriod.php");
         
         //exit();
      } else {

         $currentYearBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['expensesBalance'] = $currentYearBalance;
      }
         $stmt = NULL;
   }

   protected function getCurrentYearExpensesSum($userID){   

      $firstDayOfTheYear = date("Y-01-01");
      $lastDayOfTheYear = date('Y') . '-12-31';

      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(expenses.amount),2) AS total FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$firstDayOfTheYear' AND '$lastDayOfTheYear') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak sumy dla wybranego okresu';
        //header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $currentYearSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalExpenses'] = $currentYearSum;
      }
         $stmt = NULL;
        
   }

   protected function getCustomDatesExpensesBalance($userID, $startDate, $endDate){


      $stmt = $this->connect()->prepare("SELECT expenses_category_assigned_to_users.name, ROUND(SUM(expenses.amount),2) AS category_sum FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$startDate' AND '$endDate') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id) GROUP BY expenses_category_assigned_to_users.name ORDER BY category_sum DESC;");

      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak wyników dla wybranego okresu';
         header("location: ../balancePeriod.php");
         //exit();
      } else {

         $customDatesBalance = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION['expensesBalance'] = $customDatesBalance;
      }
         $stmt = NULL;
   }

   protected function getCustomDatesExpensesSum($userID, $startDate, $endDate){   


      $stmt = $this->connect()->prepare("SELECT ROUND(SUM(expenses.amount),2) AS total FROM expenses_category_assigned_to_users, expenses WHERE (expenses.date_of_expense BETWEEN '$startDate' AND '$endDate') AND (expenses_category_assigned_to_users.user_id=?) AND (expenses_category_assigned_to_users.user_id = expenses.user_id) AND (expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id);");
    
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../balancePeriod.php?error=querrySUMSQL_to_DB");
         exit();
      }


      if($stmt->rowCount() == 0){

         $stmt = NULL;
         $_SESSION['noResultFromExpensesBalance'] = 'Brak sumy dla wybranego okresu';
         header("location: ../balancePeriod.php?brakSumy");
         //exit();
      } else {

         $customDatesSum = $stmt->fetchAll(PDO::FETCH_COLUMN);
         $_SESSION['totalExpenses'] = $customDatesSum;
      }
         $stmt = NULL;
        
   }


}