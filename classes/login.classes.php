<?php

class Login extends Dbh {

   protected function getUser($uid, $passwd){
      $stmt = $this->connect()->prepare('SELECT password FROM users WHERE username=? OR email=?;');
      
      if(!$stmt->execute(array($uid, $passwd))){
         $stmt = null;
         header("location: ../index.php?error=stmtfailed");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         header("location: ../login.php");
         $_SESSION['login_error'] = 'Błędna nazwa użytkownika lub hasło';
         exit();
      }

      $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $checkPwd = password_verify($passwd, $pwdHashed[0]["password"]);

      if($checkPwd == false){

         $stmt = NULL;
         header("location: ../login.php?error=usernotfound");
         $_SESSION['login_error'] = 'Błędna nazwa użytkownika lub hasło';
         exit();

      } elseif ($checkPwd == true){

         $stmt = $this->connect()->prepare('SELECT * FROM users WHERE username=? OR email=? AND password = ?;');

         if(!$stmt->execute(array($uid, $uid, $passwd))){
            $stmt = null;
            header("location: ../login.php?error=stmtfailed");
            exit();
         }

         if($stmt->rowCount() == 0){

            $stmt = NULL;
            header("location: ../login.php?error=usernotfound");
            $_SESSION['login_error'] = 'Błędna nazwa użytkownika lub hasło';
            exit();
         }

         $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

         session_start();
         $_SESSION['userid'] = $user[0]["id"];
         $_SESSION['useruid'] = $user[0]["username"];

         $stmt = NULL;

      }

      $stmt = NULL;

   }

   protected function getCategories($userID){

      $stmt = $this->connect()->prepare('SELECT * FROM incomes_category_assigned_to_users WHERE user_id=?;');
      
      if(!$stmt->execute(array($userID))){
         $stmt = null;
         header("location: ../index.php?error=bladzapytaniastmt");
         exit();
      }

      if($stmt->rowCount() == 0){

         $stmt = NULL;
         header("location: ../login.php?zerowierszy");
         exit();
      }

         $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

         session_start();
         $_SESSION['categories'] = $categories;
        
         $stmt = NULL;

   }


}