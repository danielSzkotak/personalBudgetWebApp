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

      $this->getCurrentMonthIncomesBalance($this->uID);
      $this->getCurrentMonthIncomesSum($this->uID);
      $this->getCurrentMonthExpensesBalance($this->uID);
      $this->getCurrentMonthExpensesSum($this->uID);
    
   }

   public function showPreviousMonthBalance(){

      $this->getPreviousMonthIncomesBalance($this->uID);
      $this->getPrevioustMonthIncomesSum($this->uID);
      $this->getPreviousMonthExpensesBalance($this->uID);
      $this->getPrevioustMonthExpensesSum($this->uID);
    
   }

   public function showCurrentYearBalance(){

      $this->getCurrentYearIncomesBalance($this->uID);
      $this->getCurrentYearIncomesSum($this->uID);
      $this->getCurrentYearExpensesBalance($this->uID);
      $this->getCurrentYearExpensesSum($this->uID);
    
   }

   public function showCustomDatesBalance(){

      $this->getCustomDatesIncomesBalance($this->uID, $this->startDate, $this->endDate);
      $this->getCustomDatesIncomesSum($this->uID, $this->startDate, $this->endDate);
      $this->getCustomDatesExpensesBalance($this->uID, $this->startDate, $this->endDate);
      $this->getCustomDatesExpensesSum($this->uID, $this->startDate, $this->endDate);
     
    
   }

}