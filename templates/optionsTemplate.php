    <?php if(!$this) die();?>
    <?php $iduser = $_SESSION['zalogowany']->id;
      $query1 = "SELECT nazwaKategorii FROM kategorie_przychody_uzytkownika WHERE idUzytkownika='$iduser'";
      $query2 = "SELECT nazwaKategorii FROM kategorie_wydatki_uzytkownika WHERE idUzytkownika='$iduser'";
      $query3 = "SELECT * FROM przychody WHERE iduzytkownika = '$iduser' ORDER by idprzychod DESC LIMIT 1";
      $query4 = "SELECT * FROM wydatki WHERE iduzytkownika = '$iduser' ORDER by idwydatek DESC LIMIT 1";
      if($katPrzychody = $this->dbo->query($query1)){$katPrzychod = mysqli_fetch_assoc($katPrzychody);} 
      if($katWydatki = $this->dbo->query($query2)){$katWydatek = mysqli_fetch_assoc($katWydatki);}
      if($ostWpisPrzychod = $this->dbo->query($query3)){$ostWpisPrzychod_fetch = mysqli_fetch_assoc($ostWpisPrzychod);}
      if($ostWpisWydatek = $this->dbo->query($query4)){$ostWpisWydatek_fetch = mysqli_fetch_assoc($ostWpisWydatek);}

