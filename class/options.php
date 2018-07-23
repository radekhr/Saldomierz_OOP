<?php
class options
{
    private $dbo = null;
    
    function __construct($dbo){
        $this->dbo = $dbo;
    }

    function showOptions(){
        include 'templates/optionsTemplate.php';
    }  
}