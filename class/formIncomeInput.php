<?php
class FormIncomeInput{
    
    public $name;
    public $value;
    public $type;
    public $description;
    public $id;
    
    function __construct($name, $description = '', $type = '', $value = '', $id = ''){
        
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->description = $description;
        $this->id = $id;
    }
    function getIncomeInput(){
        return "<input type='$this->type' name='$this->name' value='$this->value' description='$this->description' id='$this->id'/>";
    }

}