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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://www.gstatic.com/charts/loader.js"></script>
   <script src="js/script.js"></script>

   <script>
      // Load google charts
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawIncomesChart);
      google.charts.setOnLoadCallback(drawExpensesChart);
      
      function drawIncomesChart() {
         var data1 = google.visualization.arrayToDataTable([
         ['Przychody', 'suma'],
         <?php      
         if(isset($_SESSION['incomesBalance'])) {         
            foreach ($_SESSION['incomesBalance'] as $var){       
               echo "['".$var['name']."',".$var['category_sum']."],"; 
            }   
         }
         ?>
         ]);
            // Optional; add a title and set the width and height of the chart
            var options1 = {width: '500', height: '500', backgroundColor: 'transparent',
            title: 'Przychody'
         };
            // Display the chart inside the <div> element with id="piechart"

               var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
               <?php
                 if(isset($_SESSION['incomesBalance'])){
                    echo "chart1.draw(data1, options1);";
                 }
               ?>
            
      };
      
      function drawExpensesChart() {
         var data1 = google.visualization.arrayToDataTable([
         ['Wydatki', 'suma'],
         <?php    
         if(isset($_SESSION['expensesBalance'])){            
            foreach ($_SESSION['expensesBalance'] as $var){       
               echo "['".$var['name']."',".$var['category_sum']."],"; 
            }   
         }
         ?>
         ]);
            // Optional; add a title and set the width and height of the chart
            var options1 = {width: '500', height: '500', backgroundColor: 'transparent',
            title: 'Wydatki'
         };
            // Display the chart inside the <div> element with id="piechart"
            
               var chart1 = new google.visualization.PieChart(document.getElementById('piechart2'));
               <?php
                  if(isset($_SESSION['expensesBalance'])){
                     echo "chart1.draw(data1, options1);";
                  }
               ?>
      };
   </script>
</head>

