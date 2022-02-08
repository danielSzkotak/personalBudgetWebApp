<?php

session_start();

if(isset($_POST["submitIncome"])){

   //Grabbing the data
    $amount = $_POST["incomeAmount"];
    $date = $_POST["incomeDate"];
    $category = $_POST["incomeCategory"];
    $uID = $_SESSION['userid'];


   //Instantiatate SignUpController class
   // include "../classes/dbh.classes.php";
   // include "../classes/signup.classes.php";
   // include "../classes/signup-contr.classes.php";
   // $signup = new SignupContr($uid, $passwd, $email);

   
   //Running error handlers and user signup
   // $signup->signupUser();


   //Clearing errors
   // if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
   // if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
   // if (isset($_SESSION['e_passwd'])) unset($_SESSION['e_passwd']);

   // Going to destination page
   header("location: ../addIncome.php?Dodano".$amount.$date.$category);

} else {

   header('location: ../addIncome.php?NieDodanoNic');
}