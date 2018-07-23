<?php
class User
{
    public $id;
    public $nazwa;
    public $pass;
    
    function __construct($pass, $nazwa, $id){
        $this->id = $id;
        $this->nazwa = $nazwa;
        $this->pass = $pass;
    }
}
?>