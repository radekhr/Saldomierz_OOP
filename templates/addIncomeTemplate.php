
<div class="page-header"><h3>DODAWANIE PRZYCHODU </h3></div>
          <form role="form" method="post" action="dodajPrzychod.php">

                <div class="input-group input-group-lg">
                  <span class="input-group-addon">Kwota:</span>
                  <input type="text" class="form-control" name="kwota">         
                </div>               

                <div class="input-group input-group-lg">
                  <span class="input-group-addon">Data</span>
                  <input type="date" class="form-control" name="data">
                </div>
                
                <div class="input-group input-group-lg"> 
                <span class="input-group-addon">Wynagrodzenie</span>
                  <select name="opcjaWynagrodzenie" class="form-control" aria-label="...">
                    <?php
                        foreach ($p_rezultaty as $p_rezultat) 
                        {
                            echo '<option value="'.$p_rezultat['nazwaKategorii'].'">'.$p_rezultat['nazwaKategorii'].'</option>';
                        }
                    ?> //php
                  </select>
                </div>
                <div class="input-group input-group-lg">
                  <span class="input-group-addon">Komentarz</span>
                    <textarea class="form-control" rows=3 name="komentarz"></textarea>
                  </div><br/>  
              
            <div class="col-lg-12 text-center"> 
                <input name="submit" type="submit" value="Zatwierdź przychód" class="btn btn-warning btn-lg">
            </div>
        </form>
    </div>