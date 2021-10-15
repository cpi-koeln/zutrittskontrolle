<?php

ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen

ob_end_flush();




$nummer=$_POST["qrCode"];
$bezahltBis=$_POST["bezahltBis"];
$vorname=$_POST["vorname"];
$nachname=$_POST["nachname"];
$og=$user->refOgId;
$datum=date_create($bezahltBis);

if (!empty($bezahltBis))
  {
    $bezahltBisForm=date_format($datum,"Y-m-d");
    $pdo->addMtgl($vorname,$nachname,$nummer,$bezahltBisForm,$og);
  }
elseif (!empty($_POST["bezahlt"]))
  {
    $pdo->addMtgl($vorname,$nachname,$nummer,1,$og);
  }
else
  {
    $pdo->addMtgl($vorname,$nachname,$nummer,0,$og);
  }

header("Location: ../verwalten/uebersicht.php");
die();

?>
