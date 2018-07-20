<?php if(!isset($portal)) die();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name ="description" content="Przed Tobą twój prywatny saldomierz - sprawdź swoje wydatki/przychody!">
<meta name ="keywords" content="pieniadze, konto, oszczednosci, budżet, bilans">
<meta name="viewport" content="width = device-width, initial-scale = 1">

<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
<title>Saldomierz</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css" type="text/css"/>

</head>
<body> 
   <main role="main" class="container">       
    <header><h1>SALDOMIERZ</h1></header>
      <div id="mainContent" class="jumbotron">
      <?php if($komunikat): ?>
                <div class="komunikat"><?=$komunikat;?></div>
            <?php endif; ?>
            <?php
            switch($action):
                    case 'showLoginForm' :
                        include 'loginForm.php';   
                    break;
                    case 'showRegistrationForm' :
                        $portal->showRegistrationForm();
                    break;
                 
                    case 'showMainMenu':
                        $portal->showMainMenu();
                    break;
                    default:
                        include 'welcomeTemplate.php';
                endswitch;
            ?>
     </div>
   </main>
    
    <footer class="footer">
        <p>Autor: Radosław Hryniewicki. Kontakt mail: <a href="mailto:radek.hryn@gmail.com" target="_top" style="text-decoration:none;"><span class="glyphicon glyphicon-envelope"></span></a></p>
    </footer>
    </body>
</html>

