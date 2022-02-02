<?php

class IncomeManager extends Categories{

   private $uID; 
   
   public function __construct($uID){
  
      $this->uID = $uID;
   }

   public function getUserIncomesCategories(){

      $this->getIncomeCategories($this->uID);    
   }

}