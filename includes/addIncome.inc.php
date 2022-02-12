<?php

session_start();

if(isset($_POST["submitIncome"])){

   //Grabbing the data
    $amount = $_POST["incomeAmount"];
    $date = $_POST["incomeDate"];
    $category = $_POST["incomeCategory"];
    $uID = $_SESSION['userid'];

   //Remember form inputs for modal
   $_SESSION['modal_amount'] = $amount;
   $_SESSION['modal_date'] = $date;
   $_SESSION['modal_category'] = $category;
   

   //Instantiatate IncomeController class
   include "../classes/dbh.classes.php";
   include "../classes/income.classes.php";
   include "../classes/income-contr.classes.php";

   $income = new IncomeContr($uID, $category, $amount, $date);
   $income->addUserIncome();
   
   //Running error handlers and user signup
   // $signup->signupUser();

   //Clearing errors
   // if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
   // if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
   // if (isset($_SESSION['e_passwd'])) unset($_SESSION['e_passwd']);

   //Set cuccess session variable
   $_SESSION['inputSuccess'] = true;


   // Going to destination page
   header("location: ../addIncome.php");
   

} else {

   header('location: ../addIncome.php?NieDodanoNic');
}