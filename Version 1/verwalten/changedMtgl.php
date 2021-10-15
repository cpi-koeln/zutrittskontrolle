<?php

ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
ob_end_flush();



$id=$_POST["id"];

$newQr=$_POST["qrCode"];
$pdo->change("tblCheck","mitCNr","mitCNr",$id,$newQr);


$bezahltBis=$_POST["bezahltBis"];

if (!empty($bezahltBis))
  {
    $datum=date_create($bezahltBis);
    $bezahltBisForm=date_format($datum,"Y-m-d");
    $pdo->change("tblCheck","bezahltBis","checkId",$newQr,$bezahltBisForm);
  }
elseif(!empty($_POST["bezahlt"]))
  {
    $pdo->change("tblCheck","bezahlt","checkId",$newQr,1);
    $pdo->change("tblCheck","bezahltBis","checkId",$newQr,"");

  }
else
  {
    $pdo->change("tblCheck","bezahlt","checkId",$newQr,0);
    $pdo->change("tblCheck","bezahltBis","checkId",$newQr,0);
  };




header("Location: ../verwalten/uebersicht.php");
die();

?>
