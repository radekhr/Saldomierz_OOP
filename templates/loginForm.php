<?php if(!isset($portal)) die(); ?>
<div id="loginFormWrapper" class="forms">         
    <form action="index.php?action=login" role="form" method="post">
        <div class="input-group">
           <label for ='login'>Login:</label>
           <input type='text' placeholder="Podaj login" name='login' aria-describedby="login-field"/>
        </div><br/>
        <div class="input-group">
        <label for ='haslo'>Hasło:</label>
           <input type='password' placeholder="Podaj hasło" name='haslo' aria-describedby="haslo-field"/>
         </div><br/> 
        <div class="col-lg-12 text-center" id="btnLogin"> 
            <input type="submit" value="Zaloguj się" class="btn btn-primary btn-lg">       
        </div>
    </form>  
      <div class="col-sm-12 text-center">
          <button class="btn btn-default"><a href="index.php?action=wc">Powrót<span class="glyphicon glyphicon-menu-right"/></a></button>
      </div>
</div>