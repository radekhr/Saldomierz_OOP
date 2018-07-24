
    function currMonthIncome(){      
        
        $.ajax({
            url:"fetch/currMonthIncome.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        var dane_html = '<tr><td>'+dane[licznik].idprzychod+'</td>';
                        dane_html += '<td data-name="data" class="data" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="wynagrodzenie" class="wynagrodzenie" data-type="select" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].wynagrodzenie+'</td>'; 
                        dane_html += '<td data-name="kwota" class="kwota" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].kwota+'</td>';                           
                        dane_html += '<td data-name="komentarz" class="komentarz" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].komentarz+'</td></tr>';

                        $('#tabPrzychody').append(dane_html);
                    }
            }
        })
    }
    function currMonthIncome_catSum(){  
        $.ajax({
            url:"fetch/currMonthIncome_catSum.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                var sumaKatPrzychod;
                var sumaPrzychod = 0;
                var sumaPrzychodTekst;
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        sumaKatPrzychod = '<label>'+dane[licznik].wynagrodzenie+'</label><input type="text" style="width:50%;" style ="width:50%;" placeholder="'+dane[licznik].Suma+' zł" disabled/><br/>';
                        sumaPrzychod += parseFloat(dane[licznik].Suma);
                        $('#wierszSumaKatPrzychod').append(sumaKatPrzychod);
                    }
                sumaPrzychodTekst = '<div class="alert alert-info">Suma przychodów: <b>'+sumaPrzychod+' zł</b></div>';
                $('#sumaPrzychod').append(sumaPrzychodTekst);            
            }
        })
    }
    function prevMonthIncome(){      
        
        $.ajax({
            url:"fetch/prevMonthIncome.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        var dane_html = '<tr><td>'+dane[licznik].idprzychod+'</td>';

                        //dane_html += '<td data-name="data" class="data" data-type="combodate" data-format="YYYY-MM-DD" data-viewformat = "DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="data" class="data" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="wynagrodzenie" class="wynagrodzenie" data-type="select" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].wynagrodzenie+'</td>'; 
                        dane_html += '<td data-name="kwota" class="kwota" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].kwota+'</td>';                           
                        dane_html += '<td data-name="komentarz" class="komentarz" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].komentarz+'</td></tr>';

                        $('#tabPrzychody').append(dane_html);
                    }
            }
        })
    }
    function prevMonthIncome_catSum(){  
        $.ajax({
            url:"fetch/prevMonthIncome_catSum.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                var sumaKatPrzychod;
                var sumaPrzychod = 0;
                var sumaPrzychodTekst;
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        sumaKatPrzychod = '<label>'+dane[licznik].wynagrodzenie+'</label> <input type="text" style="width:50%;" placeholder="'+dane[licznik].Suma+' zł" disabled/><br/>';
                        sumaPrzychod += parseFloat(dane[licznik].Suma);
                        $('#wierszSumaKatPrzychod').append(sumaKatPrzychod);
                    }
                sumaPrzychodTekst = '<div class="alert alert-info">Suma przychodów: <b>'+sumaPrzychod+' zł</b></div>';
                $('#sumaPrzychod').append(sumaPrzychodTekst);
               
            }
        })
    }
    function currYearIncome(){      
        
        $.ajax({
            url:"fetch/currYearIncome.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        var dane_html = '<tr><td>'+dane[licznik].idprzychod+'</td>';

                        //dane_html += '<td data-name="data" class="data" data-type="combodate" data-format="YYYY-MM-DD" data-viewformat = "DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="data" class="data" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="wynagrodzenie" class="wynagrodzenie" data-type="select" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].wynagrodzenie+'</td>'; 
                        dane_html += '<td data-name="kwota" class="kwota" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].kwota+'</td>';                           
                        dane_html += '<td data-name="komentarz" class="komentarz" data-type="text" data-pk="'+dane[licznik].idprzychod+'">'+dane[licznik].komentarz+'</td></tr>';

                        $('#tabPrzychody').append(dane_html);
                    }
            }
        })
    }
    function currYearIncome_catSum(){  
        $.ajax({
            url:"fetch/currYearIncome_catSum.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                var sumaKatPrzychod;
                var sumaPrzychod = 0;
                var sumaPrzychodTekst;
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        sumaKatPrzychod = '<label>'+dane[licznik].wynagrodzenie+'</label> <input type="text" style="width:50%;" placeholder="'+dane[licznik].Suma+' zł" disabled/><br/>';
                        sumaPrzychod += parseFloat(dane[licznik].Suma);
                        $('#wierszSumaKatPrzychod').append(sumaKatPrzychod);
                    }
                sumaPrzychodTekst = '<div class="alert alert-info">Suma przychodów: <b>'+sumaPrzychod+' zł</b></div>';
                $('#sumaPrzychod').append(sumaPrzychodTekst);
               
            }
        })
    }
    
    /////////////FETCHOWANIE WYDATKOW////////////////
    function currMonthExpense(){      
        
        $.ajax({
            url:"fetch/currMonthExpense.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        var dane_html = '<tr><td>'+dane[licznik].idwydatek+'</td>';

                        dane_html += '<td data-name="data" class="data" data-type="text" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="kategoria" class="kategoria" data-type="select" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].kategoria+'</td>'; 
                        dane_html += '<td data-name="kwota" class="kwota" data-type="text" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].kwota+'</td>';                           
                        dane_html += '<td data-name="komentarz" class="komentarz" data-type="textarea" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].komentarz+'</td></tr>';

                        $('#tabWydatki').append(dane_html);
                    }
            }
        })
    }
    function currMonthExpense_catSum(){  
        $.ajax({
            url:"fetch/currMonthExpense_catSum.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane){
                var sumaKatWydatek;
                var sumaWydatek = 0;
                var sumaWydatekTekst;
                var daneDoWykresu = "[";
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        sumaKatWydatek = '<label>'+dane[licznik].kategoria+'</label> <input type="text" style="width:50%;" placeholder="'+dane[licznik].Suma+' zł" disabled/><br/>';
                        sumaWydatek += parseFloat(dane[licznik].Suma);
                        $('#wierszSumaKatWydatek').append(sumaKatWydatek);
                        daneDoWykresu += '{x: "'+dane[licznik].kategoria+'", value: '+dane[licznik].Suma+'},';
                    }
                daneDoWykresu += '];';
                //$('#test').append(daneDoWykresu);
                
                sumaWydatekTekst = '<div class="alert alert-info">Suma wydatków: <b>'+sumaWydatek+' zł</b></div>';
                $('#sumaWydatek').append(sumaWydatekTekst);
                
            }
            
        })
    }
    function prevMonthExpense(){      
        
        $.ajax({
            url:"fetch/prevMonthExpense.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        var dane_html = '<tr><td>'+dane[licznik].idwydatek+'</td>';

                        dane_html += '<td data-name="data" class="data" data-type="text" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="kategoria" class="kategoria" data-type="select" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].kategoria+'</td>'; 
                        dane_html += '<td data-name="kwota" class="kwota" data-type="text" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].kwota+'</td>';                           
                        dane_html += '<td data-name="komentarz" class="komentarz" data-type="textarea" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].komentarz+'</td></tr>';

                        $('#tabWydatki').append(dane_html);
                    }
            }
        })
    }
    function prevMonthExpense_catSum(){  
        $.ajax({
            url:"fetch/prevMonthExpense_catSum.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                var sumaKatWydatek;
                var sumaWydatek = 0;
                var sumaWydatekTekst;
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        sumaKatWydatek = '<label>'+dane[licznik].kategoria+'</label> <input type="text" style="width:50%;" placeholder="'+dane[licznik].Suma+' zł" disabled/><br/>';
                        sumaWydatek += parseFloat(dane[licznik].Suma);
                        $('#wierszSumaKatWydatek').append(sumaKatWydatek);
                    }
                sumaWydatekTekst = '<div class="alert alert-info">Suma wydatków: <b>'+sumaWydatek+' zł</b></div>';
                $('#sumaWydatek').append(sumaWydatekTekst);
               
            }
        })
    }
    function currYearExpense(){      
        
        $.ajax({
            url:"fetch/currYearExpense.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        var dane_html = '<tr><td>'+dane[licznik].idwydatek+'</td>';

                        dane_html += '<td data-name="data" class="data" data-type="text" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].data+'</td>';
                        dane_html += '<td data-name="kategoria" class="kategoria" data-type="select" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].kategoria+'</td>'; 
                        dane_html += '<td data-name="kwota" class="kwota" data-type="text" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].kwota+'</td>';                           
                        dane_html += '<td data-name="komentarz" class="komentarz" data-type="textarea" data-pk="'+dane[licznik].idwydatek+'">'+dane[licznik].komentarz+'</td></tr>';

                        $('#tabWydatki').append(dane_html);
                    }
            }
        })
    }
    function currYearExpense_catSum(){  
        $.ajax({
            url:"fetch/currYearExpense_catSum.php",
            method:"POST",
            dataType:"json",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            },
            success:function(dane)
            {
                var sumaKatWydatek;
                var sumaWydatek = 0;
                var sumaWydatekTekst;
                for(var licznik = 0; licznik < dane.length; licznik++)
                    {
                        sumaKatWydatek = '<label>'+dane[licznik].kategoria+'</label> <input type="text" style="width:50%;" placeholder="'+dane[licznik].Suma+' zł" disabled/><br/>';
                        sumaWydatek += parseFloat(dane[licznik].Suma);
                        $('#wierszSumaKatWydatek').append(sumaKatWydatek);
                    }
                sumaWydatekTekst = '<div class="alert alert-info">Suma wydatków: <b>'+sumaWydatek+' zł</b></div>';
                $('#sumaWydatek').append(sumaWydatekTekst);
               
            }
        })
    }
    
    function chosenTarget(){
    var value =$(".target").val();
            $('#tabPrzychody').empty();
            $('#tabWydatki').empty();
            $('#wierszSumaKatPrzychod').empty();
            $('#wierszSumaKatWydatek').empty();
            $('#sumaPrzychod').empty();
            $('#sumaWydatek').empty();
            $("#daty").hide();
            
    if(value === '1'){
            currMonthIncome();
            currMonthExpense(); 
            currMonthIncome_catSum();
            currMonthExpense_catSum();   
        }
    else if(value === '2'){
            prevMonthIncome();
            prevMonthExpense();  
            prevMonthIncome_catSum();
            prevMonthExpense_catSum();             
        }
    else if(value === '3'){   
            currYearIncome();
            currYearExpense(); 
            currYearIncome_catSum();
            currYearExpense_catSum();
        }}

    //MAIN
    $( ".target" ).change(chosenTarget);
        chosenTarget(); 

     $('#tabPrzychody').editable({
      container: 'jumbotron',
      selector: 'td.data',
      url: "fetch/updIncome.php",
      title: 'Wpisz nową datę w formacie YYYY-MM-DD',
      type: "POST",
      validate: function(value){
       if($.trim(value) == '')
            return 'Pole nie może być puste!';
        }
    });
    $('#tabWydatki').editable({
      container: 'body',
      selector: 'td.data',
      url: "fetch/updExpense.php",
      title: 'Wpisz nową datę w formacie YYYY-MM-DD',
      type: "POST",
      validate: function(value){
       if($.trim(value) == '')
            return 'Pole nie może być puste!';
        }
    }); 
    $('#tabPrzychody').editable({
      container: 'body',
      selector: 'td.kwota',
      url: "fetch/updIncome.php",
      title: 'Wpisz nową kwotę',
      dataType: 'json',
      type: "POST",
      validate: function(value){
           if($.trim(value) == ''){
                return 'Pole nie może być puste!';
           }
            //var regex = /^[0-9]+$/;
           if(!$.isNumeric(value)){
            return 'Tylko liczby!';
           }
      }
    }); 
    $('#tabWydatki').editable({
      container: 'body',
      selector: 'td.kwota',
      url: "fetch/updExpense.php",
      title: 'Wpisz nową kwotę',
      dataType: 'json',
      type: "POST",
      validate: function(value){
           if($.trim(value) == ''){
                return 'Pole nie może być puste!';
           }
            //var regex = /^[0-9]+$/;
           if(!$.isNumeric(value)){
            return 'Tylko liczby!';
           }
      }
    });
    $('#tabPrzychody').editable({
      container: 'body',
      selector: 'td.komentarz',
      url: "fetch/updIncome.php",
      title: 'Wpisz nowy komentarz',
      dataType: 'json',
      type: "POST",
      
    });
    $('#tabWydatki').editable({
      container: 'body',
      selector: 'td.komentarz',
      url: "fetch/updExpense.php",
      title: 'Wpisz nowy komentarz',
      dataType: 'json',
      type: "POST",
      
    });

     $('#tabPrzychody').editable({
          container: 'body',
          selector: 'td.wynagrodzenie',
          url: "fetch/updIncome.php",
          title: 'Wybierz nowe wynagrodzenie',
          dataType: 'json',
          type: "POST",
          source: [{value: "Sprzedaz", text: "Sprzedaż"},{value: "odsetki", text: "Odsetki bankowe"},{value: "Inne", text: "Inne"}]

    });
    $('#tabWydatki').editable({
          container: 'body',
          selector: 'td.kategoria',
          url: "fetch/updExpense.php",
          title: 'Wybierz nowa kategorię',
          dataType: 'json',
          type: "POST",
        source: [{value: "Ksiazki", text: "Ksiazki"},{value: "Jedzenie", text: "Jedzenie"},{value: "Mieszkanie", text: "Mieszkanie"},{value: "Komunikacja", text: "Komunikacja"},{value: "Zdrowie", text: "Zdrowie"},{value: "Ubrania", text: "Ubrania"},]
    });


