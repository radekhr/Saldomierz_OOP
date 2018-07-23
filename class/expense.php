<?php
class expense
{
    private $dbo = null;
    private $fields = array();
    
    function __construct($dbo){
        $this->dbo = $dbo;
        $this->initFields();
    }
    function initFields(){
        $this->fields['kwota'] = new FormExpenseInput('kwota', 'Kwota','text');
        $this->fields['data'] = new FormExpenseInput('data', 'Data wydatku', 'date','','dataInput');
        $this->fields['kom'] = new FormExpenseInput('kom', 'Komentarz','text'); 
    }
    function showAddExpenseForm(){
        $formDataIncome = $this->fields;
        include 'templates/addExpenseForm.php';
    }   
    function addExpense(){
        if(empty($_POST['kwota'])||preg_match("/[a-z]/i", $_POST['kwota'])){
            return FORM_DATA_MISSING;
        }
        $kwota = $_POST['kwota'];
        $data = $_POST['data'];
        $kom = $_POST['kom'];
        $kategoria = $_POST['kategoria'];
        $sposobPlat = $_POST['sposobPlat'];
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $kwota = str_replace(',','.',$kwota);
        $kwota = round($kwota, 2); 
        $query = "INSERT INTO wydatki VALUES(NULL,'$data','$kwota','$kategoria','$sposobPlat','$kom','$iduzytkownika')";
        if($this->dbo->query($query)){
            return ACTION_OK;
        }else
            return ACTION_FAILED;          
    }
    function addCatExpense(){    
        if(empty($_POST['nowaKat'])||!(ctype_alpha($_POST['nowaKat'])))
            return FORM_DATA_MISSING;
        $nowaKat = $_POST['nowaKat'];
        $iduzytkownika = $_SESSION['zalogowany']->id; 
        $query = "SELECT nazwaKategorii FROM kategorie_wydatki_uzytkownika WHERE nazwaKategorii='$nowaKat' AND idUzytkownika = '$iduzytkownika'";
        if($result = $this->dbo->query($query)){
            $rows = $result->num_rows;
            if($rows>0) return CAT_ALREADY_EXISTS;
        else{
            $query="INSERT INTO kategorie_wydatki_uzytkownika VALUES(NULL,'$iduzytkownika','$nowaKat')";
            if($this->dbo->query($query)) return ACTION_OK;
            else return ACTION_FAILED;  
            }       
        }
    }
    function editCatExpense(){
        if(empty($_POST['edytKat'])||!(ctype_alpha($_POST['edytKat'])))
            return FORM_DATA_MISSING;
        $wybierzKat = $_POST['wybierzKat'];
        $edytKat = $_POST['edytKat'];
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $query = "SELECT nazwaKategorii FROM kategorie_wydatki_uzytkownika WHERE nazwaKategorii='$edytKat' AND idUzytkownika = '$iduzytkownika'";
        if($result = $this->dbo->query($query)){
            $rows = $result->num_rows;
            if($rows>0) return CAT_ALREADY_EXISTS;
        else{
            $query="UPDATE kategorie_wydatki_uzytkownika SET nazwaKategorii='$edytKat' WHERE nazwaKategorii='$wybierzKat' AND idUzytkownika='$iduzytkownika'";
            if($this->dbo->query($query)) return ACTION_OK;
            else return ACTION_FAILED;  
            }     
        }  
    }
    function delCatExpense(){
        $usunKat = $_POST['usunKat'];
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $query = "DELETE FROM kategorie_wydatki_uzytkownika WHERE nazwaKategorii='$usunKat' AND idUzytkownika = '$iduzytkownika'";
        if($result = $this->dbo->query($query)) return ACTION_OK; else return ACTION_FAILED;     
    }
    function delLastCatExpense(){
        $iduzytkownika = $_SESSION['zalogowany']->id;
        $query = "DELETE FROM wydatki WHERE iduzytkownika = '$iduzytkownika' ORDER by idwydatek DESC LIMIT 1";
        if($result = $this->dbo->query($query)) return ACTION_OK; else return ACTION_FAILED;
    }
}