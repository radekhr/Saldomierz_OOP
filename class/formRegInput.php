<?php
class FormRegInput{
    
    public $name;
    public $value;
    public $type;
    public $description;
    public $required;
    
    function __construct($name, $description = '', $type = 'text', $value = '', $required = true){
        
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->description = $description;
        $this->required = $required;
    }
    function getInputHTML(){
        return "<input type='$this->type' name='$this->name' value='$this->value'/>";
    }
}