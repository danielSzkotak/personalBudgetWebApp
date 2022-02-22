<?php

session_start();

if(isset($_POST["submitBalance"])){

   //Instantiatate IncomeController class
   include "../classes/dbh.classes.php";
   include "../classes/balance.classes.php";
   include "../classes/balance-contr.classes.php";

   $uID = $_SESSION['userid'];
   
   //Grabbing the data
      $_SESSION['selectedValue'] = $_POST['balancePeriod'];
      
      if($_SESSION['selectedValue'] == 'bieżący miesiąc'){
         $balance = new BalanceContr($uID);
         $balance->showCurrentMonthBalance();
      } else if ($_SESSION['selectedValue'] == 'poprzedni miesiąc'){
         $balance = new BalanceContr($uID);
         $balance->showPreviousMonthBalance();
      } else if ($_SESSION['selectedValue'] == 'bieżący rok'){
         $balance = new BalanceContr($uID);
         $balance->showCurrentYearBalance();
      } else if ($_SESSION['selectedValue'] == 'non-standardPeriod'){


         //Handle ivalid date inputs
         if(($_POST['startDate'] == null) || ($_POST['endDate'] == null) || ($_POST['startDate']>$_POST['endDate'])) {
            $_SESSION['dates_error'] = true;
            $_SESSION['startDateSelected'] = $_POST['startDate'];
            $_SESSION['endDateSelected'] = $_POST['endDate'];
         } else {
            $_SESSION['startDateSelected'] = $_POST['startDate'];
            $_SESSION['endDateSelected'] = $_POST['endDate'];
            $_SESSION['dates_ok'] = true;
            $balance = new BalanceContr($uID, $_POST['startDate'], $_POST['endDate']);
            $balance->showCustomDatesBalance();
            
         }
      }
      

   // Going to destination page
   header("location: ../balancePeriod.php");
   

} else {

   header('location: ../balancePeriod.php?NosubmissionSuccseed');
}