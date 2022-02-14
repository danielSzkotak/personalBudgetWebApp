<?php

session_start();

if (!isset($_SESSION['useruid'])) {
   header('Location: login.php');
   exit();
}

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
   <script src="https://www.gstatic.com/charts/loader.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="js/throttledresize.js"></script>
   <script src="js/charts.js"></script>
   <script src="js/script.js"></script>

</head>

<body onload="limitDateInput()">
   <div class="mainContainer mb-5">
      <!-- navbar -->
      <nav class="navbar navbar-expand-md navbar-light">
         <div class="container-xxl p-2 mt-2 mb-5">
            <a href="#" class="navbar-brand">
               <img src="img/budget.png" alt="" width="100" height="100" class="d-inline-block align-text-bottom">
               <span class="text-primary display-2">
                  twój <span class="text-success">budżet</span>
               </span>
            </a>
            <!-- toggle button for mobile nav -->
            <button class="navbar-toggler align-self-end mb-2" type="button" data-bs-toggle="collapse"
               data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
               aria-label="Toggle navigation">
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
         <!-- menu section -->
         <div class="container-xxl mt-5">
            <div class="row align-items-start">
               <div class="col-lg-6 align-self-start dupa">
                  <header>
                  <?php
                     echo "<span><h1 class='text-start'>Witaj <span class='text-success'>" . $_SESSION['useruid'] . "</span></h1></span>";
                     ?>
                  </header>
                  <div class="row">
                     <a href="addIncome.php" class="col bg-light mb-2 me-2 p-5 rounded-3 text-center text-white text-nowrap fs-2">
                        Dodaj przychód
                     </a>
                     <a href="addExpense.php"
                        class="col bg-secondary mb-2 me-2 p-5 rounded-3 text-center text-white text-nowrap fs-2">
                        Dodaj rozchód
                     </a>
                  </div>
               </div>
               <div class="col ms-lg-5 mt-5 mt-lg-0">
                  <header>
                     <h1 class="text-start">Przegladaj bilans</h1>
                  </header>

                  <form action="includes/balance.inc.php" method="POST">

                     <div class="mb-3 mb-4">
                        <label for="selectBalancePeriod" class="form-label">Wybierz okres</label>
                        <select name="balancePeriod" class="form-select fs-5 pt-3 pb-3" id="selectedBalancePeriod"
                           onchange="showDateInputs()" aria-label="Default select example" required>
                           <option value="currentMonth">Bieżący miesiąc</option>
                           <option value="previousMonth">Poprzedni miesiąc</option>
                           <option value="currentYear">Bieżacy rok</option>
                           <option value="non-standardPeriod">Niestandardowy</option>
                        </select>
                     </div>

                     <div class="mb-3">
                        <div class="selectPeriod" id="selectPeriodId">
                           <label for="startDate1" class="form-label mt-3">Wybierz datę początkową</label>
                           <input class="form-control fs-5 pt-3 pb-3 shadow-none mb-3" type="date" name="startDate"
                              id="startDate1">
                           <label for="endDate1" class="form-label">Wybierz datę końcową</label>
                           <input class="form-control fs-5 pt-3 pb-3 shadow-none" type="date" name="endDate"
                              id="endDate1">
                           <p class="mt-3 text-danger" id="wrongDates"></p>
                        </div>
                     </div>
                     <button type="submit" name="submitBalance" value="submitBalance" class="btn btn-light p-4">Pokaż bilans</button>
                     <script src="js/script.js"></script>
                  </form>

               </div>
            </div>
         </div>
         
         <div class="container-xxl mt-5">         
            
            <!-- <section id="tables">
               <header>
                  <h1 class="text-start" id="selectedPeriodParagraph"></h1>
               </header>
            </section> -->

            <?php

               if(isset($_SESSION['noResultFromBilans'])){
                  echo "<h2>Brak wyników dla wybranego okresu</h2>";
                  unset ($_SESSION['noResultFromBilans']);
               } else if(isset($_SESSION['currentMonthBalance'])){               
               
                  echo "<pre>";
                  echo "Bieżący miesiąc";
                  foreach ( $_SESSION['currentMonthBalance'] as $var ) {
                     echo "\n", $var['name'], "\t\t", $var['category_sum'];
                  }                
                  unset($_SESSION['currentMonthBalance']);
                 }
               
            ?>  

               
         </div>    
         
         <footer>
            <div class="container-fluid my-5 text-white text-center pt-5 pb-5 bg-dark">
               <p class="fs-1 fw-bold">Profesjonalnie buduj swój kapitał osobisty!</p>
            </div>
            <div class="my-5">
               <h5 class="text-center fs-6">© 2021 Twój budżet osobisty. All rights reserved.</h5>
            </div>
         </footer>
      </section>
      
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
      <?php
               if(isset($_SESSION['currentMonthBalance'])){
                  echo 'Pupencja';
                  unset($_SESSION['currentMonthBalance']);
               }
               ?>  
           
</body>

</html>