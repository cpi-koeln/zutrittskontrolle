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



$mitCNr=$pdo->get("mitCNr","tblCheck","checkId",$ids[0]);
createPDF($mitCNr);
//$pdf->Cells(0,10,$mitCNr,0,1);


/*
foreach ($ids as $id)
  {
    $mitCNr=$pdo->get("mitCNr","tblCheck","checkId",$id);
    QRcode::png($mitCNr, $mitCNr.'_QR.png');




    unlink($mitCNr.'_QR.png'); // löscht die QR-Codes wieder
  };


*/




ob_end_flush();
?>
