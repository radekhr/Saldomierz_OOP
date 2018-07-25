<?php
class Registration
{
    private $dbo = null;
    private $fields = array();
    
    function __construct($dbo)
    {
        $this->dbo = $dbo;
        $this->initFields();
    }
    function initFields()
    {
       
        $this->fields['login'] = new FormRegInput('login', 'Login');
        $this->fields['haslo'] = new FormRegInput('haslo', 'Hasło', 'password');
        $this->fields['haslo2'] = new FormRegInput('haslo2', 'Powtórz hasło', 'password');
        $this->fields['email'] = new FormRegInput('email', 'Adres e-mail');
 
    }
    function showRegistrationForm()
    {
        $formData = $this->fields;
        include 'templates/registrationForm.php';
    }   

    function registerUser(){ 
    foreach($this->fields as $name => $val){
        if(!isset($_POST[$name])){
            return FORM_DATA_MISSING;
        }
    }
    //Tutaj lub po przefiltrowaniu dodatkowa weryfikacja danych,
    //w tym sprawdzenie długości ciągów, znaków niedozwolonych itp.
    $login = $_POST['login'];
    $pass = $_POST['haslo'];
    $email = $_POST['email'];
    if(strlen($login)<4 || strlen($login)>20){
        return INVALID_LOGIN;
    }
    if(strlen($pass)<4 && !preg_match("#[0-9]+#", $pass)){
        return INVALID_PASS;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return INVALID_EMAIL;
    }
        
    //Odczyt i przefiltrowanie danych z formularza
        
    $fieldsFromForm = array();
    $emptyFieldDetected = false;
    foreach($this->fields as $name => $val){
        if($val->type != 'password'){
        $fieldsFromForm[$name] = filter_input(INPUT_POST, $name,
        FILTER_SANITIZE_SPECIAL_CHARS);
    } else {
        $fieldsFromForm[$name] = $_POST[$name];
    }
    $fieldsFromForm[$name] = $this->dbo->real_escape_string($fieldsFromForm[$name]);
    if($fieldsFromForm[$name] == '' && $val->required){
        $emptyFieldDetected = true;
    }
    }

    if($emptyFieldDetected){
        return FORM_DATA_MISSING;
    }

    $query = "SELECT * FROM konta WHERE email='".$fieldsFromForm['email']."' OR login='".$fieldsFromForm['login']."'";
    if($result = $this->dbo->query($query)){
        $rows = $result->num_rows;
        if($rows>0){
            return USER_NAME_ALREADY_EXISTS;
        }
    }

    if($fieldsFromForm['haslo'] != $fieldsFromForm['haslo2']){
        return PASSWORDS_DO_NOT_MATCH;
    }
    unset($fieldsFromForm['haslo2']);
    unset($this->fields['haslo2']);
    $fieldsFromForm['haslo'] = crypt($fieldsFromForm['haslo']);

    $fieldsNames = '`'.implode('`,`', array_keys($this->fields)).'`';
    $fieldsVals = '\''.implode('\',\'', $fieldsFromForm).'\''; 

    $query = "INSERT INTO konta VALUES ('NULL',$fieldsVals)";
    if($this->dbo->query($query)){
        $query = "SELECT iduzytkownika FROM konta where login='".$fieldsFromForm['login']."'";
        $idUser = $this->dbo->query($query)->fetch_object()->iduzytkownika;       
        $this->pullCategories($idUser); 
        return ACTION_OK;
    }  
    }
    
    function pullCategories($idUser){
        $query = "INSERT INTO kategorie_wydatki_uzytkownika(nazwaKategorii) SELECT kategorie_wydatki_domyslne.nazwaKategorii FROM kategorie_wydatki_domyslne";
            $this->dbo->query($query);
        $query = "INSERT INTO kategorie_przychody_uzytkownika(nazwaKategorii) SELECT kategorie_przychody_domyslne.nazwaKategorii FROM kategorie_przychody_domyslne";
            $this->dbo->query($query);
        $query="UPDATE kategorie_przychody_uzytkownika SET idUzytkownika = '$idUser' WHERE idUzytkownika = '0'";
            $this->dbo->query($query);
        $query="UPDATE kategorie_wydatki_uzytkownika SET idUzytkownika = '$idUser' WHERE idUzytkownika = '0'";
            $this->dbo->query($query);
    }
}