<?php

class Income extends Login{

   private $uID; 
   
   public function __construct($uID){
  
      $this->uID = $uID;
   }

   public function getUserCategories(){

      $this->getCategories($this->uID);    
   }

}