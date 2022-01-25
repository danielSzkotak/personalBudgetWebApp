<?php

if(isset($_POST["submit"])){

   //Grabbing the data
   $uid = $_POST["uid"];
   $passwd = $_POST["passwd"];

   //Instantiatate SignUpController calss
   include "../classes/dbh.classes.php";
   include "../classes/login.classes.php";
   include "../classes/login-contr.classes.php";
   $login = new LoginContr($uid, $passwd);

   //Running error handlers and user signup
   $login->loginUser();
   
   // Going to back to front page
   //header('location: ../index.php?error=none');
   header('location: ../addIncome.php');
} 