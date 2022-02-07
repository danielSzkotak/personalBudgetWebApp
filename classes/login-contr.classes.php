<?php

class LoginContr extends Login{

   private $uid; 
   private $passwd;
   
   public function __construct($uid, $passwd){
  
      $this->uid = $uid;
      $this->passwd = $passwd;
   }

   public function loginUser(){
      if($this->emptyInputs() == false){
         header("location: ../index.php?error=emptyinputs");
         exit();
      }

      $this->getUser($this->uid, $this->passwd);
    
   }

 

   private function emptyInputs(){

      if(empty($this->uid) || empty($this->passwd)){
         $result = false;
      }else{
         $result = true;
      }
      return $result;
   }


}