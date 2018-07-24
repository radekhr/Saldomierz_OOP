<?php if(!$this) die();?>
<?php $iduser = $_SESSION['zalogowany']->id; 
      $query1 = "SELECT nazwaKategorii FROM kategorie_przychody_uzytkownika WHERE idUzytkownika='$iduser'";
      $query2 = "SELECT nazwaKategorii FROM kategorie_wydatki_uzytkownika WHERE idUzytkownika='$iduser'";
      if($katPrzychody = $this->dbo->query($query1)){$katPrzychod = mysqli_fetch_assoc($katPrzychody);} 
      if($katWydatki = $this->dbo->query($query2)){$katWydatek = mysqli_fetch_assoc($katWydatki);}?>
    <div class="well"> 
        <label for="okres">Wybierz okres z listy:</label>
            <select class="target" name="wybor" id="wybor">
                <option value="1">Bieżący miesiąc</option>
                <option value="2">Poprzedni miesiąc</option>
                <option value="3">Bieżący rok</option>      
            </select><br/>
        
        <div class="panel panel-default">
            <div class="panel-body">               
                <div class="row">             
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">PRZYCHODY</div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="headertab">
                                            <th width="5%">ID</th>
                                            <th width="25%">Data</th>
                                            <th width="25%">Wynagrodzenie</th>
                                            <th width="10%">Kwota</th>    
                                            <th width="35%">Komentarz</th>      
                                        </tr>
                                    </thead>                                  
                                    <tbody id="tabPrzychody"></tbody>                       
                                </table><br/>
                                     <div class="panel panel-primary">
                                      <div class="panel-heading">
                                        <h5 class="panel-title">Suma <strong>przychodów</strong> dla kategorii:</h5>
                                      </div>
                                      <div class="panel-body">
                                          <div class="form-group row" id="wierszSumaKatPrzychod"></div>
                                          <div id="sumaPrzychod"></div>
                                      </div>
                                    </div>         
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-danger">
                              <div class="panel-heading">WYDATKI</div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="headertab">
                                            <th width="5%">ID</th>
                                            <th width="25%">Data</th>
                                            <th width="25%">Kategoria</th>
                                            <th width="10%">Kwota</th>    
                                            <th width="35%">Komentarz</th>      
                                        </tr>
                                    </thead>
                                     <tbody id="tabWydatki"></tbody>
                                </table><br/>
                           <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h5 class="panel-title">Suma <strong>wydatków</strong> dla kategorii:</h5>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group row" id="wierszSumaKatWydatek"></div>
                                  <div id="sumaWydatek"></div>
                              </div>
                           </div>
                        </div>
                    </div>
                </div>                 
            </div>        
        </div> 
    </div>
    
   <script type="text/javascript" src="js/fetchRows.js"></script>
   <script type="text/javascript" src="js/editable.js"></script>