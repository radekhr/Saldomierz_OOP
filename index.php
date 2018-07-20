<?php
    include 'constants.php';
    spl_autoload_register('classLoader');

    session_start();
    try
    {
        $portal = new PortalFront("localhost", "root", "", "saldomierz");
        $action = 'showWelcomeContent';
        if (isset($_GET['action'])) 
        {
            $action = $_GET['action'];
        }
        $komunikat = $portal->getMessage();
        if(!$komunikat && $action == 'showLoginForm')
        {
            $komunikat = '<div class="alert alert-warning">Podaj swój login i hasło</div>';
        }
        if(($action == 'showLoginForm' || $action == 'showRegistrationForm' ||
        $action == 'registerUser') && $portal->zalogowany){
        $portal->setMessage('Najpierw proszę się wylogować.');
        header('Location:index.php?action=showMainMenu');
        return;
        }
         
        switch($action)
        {
            case 'login' :
                switch($portal->login()){
                    case ACTION_OK :
                        header('Location:index.php?action=showMainMenu');
                        return;
                    case NO_LOGIN_REQUIRED :
                        $portal->setMessage('Najpierw proszę się wylogować.');
                        header('Location:index.php?action=showMainMenu');
                        return;
                    case ACTION_FAILED :
                    case FORM_DATA_MISSING :
                        $portal->setMessage('Błędna nazwa lub hasło użytkownika');
                        break;
                    default:
                        $portal->setMessage('Błąd serwera. Zalogowanie nie jest obecnie możliwe.');
                }
                header('Location:index.php?action=showLoginForm');
            break;
                
            case 'logout':
                $portal->logout();
                header('Location:index.php?action=showWelcomeContent');
            break;
                
            case 'registerUser':
                switch($portal->registerUser()){
                    case ACTION_OK:
                        $portal->setMessage('Rejestracja prawidłowa. Możesz się teraz zalogować.');
                        header('Location:index.php?action=showLoginForm');
                        return;
                    case FORM_DATA_MISSING:
                        $portal->setMessage('Proszę wypełnić wszystkie pola formularza!');
                    break;
                    case PASSWORDS_DO_NOT_MATCH:
                        $portal->setMessage('Hasło musi być takie samo w obu polach!');
                    break;
                    case USER_NAME_ALREADY_EXISTS:
                        $portal->setMessage('Podany adres e-mail lub login jest już zarejestrowany!');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showRegistrationForm');
            break;
            case 'mainMenu':
                $portal->showMainMenu();
            break;
                
            default:
            include 'templates/mainTemplate.php';
        }
    }
    catch(Exception $e){
        echo 'Błąd: ' . $e->getMessage();
        exit('Portal chwilowo niedostępny');
    }

  function classLoader($nazwa){
    if(file_exists('class/'.$nazwa.'.php'))
        require_once ('class/'.$nazwa.'.php');
     else 
        throw new Exception("Brak pliku z definicją klasy.");
    } 
?>