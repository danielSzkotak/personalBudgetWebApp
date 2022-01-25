<?php

class SignupContr extends Signup{

   private $uid; 
   private $email; 
   private $passwd;
   
   public function __construct($uid, $passwd, $email){

      $this->uid = $uid;
      $this->email = $email;
      $this->passwd = $passwd;
   }

   public function signupUser(){
      if($this->emptyInputs() == false){
         header("location: ../index.php?error=emptyinputs");
         exit();
      }

      if($this->invalidUid() == false){
         header("location: ../index.php?error=username");
         exit();
      }

      if($this->invalidEmail() == false){
         header("location: ../index.php?error=email");
         exit();
      }

      if($this->uidTakenCheck() == false){
         header("location: ../index.php?error=useroremailtaken");
         exit();
      }

      $this->setUser($this->uid, $this->passwd, $this->email);
   }

   private function emptyInputs(){

      if(empty($this->uid) || empty($this->email) || empty($this->passwd)){
         $result = false;
      }else{
         $result = true;
      }
      return $result;
   }

   private function invalidUid(){
      
      if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
         $result = false;
      } else {
         $result = true;
      }
      return $result;
   }

   private function invalidEmail(){
      
      if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
         $result = false;
      } else {
         $result = true;
      }
      return $result;
   }

   private function uidTakenCheck(){
      
      if(!$this->checkUser($this->uid, $this->email)){
         $result = false;
      } else {
         $result = true;
      }
      return $result;
   }


}