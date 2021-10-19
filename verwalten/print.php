<?php
ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren
include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include($dir."scr/phpqrcode/qrlib.php");
include($dir."scr/fpdf/fpdf.php");
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
include($dir."scr/fcts/createPDF.php");






$idString=$_POST["checks"];
$ids=explode(",",$idString);






$ogId=$pdo->get("checkOg","tblCheck","checkId",$ids[0]);
$zeile3=$pdo->get("ogZ3","tblOrtsgruppen","ogId",$ogId);
$zeile4=$pdo->get("ogZ4","tblOrtsgruppen","ogId",$ogId);
$zeile5=$pdo->get("ogZ5","tblOrtsgruppen","ogId",$ogId);
$zeile6=$pdo->get("ogZ6","tblOrtsgruppen","ogId",$ogId);
$zeile7=$pdo->get("ogZ7","tblOrtsgruppen","ogId",$ogId);
$zeile8=$pdo->get("ogZ8","tblOrtsgruppen","ogId",$ogId);
$rueckseite=array($zeile3,$zeile4,$zeile5,$zeile6,$zeile7,$zeile8);

$namen=[];
$mitCNrs=[];
foreach ($ids as $id)
  {
    $mitCNrAlt=$pdo->get("mitCNr","tblCheck","checkId",$id);
    $mitCNrKurz=substr($mitCNrAlt,-13);
    $d=date("d");
    $m=date("m");
    $y=date("Y");

    $zahl=$y.$m.$d.$mitCNrKurz;
    $pz=99-bcmod($zahl,"89");
    $mitCNr=$pz.$mitCNrKurz;

    $vorn=$pdo->get("checkVoN","tblCheck","checkId",$id);
    $nachn=$pdo->get("checkNaN","tblCheck","checkId",$id);

    $lengthVoN=strlen($vorn);
    $nonceVoN=substr($vorn,0,32);
    $nonceByteVoN=base64_decode($nonceVoN);
    $vorname=substr($vorn,32,$lengthVoN);
    $vorname=sodium_crypto_secretbox_open(base64_decode($vorname),$nonceByteVoN,$key);

    $lengthNaN=strlen($nachn);
    $nonceNaN=substr($nachn,0,32);
    $nonceByteNaN=base64_decode($nonceNaN);
    $nachname=substr($nachn,32,$lengthNaN);
    $nachname=sodium_crypto_secretbox_open(base64_decode($nachname),$nonceByteNaN,$key);

    $name=$vorname." ".$nachname;

    $namen[]=$name;
    $mitCNrs[]=$mitCNr;
    $pdo->change("tblCheck","gedruckt","checkId",$id,1);
    $pdo->change("tblCheck","mitCNr","checkId",$id,$mitCNr);


  };
  createPDF($mitCNrs,$namen,$rueckseite);
  foreach ($mitCNrs as $mitCNr)
    {
      unlink($mitCNr.'_QR.png'); // löscht die QR-Codes wieder
    };






ob_end_flush();
?>
