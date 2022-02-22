<?php
   session_start();
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
               <li class="nav-item d-md-none">
                  <a href="login.php" class="nav-link active">Zaloguj się</a>
               </li>
               <li class="nav-item ms-2 d-none d-md-inline">
                  <a href="login.php" class="btn btn-outline-light fw-normal bg-light text-primary pt-3 pb-3 ps-4 pe-4" aria-current="page">Zaloguj się</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
   <!-- main secion -->
   <section id="main">
      <div class="container-xxl mt-5">
         <div class="row justify-content-between">
            <div class="col-md-6 col-lg-7 text-center">
               <header>
                  <h1 class="text-md-start text-center">Zarejestruj się już teraz aby zarządzać swoim budżetem.</h1>
               </header>
               <ul class="text-start">
                  <li><i class="demo-icon icon-ok"><span>Zbierz wszystkie swoje przychody w jednym miejscu.</span></i></li>
                  <li><i class="demo-icon icon-ok"><span>Rozsądnie kalkuluj swoje wydatki.</span></i></li>
                  <li><i class="demo-icon icon-ok"><span>Analizuj swój budżet aby lepiej nim zarządzać.</span></i></li>
                  <li><i class="demo-icon icon-ok"><span>Zacznij już dzisiaj korzystać z aplikacji Twój budżet.</span></i></li>
               </ul>
               <img class="img-fluid d-none d-lg-block p-5" src="img/mainChart.png" alt="main chart">
            </div>
          <!-- fomrm & inputs -->
            <div class="col-md-6 col-lg pe-3">
               <form method="POST" action="includes/signup.inc.php" class="needs-validation" novalidate>
                  <div class="mb-3 mt-5">
                     <label for="inputName1" class="form-label fs-5">Podaj nazwę użytkownika</label>
                     <input type="text" name="uid" value="<?php if(isset($_SESSION['fr_nick'])){
                        echo $_SESSION['fr_nick'];
                        unset($_SESSION['fr_nick']);
                     } ?>" 
                     class="form-control fs-5 pt-3 pb-3 shadow-none
                        <?php
                           if(isset($_SESSION['e_nick'])) {
                              echo 'is-invalid';
                           }
                        ?>
                     " id="inputName1" minlength="4" required>
                     <div class="invalid-feedback">
                     <?php
                     
                        if(isset($_SESSION['e_nick'])) {
                           echo $_SESSION['e_nick'];
                           unset($_SESSION['e_nick']); 
                        } else {
                           echo 'Wprowadź poprawną nazwę (min. 4 znaki)';
                        }
                     ?>
                     </div>                     
                  </div>
                  <div class="mb-3">
                    <label for="inputEmail1" class="form-label fs-5">Podaj swój adres email</label>
                    <input type="email" name="email" value="<?php if(isset($_SESSION['fr_email'])){
                        echo $_SESSION['fr_email'];
                        unset($_SESSION['fr_email']);
                     } ?>" class="form-control fs-5 pt-3 pb-3 shadow-none
                           <?php
                           if(isset($_SESSION['e_email'])) {
                              echo 'is-invalid';
                           }
                           ?>                    
                     " id="inputEmail1" aria-describedby="emailHelp" required>
                    <div class="invalid-feedback">
                    <?php
                     
                        if(isset($_SESSION['e_email'])) {
                           echo $_SESSION['e_email'];
                           unset($_SESSION['e_email']); 
                        } else {
                           echo 'Wprowadź poprawną nazwę email';
                        }
                     ?>
                  </div>
                  
                  <?php
                     if(isset($_SESSION['e_email'])) {
                        echo '<div class="fs-5 text-danger mb-3">'.$_SESSION['e_email'].'</div>';
                        unset($_SESSION['e_email']);
                     }
                  ?>
                  
                  <div id="emailHelp" class="form-text">Nigdy nie udostepnimy nikomu twojego adresu</div>
                  </div>
                  <div class="mb-3">
                    <label for="inputPassword1" class="form-label fs-5">Utwórz swoje hasło</label>
                    <input type="password" name="passwd" class="form-control fs-5 pt-3 pb-3 shadow-none" id="inputPassword1" minlength="8" required>
                    <div class="invalid-feedback">
                     Wprowadź poprawne hasło (min. 8 znaków)
                  </div> 
                  <?php
                     if(isset($_SESSION['e_passwd'])) {
                        echo '<div class="fs-5 text-danger mb-3">'.$_SESSION['e_passwd'].'</div>';
                        unset($_SESSION['e_passwd']);
                     }
                  ?>
                  </div>                 
                  <button type="submit" name="submit" class="btn btn-light p-3" onclick="clearInputs();">Zarejestruj się</button>
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