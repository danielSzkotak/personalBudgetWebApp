<?php

session_start();

if(isset($_POST["submit"])){

   //Grabbing the data
   $uid = $_POST["uid"];
   $email = $_POST["email"];
   $passwd = $_POST["passwd"];

   //Remember form inputs
   $_SESSION['fr_nick'] = $uid;
   $_SESSION['fr_email'] = $email;
   $_SESSION['fr_passwd'] = $passwd;


   //Instantiatate SignUpController class
   include "../classes/dbh.classes.php";
   include "../classes/signup.classes.php";
   include "../classes/signup-contr.classes.php";
   $signup = new SignupContr($uid, $passwd, $email);

   
   //Running error handlers and user signup
   $signup->signupUser();

   //Clearing remembered input
   if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
   if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
   if (isset($_SESSION['fr_passwd'])) unset($_SESSION['fr_passwd']);

   //Clearing errors
   if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
   if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
   if (isset($_SESSION['e_passwd'])) unset($_SESSION['e_passwd']);

   // Going to destination page
   header('location: ../login.php');
} else {

   header('location: ../index.php');
}