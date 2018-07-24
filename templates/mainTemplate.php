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
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
<!--BS3-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--XEDITABLE-->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
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
                case 'showAddIncomeForm':
                    $portal->showMainMenu();
                    $portal->showAddIncomeForm();
                break;
                case 'showAddExpenseForm':
                    $portal->showMainMenu();
                    $portal->showAddExpenseForm();
                break;
                case 'showUserSettings':
                    $portal->showMainMenu();
                    $portal->showUserSettings();
                break;
                case 'showOptions':
                    $portal->showMainMenu();
                    $portal->showOptions();
                break;
                case 'showBalance':
                    $portal->showMainMenu();
                    $portal->showBalance();
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
