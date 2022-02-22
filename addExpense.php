<?php

   include "classes/dbh.classes.php";
   include "classes/categories.classes.php";
   include "classes/categories-contr.classes.php";

   session_start();

   if(!isset($_SESSION['useruid'])){
      header('Location: login.php');
      exit();
   }

   //AddingCategories
   $expenseCategories = new CategoriesContr($_SESSION['userid']);
   $expenseCategories->getUserExpenseCategories();
   $expenseCategories->getUserPaymentMethod();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mój osobisty budżet</title>
   <link rel="stylesheet" href="css/main.min.css">
   <link rel="stylesheet" href="css/custom.css">
   <link rel="stylesheet" href="css/fontello.css" type="text/css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <?php if(isset($_SESSION['inputExpenseSuccess'])){
      echo "
      <script>
      $(document).ready(function(){
         $('#exampleModal').modal('show');
      });
      </script>";
      unset ($_SESSION['inputExpenseSuccess']);
   }
   ?>

</head>
<body>
<div class="mainContainer mb-5">
   <!-- navbar -->
   <nav class="navbar navbar-expand-md navbar-light">
      <div class="container-xxl p-2 mt-2 mb-5">
         <a href="index.php" class="navbar-brand" >
            <img src="img/budget.png" alt="" width="100" height="100" class="d-inline-block align-text-bottom">
            <span class="text-primary display-2">
               twój <span class="text-success">budżet</span>
            </span>
         </a>
         <!-- toggle button for mobile nav -->
         <button class="navbar-toggler align-self-end mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon fs-3"></span>
          </button>

         <!-- navbar links -->
         <div class="collapse navbar-collapse mb-1 justify-content-end align-self-end" id="navbarText">
            <ul class="navbar-nav mb-lg-0">
               <li class="nav-item">
                  <a href="#" class="nav-link text-primary mt-2 me-3">Ciekawe linki</a>
               </li>
               <li class="nav-item">
                  <a href="#" class="nav-link text-primary mt-2 me-3">Pomoc</a>
               </li>
               <li class="nav-item d-md-none mt-2 me-3">
                  <a href="#" class="nav-link active">Ustawienia</a>
               </li>
               <li class="nav-item">
                  <a href="includes/logout.inc.php" class="nav-link text-primary mt-2 me-3">Wyloguj się</a>
               </li>
               <li id="alignSettingsIcon" class="nav-item d-none d-md-inline">
                  <a href="#" class="settings">
                     <span class="rotate"><i class="icon-cog"></i></span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
   <!-- main secion -->
   <section id="main">
      <div class="container-xxl mt-5">
         <div class="row align-items-start">
            <div class="col-lg-6 align-self-start dupa">
               <header>
               <?php
                  echo "<span><h1 class='text-start'>Witaj <span class='text-success'>".$_SESSION['useruid']."</span></h1></span>";
               ?>
               </header>
               <div class="row">
                     <a href="addIncome.php" class="col bg-light mb-2 me-2 p-5 rounded-3 text-center text-white text-nowrap fs-2">
                        Dodaj przychód 
                     </a>
                  <a href="addExpense.php" class="col bg-secondary mb-2 me-2 p-5 rounded-3 text-center text-white text-nowrap fs-2">
                     Dodaj rozchód
                  </a>
               </div>
               <div class="row">
                  <a href="balancePeriod.php" class="col bg-info me-2 p-5 rounded-3 text-center text-nowrap text-white fs-2">
                     Przeglądaj bilans
                  </a>
               </div>   
            </div>
            <div class="col ms-lg-5 mt-5 mt-lg-0">
               <header>
                  <h1 class="text-start">Dodaj rozchód</h1>
               </header>

               <form action="includes/addExpense.inc.php" method="POST" class="needs-validation" id="addExpenseForm" novalidate>
                  <div class="mb-3 mt-5">
                     <label for="inputExpense1" class="form-label">Podaj kwotę wydatku</label>
                     <input type="number" name="expenseAmount" class="form-control fs-5 pt-3 pb-3 shadow-none" id="inputExpense1" step="any" min="0.01" required>
                  </div>
                  <div class="mb-3">
                    <label for="inputDate1" class="form-label">Wprowadź datę wydatku</label>
                    <input type="date" name="expenseDate" value="<?php echo date('Y-m-d'); ?>" onclick="limitDateInput()" class="form-control fs-5 pt-3 pb-3 shadow-none" id="inputDateExpense" aria-describedby="emailHelp" required>               
                  </div>
                  <div class="mb-3">  
                     <label for="selectPaymantMethod" class="form-label">Wybierz metodę płatności</label>
                     <select class="form-select fs-5 pt-3 pb-3" name="expenseCategory" id="selectPaymantMethod" aria-label="Default select example" required>
                     <?php
                        foreach ($_SESSION['expenseUserCat'] as $row) {
                           ?>      
                              <option value="<?php echo $row['id'].'|'.$row['name']; ?>"> <?php echo $row['name']; ?> </option> 
                        <?php      
                        }
                     ?>
                      </select>
                  </div>
                  <div class="mb-3">  
                     <label for="expenseCategory" class="form-label">Wybierz kategorie wydatku</label>
                     <select class="form-select fs-5 pt-3 pb-3" name="expensePayment" id="expenseCategory" aria-label="Default select example" required>

                     <?php
                        foreach ($_SESSION['paymentUserMet'] as $row) {
                           ?>      
                              <option value="<?php echo $row['id'].'|'.$row['name']; ?>"> <?php echo $row['name']; ?> </option> 
                        <?php      
                        }
                     ?>

                      </select>
                      <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h4 class="modal-title text-success" id="exampleModalLabel">Dodano rozchód</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">

                              <h5 class="text-start">Data: <?php if(isset($_SESSION['modal_date'])) echo $_SESSION['modal_date']; unset($_SESSION['modal_date']);?></h5>

                              <h5 class="text-start">Kategoria: <?php if(isset($_SESSION['modal_categoryName'])) echo $_SESSION['modal_categoryName']; unset($_SESSION['modal_categoryName']);?></h5>

                              <h5 class="text-start">Sposób płatności: <?php if(isset($_SESSION['modal_paymentName'])) echo $_SESSION['modal_paymentName']; unset($_SESSION['modal_paymentName']);?></h5>

                              <h5 class="text-start">Kwota: <?php if(isset($_SESSION['modal_amount'])) echo $_SESSION['modal_amount'].' zł'; unset($_SESSION['modal_amount']);?></h5>

                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-success" data-bs-dismiss="modal">Zamknij</button>                
                              </div>
                           </div>
                        </div>
                     </div>              
                     <!-- End of Modal -->
                  </div>
                  <button type="submit" name="submitExpense" id="myButton" class="btn btn-light p-3" data-bs-toggle="modal">Dodaj wydatek</button>
                  <button type="button" class="btn btn-danger p-3" onclick="clearInputs()">Wyczyść pola</button>
                </form>
                <script src="js/script.js"></script>
            </div>
         </div>
      </div>
   </section>
</div>
   <footer>
      <div class="container-fluid my-5 text-white text-center pt-5 pb-5 bg-dark">
         <p class="fs-1 fw-bold">Profesjonalnie buduj swój kapitał osobisty!</p>
      </div>
      <div class="my-5">
         <h5 class="text-center fs-6">© 2021 Twój budżet osobisty. All rights reserved.</h5>
      </div>
   </footer>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>