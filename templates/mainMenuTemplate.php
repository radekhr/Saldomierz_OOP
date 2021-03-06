<?php if(!$this) die();?>
<nav class="navbar navbar-default">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

        <span class="sr-only"></span>
        <!-- Draws 3 bars in navbar button when in small mode -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
      <b class="navbar-text">Witaj, <?=$this->zalogowany->nazwa?>. Twoje ID: <?=$this->zalogowany->id?></b>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?action=showAddIncomeForm">Dodaj przychód <span class="sr-only">(current)</span></a></li>
        <li><a href="index.php?action=showAddExpenseForm">Dodaj wydatek<span class="sr-only">(current)</span></a></li>
        <li><a href="index.php?action=showBalance">Bilans<span class="sr-only">(current)</span></a></li>
        <li><a href="index.php?action=showOptions">Opcje wpisów<span class="sr-only">(current)</span></a></li>
        <li><a href="index.php?action=showUserSettings">Ustawienia<span class="sr-only">(current)</span></a></li>
        <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-log-out"></span><span class="sr-only">(current)</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>