<body>
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
                        Dodaj wydatek
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
                           <option value="bieżący miesiąc" <?php if(isset($_SESSION['selectedValue'])){
                              if($_SESSION['selectedValue'] == 'poprzedni miesiąc'){
                             echo 'selected';     
                           }                      
                     } ?>>Bieżący miesiąc</option>
                           <option value="poprzedni miesiąc" <?php if(isset($_SESSION['selectedValue'])){
                              if($_SESSION['selectedValue'] == 'poprzedni miesiąc'){
                                echo 'selected';                           
                              }
                     } ?>>Poprzedni miesiąc</option>
                           <option value="bieżący rok" <?php if(isset($_SESSION['selectedValue'])){
                              if($_SESSION['selectedValue'] == 'bieżący rok'){
                                echo 'selected';                           
                              }
                     } ?>>Bieżacy rok</option>
                           <option value="non-standardPeriod" <?php if(isset($_SESSION['selectedValue'])){
                              if($_SESSION['selectedValue'] == 'non-standardPeriod'){
                                echo 'selected';                                                
                              }
                     } ?>>Niestandardowy</option>
                        </select>
                     </div>

                     <div class="mb-3">
                        <div class="selectPeriod" id="selectPeriodId" style="<?php 
                          
                          if($_SESSION['selectedValue'] == 'non-standardPeriod'){
                           echo 'display: grid;';
                          }
                           if(isset($_SESSION['dates_error'])) {
                              echo 'display: grid;';
                           } 
                           // if(((isset($_SESSION['noResultFromIncomesBalance'])) && (isset($_SESSION['noResultFromExpensesBalance']))) && (isset($_SESSION['dates_ok']))){
                           //    echo 'display: grid;';
                           //    unset($_SESSION['dates_ok']); 
                           // } 
                           if((isset($_SESSION['dates_ok']))){
                              echo 'display: grid;'; 
                              unset($_SESSION['dates_ok']); 
                           } 
                           if(isset($_SESSION['startDate'])) {
                              echo 'display: grid;'; 
                              unset($_SESSION['startDate']); 
                              unset($_SESSION['endDate']); 
                              unset($_SESSION['dates_ok']);
                           }  
                        ?>">
                           <label for="startDate1" class="form-label mt-3">Wybierz datę początkową</label>
                           <input class="form-control fs-5 pt-3 pb-3 shadow-none mb-3 <?php
                              if(isset($_SESSION['dates_error'])) {
                                 echo 'is-invalid';
                              }
                           ?>" type="date" name="startDate"
                              id="startDate1" value="<?php if(isset($_SESSION['startDateSelected'])){
                        echo $_SESSION['startDateSelected'];
                        unset($_SESSION['startDateSelected']);
                     }  else {echo date('Y-m-d');}?>">
                           <label for="endDate1" class="form-label">Wybierz datę końcową</label>
                           <input class="form-control fs-5 pt-3 pb-3 shadow-none <?php
                              if(isset($_SESSION['dates_error'])) {
                                 echo 'is-invalid';
                              }
                           ?>" type="date" name="endDate" id="endDate1" value="<?php if(isset($_SESSION['endDateSelected'])){
                              echo $_SESSION['endDateSelected'];
                              unset($_SESSION['endDateSelected']);
                           } else {echo date('Y-m-d');} ?>">

                              <div class="invalid-feedback">
                              <?php
                                 if(isset($_SESSION['dates_error'])) {
                                                                                          
                                    echo 'Wprowadź poprawne daty';
                                    unset($_SESSION['dates_error']);
                                 }
                              ?>
                              </div> 

                           <p class="mt-3 text-danger" id="wrongDates"></p>
                        </div>
                     </div>
                     <button type="submit" name="submitBalance" value="submitBalance" class="btn btn-light p-4">Pokaż bilans</button>
                     <a href="#" id="cos" name="settings" class="btn btn-warning py-4 px-2">Ustawienia</a>
                     <script src="js/script.js"></script>
                  </form>

               </div>
            </div>
         </div>
         
         <div class="container-xxl mt-5" id="balanceContainer">         
            
           <!-- Creating balance table -->
            <?php
               if((isset($_SESSION['noResultFromIncomesBalance']) && (isset($_SESSION['noResultFromExpensesBalance'])))){
                  echo "<h1>Brak wyników dla wybranego okresu</h1>";
                  unset($_SESSION['noResultFromIncomesBalance']);
                  unset($_SESSION['noResultFromExpensesBalance']);

               } else if((isset($_SESSION['incomesBalance']) || (isset($_SESSION['expensesBalance'])))){ 
                  
                  if($_SESSION['selectedValue'] == 'non-standardPeriod'){

                     echo  "<h1 class='text-start' id='selectedPeriodParagraph'>Bilans za wybrany okres</h1>";                                                                      
                  } else {

                     echo  "<h1 class='text-start' id='selectedPeriodParagraph'>Bilans za ". $_SESSION['selectedValue']. "</h1>";

                  }

                  if(isset($_SESSION['incomesBalance'])){
                                                                   
                   echo <<<EOD
                     <table class="table table-striped mb-5">
                     <thead class="fs-4">
                        <tr>
                           <th scope="col">Przychody</th>
                           <th scope="col">Suma [zł]</th>
                        </tr>
                     </thead>
                     <tbody class="fs-5">
                        <tr>
                   EOD;
                     
                     foreach ($_SESSION['incomesBalance'] as $var){
                      
                        echo "<td>".$var['name']." </td>";
                        echo "<td>".$var['category_sum']." </td>";
                        echo "</tr>";   
                     }

                      echo "</tbody>";
                      echo "<tr class='bg-light fs-4'>";
                        echo "<th>Suma przychodów</th>";
                        echo "<th>".$_SESSION['totalIncomes'][0]."</th>";
                      echo "</tr>";
                      echo "</table>";                        
                        
                  }   

                  if(isset($_SESSION['expensesBalance'])){
                                                                                     
                     echo <<<EOD
                       <table class="table table-striped mb-5">
                       <thead class="fs-4">
                          <tr>
                             <th scope="col">Wydatki</th>
                             <th scope="col">Suma [zł]</th>                           
                          </tr>
                       </thead>
                       <tbody class="fs-5">
                          <tr>
                     EOD;
                       
                       foreach ($_SESSION['expensesBalance'] as $var){
                        
                          echo "<td>".$var['name']." </td>";
                          echo "<td>".($var['category_sum']) ." </td>";                        
                          echo "</tr>";   
                       }
  
                        echo "</tbody>";
                        echo "<tr class='bg-secondary fs-4'>";
                          echo "<th>Suma wydatków</th>";
                          echo "<th>".$_SESSION['totalExpenses'][0]."</th>";
                        echo "</tr>";
                        echo "</table>"; 
                  }


                        echo <<<EOD
                        <header>
                        <h1 class="text-start">Bilans podsumowanie</h1>
                        </header>
                        <table class="table mb-5">
                        <thead>
                        <tr>
                           <th></th>
                           <th></th>
                        </tr>
                        </thead>
                        <tbody class="fs-4">
                        <tr class="bg-info">
                        <th>Twój bilans</th>
                        EOD;

                        function formatPositiveNum($num){
                           return sprintf("%+d",$num); 
                        }
                           
                        $balanceAmount = formatPositiveNum($_SESSION['totalIncomes'][0] - $_SESSION['totalExpenses'][0]);                 

                        echo "<th>". $balanceAmount. " zł</th>";
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";                                   
                    }              
                           echo <<<EOD
                           <div class="row">
                              <div class="col">
                                 <div id="piechart1"></div>          
                              </div>      
                                                            
                              <div class="col">
                                 <div id="piechart2"></div>          
                              </div>      
                           </div>                            
                           EOD; 

                        unset($_SESSION['totalExpenses']);  
                        unset($_SESSION['totalIncomes']); 
                        unset($_SESSION['incomesBalance']); 
                        unset($_SESSION['expensesBalance']);
                        unset($_SESSION['noResultFromIncomesBalance']);
                        unset($_SESSION['noResultFromExpensesBalance']);
                                                            
            ?> 
                 
         </div>    
         <footer>
            <div class="container-fluid my-5 text-white text-center pt-5 pb-5 bg-dark">
               <p class="fs-1 fw-bold">Profesjonalnie buduj swój kapitał osobisty!</p>
            </div>
            <div class="my-5">
               <h5 class="text-center fs-6">© 2022 Twój budżet osobisty. All rights reserved.</h5>
            </div>
         </footer>
      </section>
      
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
          
</body>
</html>