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
    //Sprawdzenie, czy wykryto puste pola
    if($emptyFieldDetected){
        return FORM_DATA_MISSING;
    }
    //Sprawdzenie, czy podany e-mail jest już w bazie
    $query = "SELECT * FROM konta WHERE email='".$fieldsFromForm['email']."' OR login='".$fieldsFromForm['login']."'";
    if($result = $this->dbo->query($query)){
        $rows = $result->num_rows;
        if($rows>0){
            return USER_NAME_ALREADY_EXISTS;
        }
    }
    //Sprawdzenie zgodności hasła z obu pól
    if($fieldsFromForm['haslo'] != $fieldsFromForm['haslo2']){
        return PASSWORDS_DO_NOT_MATCH;
    }
    unset($fieldsFromForm['haslo2']);
    unset($this->fields['haslo2']);
    //Zakodowanie hasła
    $fieldsFromForm['haslo'] = crypt($fieldsFromForm['haslo']);
    //Przygotowanie ciągów nazw pól i wartości pól dla zapytania SQL
    $fieldsNames = '`'.implode('`,`', array_keys($this->fields)).'`';
    $fieldsVals = '\''.implode('\',\'', $fieldsFromForm).'\''; //('xxx')
    //Formowanie i wykonanie zapytania
    $query = "INSERT INTO konta VALUES ('NULL',$fieldsVals)";
    if($this->dbo->query($query))
    {
        $query1 = "INSERT INTO kategorie_wydatki_uzytkownika(nazwaKategorii) SELECT kategorie_wydatki_domyslne.nazwaKategorii FROM kategorie_wydatki_domyslne";/*
        $query2 = "INSERT INTO kategorie_przychody_uzytkownika(nazwaKategorii) SELECT kategorie_przychody_domyslne.nazwaKategorii FROM kategorie_przychody_domyslne";
        if($this->dbo->query($query1) && this->dbo->query($query2)){
            $query="UPDATE kategorie_przychody_uzytkownika, kategorie_wydatki_uzytkownika SET idUzytkownika = '$iduzytkownika' WHERE idUzytkownika = '0'"
            
        }*/
         return ACTION_OK;
    }    
    else
        return ACTION_FAILED;
    }
}