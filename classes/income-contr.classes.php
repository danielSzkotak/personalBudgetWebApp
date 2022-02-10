<?php

class IncomeContr extends Income{

   private $uID; 
   private $amount;
   private $date;
   private $category;
   
   public function __construct($uID, $category, $amount, $date){
  
      $this->uID = $uID;
      $this->amount = $amount;
      $this->date = $date;
      $this->category = $category;

   }

   public function addUserIncome(){
      $this->addIncome($this->uID, $this->category, $this->amount, $this->date);
   }

}