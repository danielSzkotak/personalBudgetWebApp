<?php

class ExpenseManager extends Categories{

   private $uID; 
   
   public function __construct($uID){
  
      $this->uID = $uID;
   }

   public function getUserExpenseCategories(){

      $this->getExpenseCategories($this->uID);    
   }

   public function getUserPaymentMethods(){

      $this->getPaymentMethods($this->uID);   
   }

}