?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
     <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">PRZYCHODY</div>
                     </div>
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab1" data-toggle="tab">Dodaj kategorię</a></li>
                        <li class=""><a href="#tab2" data-toggle="tab">Edytuj kategorię</a></li>
                        <li class=""><a href="#tab3" data-toggle="tab">Usuń kategorię</a></li>
                        <li class=""><a href="#tab4" data-toggle="tab">Usuń ost. wpis</a></li>
                    </ul>
                    <ul class="tab-content" style="">     
                        <div class="tab-pane fade in active" id="tab1"><br/>
                           <form role="form" method="post" action="index.php?action=addCatIncome">
                                <div class="input-group">
                                 <label>Dodaj nową kategorię:</label>
                                  <input type="text" name="nowaKat">
                                </div><br/> 
                                <div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab2"><br/>
                            <form role="form" method="post" action="index.php?action=editCatIncome">
                                <div class="input-group">
                                 <label>Wybierz kategorię do edytowania:</label>
                                 <select name="wybierzKat" aria-label="...">
                                   <?php foreach($katPrzychody as $katPrzychod): ?>
                                       <?php echo'<option value="'.$katPrzychod['nazwaKategorii'].'">'.$katPrzychod['nazwaKategorii'].'</option>' ?>
                                   <?php endforeach;?>
                                </select>
                               </div><br/> 

                                <div class="input-group">
                                 <label>Zmień nazwę wybranej kategorii na:</label>
                                 <input name="edytKat" aria-label="..."/>
                                </div><br/>  
                                <div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab3"><br/>
                            <form role="form" method="post" action="index.php?action=delCatIncome">
                                <div class="input-group">
                                 <label>Usuń kategorię z listy:</label>
                                 <select name="usunKat" aria-label="...">
                                   <?php foreach($katPrzychody as $katPrzychod): ?>
                                       <?php echo'<option value="'.$katPrzychod['nazwaKategorii'].'">'.$katPrzychod['nazwaKategorii'].'</option>' ?>
                                   <?php endforeach;?>
                                 </select>
                                </div><br/>
                                <div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab4"><br/>
                        <label>Twój ostatni wpis przychodu zostanie usunięty po naciśnięciu przycisku "Zatwierdź"</label>
                           <form role="form" method="post" action="index.php?action=delLastCatIncome">
                               <?php foreach($ostWpisPrzychod as $ostWpisPrzychod_fetch): ?>
                                <div class="input-group" style="margin-left:0px; margin-top:10px;">
                                <label>Data wpisu: </label><input value="<?= $ostWpisPrzychod_fetch['data']?>"disabled>
                                <br/><br/><label>Kwota: </label><input value="<?=$ostWpisPrzychod_fetch['kwota']?>"disabled>
                                <br/><br/><label>Wynagrodzenie: </label><input value="<?=$ostWpisPrzychod_fetch['wynagrodzenie']?>"disabled>
                                <br/><br/><label>Komentarz: </label><input value="<?=$ostWpisPrzychod_fetch['komentarz']?>"disabled>        
                               </div>
                               <?php endforeach;?>
                                
                                <br/><div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                   </ul>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">WYDATKI</div>
                     </div>
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab5" data-toggle="tab">Dodaj kategorię</a></li>
                        <li class=""><a href="#tab6" data-toggle="tab">Edytuj kategorię</a></li>
                        <li class=""><a href="#tab7" data-toggle="tab">Usuń kategorię</a></li>
                        <li class=""><a href="#tab8" data-toggle="tab">Usuń ost. wpis</a></li>
                    </ul>
                    <ul class="tab-content" style="">     
                        <div class="tab-pane fade in active" id="tab5"><br/>
                           <form role="form" method="post" action="index.php?action=addCatExpense">
                                <div class="input-group">
                                 <label>Dodaj nową kategorię:</label>
                                  <input type="text" name="nowaKat">
                                </div><br/> 
                                <div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab6"><br/>
                            <form role="form" method="post" action="index.php?action=editCatExpense">
                                <div class="input-group">
                                 <label>Wybierz kategorię do edytowania:</label>
                                 <select name="wybierzKat" aria-label="...">
                                   <?php foreach($katWydatki as $katWydatek): ?>
                                       <?php echo'<option value="'.$katWydatek['nazwaKategorii'].'">'.$katWydatek['nazwaKategorii'].'</option>' ?>
                                   <?php endforeach;?>
                                 </select>
                                </div><br/>
                                <div class="input-group">
                                 <label>Zmień nazwę wybranej kategorii na:</label>
                                 <input name="edytKat" aria-label="..."/>
                                </div><br/>  
                                <div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab7"><br/>
                            <form role="form" method="post" action="index.php?action=delCatExpense">
                                <div class="input-group">
                                 <label>Usuń kategorię z listy:</label>
                                 <select name="usunKat" aria-label="...">
                                 <?php foreach($katWydatki as $katWydatek): ?>
                                       <?php echo'<option value="'.$katWydatek['nazwaKategorii'].'">'.$katWydatek['nazwaKategorii'].'</option>' ?>
                                 <?php endforeach;?>
                                 </select>
                                </div><br/>
                                <div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab8"><br/>
                        <label>Twój ostatni wpis wydatku zostanie usunięty po naciśnięciu przycisku "Zatwierdź"</label><br/>
                           <form role="form" method="post" action="index.php?action=delLastCatExpense">
                               <?php foreach($ostWpisWydatek as $ostWpisWydatek_fetch): ?>
                                <div class="input-group" style="margin-left:0px; margin-top:10px;">
                                    <label>Data wpisu: </label><input value="<?= $ostWpisWydatek_fetch['data']?>"disabled>
                                    <br/><br/><label>Kwota: </label><input value="<?=$ostWpisWydatek_fetch['kwota']?>"disabled>
                                     <br/><br/><label>Kategoria: </label><input value="<?=$ostWpisWydatek_fetch['kategoria']?>"disabled>
                                     <br/><br/><label>Komentarz: </label><input  value="<?=$ostWpisWydatek_fetch['komentarz']?>"disabled>        
                               </div>
                               <?php endforeach;?>
                                <br/><div class="col-lg-12 text-center">                          
                                    <input type="submit" value="Zatwierdź" class="btn btn-warning btn-lg">
                                </div>
                            </form>
                        </div>
                   </ul>
                </div>
            </div>
         </div>
      </div>   