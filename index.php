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
                    case INVALID_LOGIN:
                        $portal->setMessage('Login musi zawierać od 5 do 20 znaków!');
                    break;
                    case INVALID_EMAIL:
                        $portal->setMessage('Proszę wpisać poprawny adres email!');
                    break;
                    case INVALID_PASS:
                        $portal->setMessage('Hasło musi posiadać conajmniej 5 znaków w tym jedną cyfrę!');
                    break;
                    case PASSWORDS_DO_NOT_MATCH:
                        $portal->setMessage('Hasło musi być takie samo w obu polach!');
                    break;
                    case USER_NAME_ALREADY_EXISTS:
                        $portal->setMessage('Podany adres e-mail lub login jest już zarejestrowany!');
                    break;
                    case ACTION_FAILED:
                        $portal->setMessage('Akcja nieudana. Spróbuj się zarejestrować za kilka minut');
                    break;
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                     break;                        
                }
                header('Location:index.php?action=showRegistrationForm');
            break;
            case 'mainMenu':
                $portal->showMainMenu();
            break;
            case 'addIncome':
                switch($portal->addIncome()){
                    case ACTION_OK:
                        $portal->setMessage('Przychód pomyślnie dodany');
                    break;
                    case FORM_DATA_MISSING:
                        $portal->setMessage('Kwota nie może zawierać liter ani być pusta!');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showAddIncomeForm');
            break;
            case 'addExpense':
                switch($portal->addExpense()){
                    case ACTION_OK:
                        $portal->setMessage('Wydatek pomyślnie dodany');
                    break;
                    case FORM_DATA_MISSING:
                        $portal->setMessage('Kwota nie może zawierać liter ani być pusta!');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showAddExpenseForm');
            break;
            case 'userSettings':
                $portal->showUserSettings();
            break;
            case 'changeLogin':
                 switch($portal->changeLogin()){
                    case ACTION_OK:
                        $portal->setMessage('Login został pomyślnie zmieniony');
                    break;
                    case USER_NAME_ALREADY_EXISTS:
                        $portal->setMessage('Login aktualnie jest zajęty');
                    break;
                     case FORM_DATA_MISSING:
                        $portal->setMessage('Proszę wprowadzić login');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showUserSettings');
            break;  
            case 'changePass':
                 switch($portal->changePass()){
                    case ACTION_OK:
                        $portal->setMessage('Hasło zostało pomyślnie zmienione');
                    break;
                    case INVALID_PASS:
                        $portal->setMessage('Hasło musi posiadać conajmniej 5 znaków w tym jedną cyfrę');
                    break;
                    case PASSWORDS_DO_NOT_MATCH:
                        $portal->setMessage('Wpisane hasła są różne');
                    break;
                     case FORM_DATA_MISSING:
                        $portal->setMessage('Proszę wprowadzić hasło');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showUserSettings');
            break;
            case 'changeEmail':
                 switch($portal->changeEmail()){
                    case ACTION_OK:
                        $portal->setMessage('Email został pomyślnie zmieniony');
                    break;
                    case INVALID_EMAIL:
                        $portal->setMessage('Wprowadź poprawnie adres email');
                    break;
                    case EMAIL_IN_DATABASE:
                        $portal->setMessage('Wprowadzony email jest już w bazie');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showUserSettings');
            break;
            case 'options':
                $portal->showOptions();
            break;
            case 'addCatIncome':
                 switch($portal->addCatIncome()){
                    case ACTION_OK:
                        $portal->setMessage('Kategoria przychodu została pomyślnie dodana');
                    break;
                    case CAT_ALREADY_EXISTS:
                        $portal->setMessage('Taka kategoria już istnieje w bazie');
                    break;
                     case FORM_DATA_MISSING:
                        $portal->setMessage('Proszę wprowadzić kategorię (bez cyfr)');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;   
            case 'addCatExpense':
                 switch($portal->addCatExpense()){
                    case ACTION_OK:
                        $portal->setMessage('Kategoria wydatku została pomyślnie dodana');
                    break;
                    case CAT_ALREADY_EXISTS:
                        $portal->setMessage('Taka kategoria już istnieje w bazie');
                    break;
                     case FORM_DATA_MISSING:
                        $portal->setMessage('Proszę wprowadzić kategorię (bez cyfr)');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;
            case 'editCatIncome':
                 switch($portal->editCatIncome()){
                    case ACTION_OK:
                        $portal->setMessage('Wybrana kategoria przychodu została zmieniona');
                    break;
                    case CAT_ALREADY_EXISTS:
                        $portal->setMessage('Taka kategoria już istnieje w bazie');
                    break;
                     case FORM_DATA_MISSING:
                        $portal->setMessage('Proszę wprowadzić kategorię (bez cyfr)');
                    break;
                    case ACTION_FAILED:
                    case SERVER_ERROR:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;  
            case 'editCatExpense':
                 switch($portal->editCatExpense()){
                    case ACTION_OK:
                        $portal->setMessage('Wybrana kategoria wydatku została zmieniona');
                    break;
                    case CAT_ALREADY_EXISTS:
                        $portal->setMessage('Taka kategoria już istnieje w bazie');
                    break;
                     case FORM_DATA_MISSING:
                        $portal->setMessage('Proszę wprowadzić kategorię (bez cyfr)');
                    break;
                    case ACTION_FAILED:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;
            case 'delCatIncome':
                 switch($portal->delCatIncome()){
                    case ACTION_OK:
                        $portal->setMessage('Wybrana kategoria przychodu została usunięta');
                    break;
                    case ACTION_FAILED:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;                
            case 'delCatExpense':
                 switch($portal->delCatExpense()){
                    case ACTION_OK:
                        $portal->setMessage('Wybrana kategoria wydatku została usunięta');
                    break;
                    case ACTION_FAILED:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;
            case 'delLastCatIncome':
                 switch($portal->delLastCatIncome()){
                    case ACTION_OK:
                        $portal->setMessage('Ostatni wpis przychodu został usunięty');
                    break;
                    case ACTION_FAILED:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;                
            case 'delLastCatExpense':
                 switch($portal->delLastCatExpense()){
                    case ACTION_OK:
                        $portal->setMessage('Ostatni wpis wydatku został usunięty');
                    break;
                    case ACTION_FAILED:
                    default:
                        $portal->setMessage('Błąd serwera!');
                }
                header('Location:index.php?action=showOptions');
            break;   
            case 'balance':
                $portal ->showBalance();
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