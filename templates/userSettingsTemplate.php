<?php if(!$this) die();?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#tab1" data-toggle="tab">Zmień imię</a></li>
            <li class=""><a href="#tab2" data-toggle="tab">Zmień hasło</a></li>
            <li class=""><a href="#tab3" data-toggle="tab">Zmień email</a></li>    
        </ul>

        <div class="tab-content"> 
            <div class="tab-pane fade in active" id="tab1"><br/>             
                <form role="form" method="post" action="index.php?action=changeLogin">
                    <div class="input-group">
                     <label>Podaj nowy login:</label>
                      <input type="text" name="nowyLogin">
                    </div><br/> 
                    <div class="col-lg-12 text-center">                          
                        <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tab2"><br/>
                <form role="form" method="post" action="index.php?action=changePass">
                    <div class="input-group">
                        <label>Podaj nowe hasło:</label>
                        <input type="password" name="haslo1">
                    </div><br/>
                    <div class="input-group">
                        <label>Podaj nowe hasło raz jeszcze:</label>
                        <input type="password" class="" name="haslo2">
                    </div><br/>
                    <div class="col-lg-12 text-center">                          
                        <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                    </div>    
                </form>
            </div> 
            <div class="tab-pane fade" id="tab3"><br/>
                <form role="form" method="post" action="index.php?action=changeEmail">
                    <div class="input-group">
                     <label>Podaj nowy adres email:</label>
                      <input type="email" name="mail">
                    </div><br/>
                    <div class="col-lg-12 text-center">                          
                        <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                    </div> 
                </form>
            </div>
        </div>