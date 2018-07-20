<?php
class mainMenu
{
    private $zalogowany = null;
    
    
    function __construct(){
            $this->zalogowany = $this->getActualUser();
        }
    function getActualUser(){
            if(isset($_SESSION['zalogowany'])){
                return $_SESSION['zalogowany'];
            }
            else{
                return null;
            }
        }
    
    function show(){
        include 'templates/mainMenuTemplate.php';
    }
}