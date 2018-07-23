<?php if(!$this) die();?>
<?php $iduser = $_SESSION['zalogowany']->id;
      $query = "SELECT nazwaKategorii FROM kategorie_wydatki_uzytkownika WHERE idUzytkownika='$iduser'";
      if($results = $this->dbo->query($query)){$result = mysqli_fetch_assoc($results);}?>
<div id="addExpenseFormWrapper" class="forms"> 
     <div class="page-header" style="text-align:  center;border-bottom:  1px solid black;">
         <h3>DODAWANIE WYDATKU</h3></div>
      <form role="form" method="post" action="index.php?action=addExpense">
   <?php foreach($formDataIncome as $input): ?>
       <div class="input-group">             
            <label><?=$input->description?>:</label>
             <?=$input->getExpenseInput()?>        
       </div>
   <?php endforeach;?>
      <div class="input-group"> 
       <label>Kategoria: </label>
           <select name="kategoria">
               <?php foreach($results as $result): ?>
                   <?php echo'<option value="'.$result['nazwaKategorii'].'">'.$result['nazwaKategorii'].'</option>' ?>
               <?php endforeach;?>
           </select>
       </div>
       <div class="input-group"> 
        <label>Sposób płatności: </label>
           <select name="sposobPlat">
                   <option>Karta debetowa</option>
                   <option>Karta kredytowa</option>
                   <option>Gotówka</option>
           </select>
       </div><br/> 

        <div class="col-lg-12 text-center"> 
            <input type="submit" value="Zatwierdź wydatek" class="btn btn-warning btn-lg">
        </div>
    </form>
</div>
<script>
    var today = new Date();
    var dd = ("0" + (today.getDate())).slice(-2);
    var mm = ("0" + (today.getMonth() +　1)).slice(-2);
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd ;
    $("#dataInput").attr("value", today);
</script>
