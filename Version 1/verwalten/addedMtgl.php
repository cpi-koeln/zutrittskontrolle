<?php

ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen

ob_end_flush();



$nummer=$_POST["qrCode"];
$bezahltBis=$_POST["bezahltBis"];

$vorn=$_POST["vorname"];
$nonceByteVoN=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$nonceVoN=base64_encode($nonceByteVoN); // laenge 32
$vorname=base64_encode(sodium_crypto_secretbox($vorn,$nonceByteVoN,$key));
$checkVoN=$nonceVoN.$vorname;

$nachn=$_POST["nachname"];
$nonceByteNaN=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$nonceNaN=base64_encode($nonceByteNaN); // laenge 32
$nachname=base64_encode(sodium_crypto_secretbox($nachn,$nonceByteNaN,$key));
$checkNaN=$nonceNaN.$nachname;

$og=$user->refOgId;
$datum=date_create($bezahltBis);


if (!empty($bezahltBis))
  {
    $bezahltBisForm=date_format($datum,"Y-m-d");
    $pdo->addMtgl($checkVoN,$checkNaN,$nummer,$bezahltBisForm,$og);
  }
elseif (!empty($_POST["bezahlt"]))
  {
    $pdo->addMtgl($checkVoN,$checkNaN,$nummer,1,$og);
  }
else
  {
    $pdo->addMtgl($checkVoN,$checkNaN,$nummer,0,$og);
  }

header("Location: ../verwalten/uebersicht.php");
die();

?>
