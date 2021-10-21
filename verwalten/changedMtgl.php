<?php

ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen




$id=$_POST["id"];


if(!empty($_POST["gedruckt"]))
  {
    $pdo->change("tblCheck","gedruckt","checkId",$id,1);
  }
else
  {
    $pdo->change("tblCheck","gedruckt","checkId",$id,0);
  };

$oldQr=$pdo->get("mitCNr","tblCheck","checkId",$id);
$newQr=$_POST["qrCode"];
if ($oldQr<>$newQr)
  {
    $pdo->change("tblCheck","mitCNr","checkId",$id,$newQr);
    $pdo->change("tblCheck","gedruckt","checkId",$id,0);
  };

$vorn=$_POST["vorname"];
$nonceByteVoN=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$nonceVoN=base64_encode($nonceByteVoN); // laenge 32
$vorname=base64_encode(sodium_crypto_secretbox($vorn,$nonceByteVoN,$key));
$checkVoN=$nonceVoN.$vorname;
$pdo->change("tblCheck","checkVoN","checkId",$id,$checkVoN);

$nachn=$_POST["nachname"];
$nonceByteNaN=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$nonceNaN=base64_encode($nonceByteNaN); // laenge 32
$nachname=base64_encode(sodium_crypto_secretbox($nachn,$nonceByteNaN,$key));
$checkNaN=$nonceNaN.$nachname;
$pdo->change("tblCheck","checkNaN","checkId",$id,$checkNaN);



$bezahltBis=$_POST["bezahltBis"];

if (!empty($bezahltBis))
  {
    $datum=date_create($bezahltBis);
    $bezahltBisForm=date_format($datum,"Y-m-d");
    $pdo->change("tblCheck","bezahltBis","checkId",$id,$bezahltBisForm);
  }
elseif(!empty($_POST["bezahlt"]))
  {
    $pdo->change("tblCheck","bezahlt","checkId",$id,1);
    $pdo->change("tblCheck","bezahltBis","checkId",$id,"");

  }
else
  {
    $pdo->change("tblCheck","bezahlt","checkId",$id,0);
    $pdo->change("tblCheck","bezahltBis","checkId",$id,0);
  };




header("Location: ../verwalten/uebersicht.php");
die();
ob_end_flush();
?>
