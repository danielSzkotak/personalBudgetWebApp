<?php

class ExpenseContr extends Expense{

   private $uID; 
   private $categoryID;
   private $paymentID;
   private $amount;
   private $date;
   
   
   public function __construct($uID, $categoryID, $paymentID, $amount, $date){
  
      $this->uID = $uID;
      $this->amount = $amount;
      $this->date = $date;
      $this->categoryID = $categoryID;
      $this->paymentID = $paymentID;

   }

   public function addUserExpense(){
      $this->addExpense($this->uID, $this->categoryID, $this->paymentID, $this->amount, $this->date);
   }

}