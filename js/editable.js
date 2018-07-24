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