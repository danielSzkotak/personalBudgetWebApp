<?php

session_start();

if(isset($_POST["submit"])){

   //Grabbing the data
   $uid = $_POST["uid"];
   $passwd = $_POST["passwd"];

   //Remember form inputs
   $_SESSION['fl_nick'] = $uid;
   
   //Instantiatate LoginController calss
   include "../classes/dbh.classes.php";
   include "../classes/login.classes.php";
   include "../classes/login-contr.classes.php";
   $login = new LoginContr($uid, $passwd);

   //Running error handlers and user login
   $login->loginUser();

   //Clearing remembered input
   if (isset($_SESSION['fl_nick'])) unset($_SESSION['fl_nick']);
   
   //Clearing errors
   if (isset($_SESSION['login_error'])) unset($_SESSION['login_error']);
   
   // Going to destination page
   header('location: ../addIncome.php');
   unset($_SESSION['register_success']);
} else {
   
   header('location: ../login.php');
}