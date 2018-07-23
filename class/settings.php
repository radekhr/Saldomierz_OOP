<?php
class settings
{
    private $dbo = null;
    
    function __construct($dbo){
        $this->dbo = $dbo;
    }

    function showUserSettings(){
        include 'templates/userSettingsTemplate.php';
    }   
    function changeLogin(){
    $login = $_POST['nowyLogin'];
    if(empty($login))
        return FORM_DATA_MISSING;
    $query = "SELECT * FROM konta WHERE login='$login'";
    if($result = $this->dbo->query($query)){
        $rows = $result->num_rows;
        if($rows>0)
            return USER_NAME_ALREADY_EXISTS;
        else{
            $iduzytkownika = $_SESSION['zalogowany']->id;
            $query="UPDATE konta SET login='$login' WHERE iduzytkownika='$iduzytkownika'";
            if($result = $this->dbo->query($query))
                return ACTION_OK;
            else return ACTION_FAILED;
            }
        }
    }

    function changePass(){
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
        
    if(empty($haslo1)||empty($haslo2))
        return FORM_DATA_MISSING;
    if(strlen($haslo1)<4 && !preg_match("#[0-9]+#", $haslo1))
        return INVALID_PASS;
    if($haslo1 != $haslo2)
        return PASSWORDS_DO_NOT_MATCH;
       
     $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
     $iduzytkownika = $_SESSION['zalogowany']->id;   
     $query="UPDATE konta SET haslo='$haslo_hash' WHERE iduzytkownika='$iduzytkownika'";
     if($result = $this->dbo->query($query))
        return ACTION_OK;
     else return ACTION_FAILED;
    } 
  
    function changeEmail(){
    $mail = $_POST['mail'];
    $mailSanit = filter_var($mail, FILTER_SANITIZE_EMAIL);
    if((!filter_var($mailSanit, FILTER_VALIDATE_EMAIL))||($mailSanit != $mail)){
        return INVALID_EMAIL;
    }
    $query = "SELECT * FROM konta WHERE email='$mail'";
    if($result = $this->dbo->query($query)){
        $rows = $result->num_rows;
        if($rows>0) return EMAIL_IN_DATABASE;
        else{
            $iduzytkownika = $_SESSION['zalogowany']->id;   
            $query="UPDATE konta SET email='$mail' WHERE iduzytkownika='$iduzytkownika'";
            if($result = $this->dbo->query($query))
                return ACTION_OK;
             else return ACTION_FAILED;    
            }
        }
    }
}
