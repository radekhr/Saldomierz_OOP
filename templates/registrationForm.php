<?php if(!$this) die();?>
<div id="regFormWrapper" class="forms"> 
    <form name="regForm" action = "index.php?action=registerUser" method = "post">
       <?php foreach($formData as $input): ?>
           <div class="input-group">
                <label><?=$input->description?>:</label>
                 <?=$input->getInputHTML()?><br/><br/>         
           </div>
       <?php endforeach;?>
        <br/><div class="col-lg-12 text-center"> 
            <input type="submit" value="Zarejestruj się" class="btn btn-primary btn-lg">
        </div>
    </form>
    <div class="col-sm-12 text-center">
        <button class="btn btn-default"><span class="glyphicon glyphicon-menu-left"></span><a href="index.php?action=wc">Powrót</a></button>
      </div>
</div>

