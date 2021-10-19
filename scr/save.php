<?php
ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
ob_end_flush();

	$nummerNeu=$_POST['nummerNeu'];
	$nummerAlt=$_POST['nummerAlt'];

  $pdo->update("tblCheck","mitCNr",$nummerAlt,"mitCNr",$nummerNeu);
?>
