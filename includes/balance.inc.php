<?php

session_start();

if(isset($_POST["submitBalance"])){

   //Grabbing the data
    $uID = $_SESSION['userid'];

         
   //Remember form inputs for modal
   
   //Instantiatate IncomeController class
   include "../classes/dbh.classes.php";
   include "../classes/balance.classes.php";
   include "../classes/balance-contr.classes.php";

   $balance = new BalanceContr($uID);
   $balance->showCurrentMonthBalance();
   
   //Running error handlers and user signup
   // $signup->signupUser();

   //Clearing errors
   // if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
   // if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
   // if (isset($_SESSION['e_passwd'])) unset($_SESSION['e_passwd']);

   //Set success session variable
   $_SESSION['xxx'] = true;

   // Going to destination page
   header("location: ../balancePeriod.php");
   

} else {

   header('location: ../balancePeriod.php?NosubmissionSuccseed');
}