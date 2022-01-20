<?php

    session_start();
    require_once "connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno != 0){

        //Brak polaczenia
        echo "Error: ".$connection->connect_errno;

    }else{

        $login = $_POST['login'];
        $passwd = $_POST['passwd'];

        $sql = "SELECT * FROM users WHERE username='$login' AND password='$passwd'";

        if($result = @$connection->query($sql)){

            //ile wierszy zwroci zapytanie (1-zalogowano 0-niezalogowano)    
            $how_many_users = $result->num_rows;
            if($how_many_users>0){
                //zalogowano
                
                //tworze tablice asocjacyjna (skojarzeniowa)
                //do ktorej powkladane zostana zmienne o nazwach jak kolumny w bazie
                $row = $result->fetch_assoc();

                //zapisujemy do sesji dziki czemu moge przekazywac zmienne
                //miedzy roznymi podstronami
                $_SESSION['user'] = $row['username']; //dzieki fetch_assoc

                unset($_SESSION['login_error']);
                //czyscimy z pamieci RAM serwera nasze zapytania
                $result->close();

                header('Location: menu.php');

            }else{
                $_SESSION['login_error'] = '<div class="fs-5 text-danger mb-3">Niepoprawna nazwa użytkownika lub hasło</div>';
                header('Location: login.php');
            }


        }

        $connection->close();
    }


    

?>