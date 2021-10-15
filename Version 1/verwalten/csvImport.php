<?php
//------------------HEAD--------------///

ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
ob_end_flush();

//750920000700347
//----------------------BODY------------------------------------//
?>
Noch nicht eingerichtet
