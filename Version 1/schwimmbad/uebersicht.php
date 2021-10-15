
<?php

//-----------HEAD-------------------------------------------//
ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="schwimmbad";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
include($dir."scr/fcts/Dropdown.php");
include("js/uebersicht.js");
ob_end_flush();




//----------BODY----------------------------//

$mitglieder=$pdo->getAllActive("tblCheck");
foreach ($mitglieder  as $mitglied)
  {


  }
?>

<div class="mt-10 flex">
    <h5 class="text-3xl flex-1 ">Schwimmbadorganisation</h5>
    <div class="mr-8">
      <?php
      DropDown(array(0,0,0,1));
      ?>
    </div>

</div>
