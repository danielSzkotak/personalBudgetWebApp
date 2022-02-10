<?php

class CategoriesContr extends Categories{

   private $uID; 
   
   public function __construct($uID){
  
      $this->uID = $uID;
   }

   public function getUserIncomesCategories(){

      $this->getIncomeCategories($this->uID);    
   }

   public function getUserExpenseCategories(){

      $this->getExpenseCategories($this->uID);    
   }

   public function getUserPaymentMethod(){
      
      $this->getPaymentMethods($this->uID);  
   }

}