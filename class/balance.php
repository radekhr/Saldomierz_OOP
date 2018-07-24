<?php
class balance
{
    private $dbo = null;
    
    function __construct($dbo){
        $this->dbo = $dbo;
    }

    function showBalance(){
        include 'templates/balanceTemplate.php';
    }  
}