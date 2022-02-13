<?php

session_start();

if(isset($_POST["submitExpense"])){

   
    //Grabbing the data
    $amount = $_POST["expenseAmount"];
    $date = $_POST["expenseDate"];
    $uID = $_SESSION['userid'];

         //Fetch id and name from category
         $categoryFetch = explode('|', $_POST["expenseCategory"]);
         $categoryID = $categoryFetch[0];
         $categoryName = $categoryFetch[1];

         //Fetch id and name from payment method
         $paymentFetch = explode('|', $_POST["expensePayment"]);
         $paymentID = $paymentFetch[0];
         $paymentName = $paymentFetch[1];
      
    $uID = $_SESSION['userid'];
   
   //Remember form inputs for modal
   $_SESSION['modal_amount'] = number_format($amount, 2, '.', ',');
   $_SESSION['modal_date'] = date("d-m-Y", strtotime($date));
   $_SESSION['modal_categoryName'] = $categoryName;
   $_SESSION['modal_paymentName'] = $paymentName;

   //Instantiatate ExpenseController class
   include "../classes/dbh.classes.php";
   include "../classes/expense.classes.php";
   include "../classes/expense-contr.classes.php";

   $expense = new ExpenseContr($uID, $categoryID, $paymentID, $amount, $date);
   $expense->addUserExpense();
   
   //Running error handlers and user signup
   // $signup->signupUser();

   //Clearing errors
   // if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
   // if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
   // if (isset($_SESSION['e_passwd'])) unset($_SESSION['e_passwd']);

   $_SESSION['inputExpenseSuccess'] = true;
   // Going to destination page
   header("location: ../addExpense.php");

} else {

   header('location: ../addIncome.php?NieDodanoNic');
}