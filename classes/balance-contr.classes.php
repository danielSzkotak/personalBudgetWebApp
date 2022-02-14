<?php

class BalanceContr extends Balance{

   private $uID; 
   private $startDate;
   private $endDate;
   
   public function __construct($uID, $startDate=null, $endDate=null){
  
      $this->uID = $uID;
      $this->startDate = $startDate;
      $this->endDate = $endDate;
   }

   public function showCurrentMonthBalance(){

      $this->getCurrentMonthBalance($this->uID);
    
   }

}