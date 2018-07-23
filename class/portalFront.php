<?php
    class Portal
    {
        private $dbo = null;
        
        function __construct($host, $user, $pass, $db){
            $this->dbo = $this->initDB($host, $user, $pass, $db);
        }
        function initDB($host, $user, $pass, $db){
            $dbo = new mysqli($host, $user, $pass, $db);
            if($dbo->connect_errno){
                $msg = "Brak połączenia z bazą danych: ";
                $msg .= $dbo->connect_error;
                throw new Exception($msg);
            }
                return $dbo;
        }
        function getActualUser(){
            if(isset($_SESSION['zalogowany'])){
                return $_SESSION['zalogowany'];
            }
            else{
                return null;
            }
        }
        
    //Dalsze metody klasy
    }

    class PortalFront extends Portal
    {
        public $zalogowany = null;
        
        function __construct($host, $user, $pass, $db){
            $this->dbo = $this->initDB($host, $user, $pass, $db);
            $this->zalogowany = $this->getActualUser();
        }
        function setMessage($komunikat){
            $_SESSION['komunikat'] = $komunikat;
        }
        function getMessage(){
            if(isset($_SESSION['komunikat'])){
                $komunikat = '<div class="alert alert-danger">'.$_SESSION['komunikat'].'</div>';              
                unset($_SESSION['komunikat']);
                return $komunikat;
            }
            else 
                return null;    
        }  
        function login(){
        if(!$this->dbo) 
            return SERVER_ERROR;
        //Sprawdzenie, czy użytkownik już jest zalogowany
        if($this->zalogowany){
            return NO_LOGIN_REQUIRED;
        }
        //Sprawdzenie, czy zostały przekazane parametry
        if(!isset($_POST["login"]) || !isset($_POST["haslo"])){
        return FORM_DATA_MISSING;
        }

        $login = $_POST["login"];
        $pass = $_POST["haslo"];
        $login = htmlentities($login, ENT_QUOTES,"UTF-8");
            
        //Sprawdzenie długości przekazanych ciągów
        $loginLength = strlen(utf8_decode($login));
        $passLength = strlen(utf8_decode($pass));
            
            /*echo "$userNameLength<br/>";
            echo $userPassLength;
            die();*/        

        //Zabezpieczenie znaków specjalnych w parametrach
        $login = $this->dbo->real_escape_string($login);
        $pass = $this->dbo->real_escape_string($pass);
        //Wykonanie zapytania sprawdzającego poprawność danych
        $query = "SELECT haslo,login,iduzytkownika FROM konta WHERE login='$login'";
        if(!$result = $this->dbo->query($query)){
        //echo 'Wystąpił błąd: nieprawidłowe zapytanie...';
            return SERVER_ERROR;
        }
        //Sprawdzenie wyników zapytania
        if($result->num_rows <> '1'){
        //Brak użytkownika o wskazanej nazwie lub zbyt wiele wyników
            return ACTION_FAILED;
        }
        else{
            $row = $result->fetch_row();
            $pass_db = $row[0];
            if(!password_verify($pass, $pass_db))
            {
                return ACTION_FAILED;
            }
            else{
                $nazwa = $row[1];
                $id = $row[2];
                $_SESSION['zalogowany'] = new User($pass_db, $nazwa, $id);
                return ACTION_OK;
            }
        }
        }
        function logout(){
            if(isset($_SESSION['zalogowany'])){
            unset($_SESSION['zalogowany']);
            $this->zalogowany = null;
            }          
        }
        function showRegistrationForm(){
            $reg = new registration($this->dbo);
            return $reg->showRegistrationForm();
        }
        function registerUser(){
            $reg = new registration($this->dbo);
            return $reg->registerUser();
        }
        function showMainMenu(){
            if(isset($_SESSION['zalogowany'])){
                $menu = new mainmenu();
                return $menu->showMainMenu();
            }    
        }
        function showAddIncomeForm(){
            $addInc = new income($this->dbo);
            return $addInc->showAddIncomeForm();
        }
        function addIncome(){
            $addInc = new income($this->dbo);
            return $addInc->addIncome();
        }
        function showAddExpenseForm(){
            $addExp = new expense($this->dbo);
            return $addExp->showAddExpenseForm();
        }
        function addExpense(){
            $addExp = new expense($this->dbo);
            return $addExp->addExpense();
        }
        function showUserSettings(){
            $userSet = new settings($this->dbo);
            return $userSet->showUserSettings();
        }
        function changeLogin(){
            $userSet = new settings($this->dbo);
            return $userSet->changeLogin();
        }
        function changePass(){
            $userSet = new settings($this->dbo);
            return $userSet->changePass();
        }
        function changeEmail(){
            $userSet = new settings($this->dbo);
            return $userSet->changeEmail();
        }
        function showOptions(){
            $opt = new options($this->dbo);
            return $opt->showOptions();
        }
        function addCatIncome(){
            $opt = new income($this->dbo);
            return $opt->addCatIncome();
        }
        function addCatExpense(){
            $opt = new expense($this->dbo);
            return $opt->addCatExpense();
        }
        function editCatIncome(){
            $opt = new income($this->dbo);
            return $opt->editCatIncome();
        }
        function editCatExpense(){
            $opt = new expense($this->dbo);
            return $opt->editCatExpense();
        }
        function delCatIncome(){
            $opt = new income($this->dbo);
            return $opt->delCatIncome();
        }
        function delCatExpense(){
            $opt = new expense($this->dbo);
            return $opt->delCatExpense();
        }
        function delLastCatIncome(){
            $opt = new income($this->dbo);
            return $opt->delLastCatIncome();
        }
        function delLastCatExpense(){
            $opt = new expense($this->dbo);
            return $opt->delLastCatExpense();
        }
        
        
    }
      
?>