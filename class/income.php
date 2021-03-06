<?php
class income
{
    private $dbo = null;
    private $fields = array();
    
    function __construct($dbo){
        $this->dbo = $dbo;
        $this->initFields();
    }
    function initFields(){
        $this->fields['kwota'] = new FormIncomeInput('kwota', 'Kwota','text');
        $this->fields['data'] = new FormIncomeInput('data', 'Data przychodu', 'date','','dataInput');
        $this->fields['kom'] = new FormIncomeInput('kom', 'Komentarz','text'); 
    }
    function showAddIncomeForm(){
        $formDataIncome = $this->fields;
        include 'templates/addIncomeForm.php';
    }   
    function addIncome(){
        if(empty($_POST['kwota'])||preg_match("/[a-z]/i", $_POST['kwota']))
            return FORM_DATA_MISSING;
        $kwota = $_POST['kwota'];
        $data = $_POST['data'];
        $kom = $_POST['kom'];
        $wyn = $_POST['wynagrodzenie'];
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $kwota = str_replace(',','.',$kwota);
        $kwota = round($kwota, 2); 
        $query = "INSERT INTO przychody VALUES(NULL,'$iduzytkownika','$data','$kwota','$wyn','$kom')";
        if($this->dbo->query($query)){
            return ACTION_OK;
        }else
            return ACTION_FAILED;          
    }
    function addCatIncome(){    
        if(empty($_POST['nowaKat'])||!(ctype_alpha($_POST['nowaKat'])))
            return FORM_DATA_MISSING;
        $nowaKat = $_POST['nowaKat'];
        $iduzytkownika = $_SESSION['zalogowany']->id; 
        $query = "SELECT nazwaKategorii FROM kategorie_przychody_uzytkownika WHERE nazwaKategorii='$nowaKat' AND idUzytkownika = '$iduzytkownika'";
        if($result = $this->dbo->query($query)){
            $rows = $result->num_rows;
            if($rows>0) return CAT_ALREADY_EXISTS;
        else{
            $query="INSERT INTO kategorie_przychody_uzytkownika VALUES(NULL,'$iduzytkownika','$nowaKat')";
            if($this->dbo->query($query)) return ACTION_OK;
            else return ACTION_FAILED;  
            }       
        }
    }
    function editCatIncome(){
        if(empty($_POST['edytKat'])||!(ctype_alpha($_POST['edytKat'])))
            return FORM_DATA_MISSING;
        $wybierzKat = $_POST['wybierzKat'];
        $edytKat = $_POST['edytKat'];
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $query = "SELECT nazwaKategorii FROM kategorie_przychody_uzytkownika WHERE nazwaKategorii='$edytKat' AND idUzytkownika = '$iduzytkownika'";
        if($result = $this->dbo->query($query)){
            $rows = $result->num_rows;
            if($rows>0) return CAT_ALREADY_EXISTS;
        else{
            $query="UPDATE kategorie_przychody_uzytkownika SET nazwaKategorii='$edytKat' WHERE nazwaKategorii='$wybierzKat' AND idUzytkownika='$iduzytkownika'";
            if($this->dbo->query($query)) return ACTION_OK;
            else return ACTION_FAILED;  
            }     
        }  
    }
    function delCatIncome(){
        $usunKat = $_POST['usunKat'];
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $query = "DELETE FROM kategorie_przychody_uzytkownika WHERE nazwaKategorii='$usunKat' AND idUzytkownika = '$iduzytkownika'";
        if($result = $this->dbo->query($query)) return ACTION_OK; else return ACTION_FAILED;     
    }
    function delLastCatIncome(){
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $query = "DELETE FROM przychody WHERE iduzytkownika = '$iduzytkownika' ORDER by idprzychod DESC LIMIT 1";
        if($result = $this->dbo->query($query)) return ACTION_OK; else return ACTION_FAILED;
    }
}