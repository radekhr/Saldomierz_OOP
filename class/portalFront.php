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
        $query = "SELECT haslo,login FROM konta WHERE login='$login'";
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
                $_SESSION['zalogowany'] = new User($row[0], $nazwa);
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
                return $menu->show();
            }    
        }
        
        
        /*
        function showSearchForm()
        {
            $autor = filter_input(INPUT_GET, 'autor', FILTER_SANITIZE_SPECIAL_CHARS);
            $tytul = filter_input(INPUT_GET, 'tytul', FILTER_SANITIZE_SPECIAL_CHARS);
            include 'templates/searchForm.php';
        }
        function showSearchResults()
        {
        //Określenie warunku dla autora
        if(isset($_GET['autor']) && $_GET['autor'] != ''){
        //Tu lub po przefiltrowaniu dodatkowa weryfikacja poprawności parametru
            $autor = filter_input(INPUT_GET, 'autor',FILTER_SANITIZE_SPECIAL_CHARS);
            $cond1 = " AND a.`Nazwa` LIKE '%$autor%' ";
        }
        else{
            $cond1 = '';
        }
        //Określenie warunku dla tytułu
        if(isset($_GET['tytul']) && $_GET['tytul'] != ''){
        //Tu lub po przefiltrowaniu dodatkowa weryfikacja poprawności parametru
            $tytul = filter_input(INPUT_GET, 'tytul',
            FILTER_SANITIZE_SPECIAL_CHARS);
            $cond2 = " AND k.`Tytul` LIKE '%$tytul%' ";
        }
        else{
            $cond2 = '';
        }
        //Formowanie zapytania
          $query= 'SELECT k.`Tytul`, GROUP_CONCAT(a.`Nazwa`) AS `Autor`,'
            .'k.`ISBN`, w.`Nazwa` AS `Wydawnictwo`, k.`Cena`,'
            .'k.`Id` AS `Id` '
            .'FROM Ksiazki k JOIN Wydawnictwa w ON (k.WydawnictwoId = w.Id) JOIN KsiazkiAutorzy ka ON (ka.`KsiazkaId` = k.`Id`) '
            .'JOIN Autorzy a ON (ka.`AutorId` = a.`Id`) '
            .'WHERE 1=1  '.$cond1.$cond2.''
            .'GROUP BY k.`Id` '
            .'ORDER BY `Autor`, `Tytul`, `Wydawnictwo`';
            
        $query = 'SELECT k.`Tytul`, GROUP_CONCAT(a.`Nazwa`) AS `Autor`, '
        . 'k.`ISBN`, w.`Nazwa` AS `Wydawnictwo`, k.`Cena`, '
        . 'k.`Id` AS `Id` '
        . 'FROM Ksiazki k JOIN Wydawnictwa w ON (k.WydawnictwoId = w.Id) '
        . 'JOIN KsiazkiAutorzy ka ON (ka.`KsiazkaId` = k.`Id`) '
        . 'JOIN Autorzy a ON (ka.`AutorId` = a.`Id`) WHERE 1=1 '
        . $cond1.$cond2
        . 'GROUP BY k.`Id` ORDER BY `Autor`, `Tytuł`, `Wydawnictwo`';
        //Wykonanie zapytania i sprawdzenie wyników
        $komunikat = false;
        if(!$result = $this->dbo->query($query)){
            $komunikat = 'Wyniki wyszukiwania nie są obecnie dostępne.';
        } else if($result->num_rows < 1) {
            $komunikat = 'Brak książek spełniających podane kryteria.';
        }
        //Wyświetlenie rezultatów wyszukiwania
        include 'templates/searchResults.php';
        }
*/
        //Tutaj pozostałe metody klasy
    }
?>