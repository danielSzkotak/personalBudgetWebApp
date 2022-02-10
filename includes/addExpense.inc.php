<?php

session_start();

if(isset($_POST["submitExpense"])){

   //Grabbing the data
    $amount = $_POST["expenseAmount"];
    $date = $_POST["expenseDate"];
    $category = $_POST["expenseCategory"];
    $payment = $_POST["expensePayment"];
    $uID = $_SESSION['userid'];

   //Remember form inputs
   //$_SESSION['fr_amount'] = $amount;

   //Instantiatate ExpenseController class
   include "../classes/dbh.classes.php";
   include "../classes/expense.classes.php";
   include "../classes/expense-contr.classes.php";

   $expense = new ExpenseContr($uID, $category, $payment, $amount, $date);
   $expense->addUserExpense();
   
   //Running error handlers and user signup
   // $signup->signupUser();

   //Clearing errors
   // if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
   // if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
   // if (isset($_SESSION['e_passwd'])) unset($_SESSION['e_passwd']);

   // Going to destination page
   header("location: ../addIncome.php?dodano");

} else {

   header('location: ../addIncome.php?NieDodanoNic');
}