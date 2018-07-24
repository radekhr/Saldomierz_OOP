<?php

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);//sposob raportowania bledow

        try
        {
            $polaczenie = mysqli_connect($host, $user, $password, $database);
            if($polaczenie->connect_errno!=0)
                throw new Exception(mysqli_connect_errno());
            else
            {  
                $zapytanie = "UPDATE przychody SET ".$_POST["name"]." = '".$_POST["value"]."' WHERE idprzychod = '".$_POST["pk"]."'";
                mysqli_query($polaczenie,$zapytanie);
            }
        }catch(Exception $e){
            echo '<span style="color:red;">Błąd serwera! Przepraszamy!</span>';
            echo '<br/>Informacja dev: '.$e;
        }
?>