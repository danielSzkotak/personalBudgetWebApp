<?php

if(isset($_POST["submit"])){

   //Grabbing the data
   $uid = $_POST["uid"];
   $email = $_POST["email"];
   $passwd = $_POST["passwd"];

   //Instantiatate SignUpController calss
   include "../classes/dbh.classes.php";
   include "../classes/signup.classes.php";
   include "../classes/signup-contr.classes.php";
   $signup = new SignupContr($uid, $passwd, $email);

   //Running error handlers and user signup
   $signup->signupUser();
   
   // Going to back to front page
   header('location: ../login.php');
}