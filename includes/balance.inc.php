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
      }
      
      
   

  
   
   //Running error handlers and user signup
   // $signup->signupUser();

   //Clearing errors
   // if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
   // if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
   // if (isset($_SESSION['e_passwd'])) unset($_SESSION['e_passwd']);

   //Set success session variable

   // Going to destination page
   header("location: ../balancePeriod.php");
   

} else {

   header('location: ../balancePeriod.php?NosubmissionSuccseed');
}