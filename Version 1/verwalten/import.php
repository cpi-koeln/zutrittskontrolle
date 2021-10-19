<?php
//------------------HEAD--------------///

ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet


//750920000700347
//----------------------BODY------------------------------------//
if (empty($_FILES["userfile"]))
  {?>
    <form class="mt-10" enctype="multipart/form-data" action="import.php" method="POST">
        <!-- MAX_FILE_SIZE muss vor dem Datei-Eingabefeld stehen -->
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
        <!-- Der Name des Eingabefelds bestimmt den Namen im $_FILES-Array -->
        Diese Datei hochladen: <input name="userfile" type="file" />
        <br>
        <div class="my-5">Import mit Prüfziffergenerierung? <input type="checkbox" checked class="form-checkbox h-5 w-5 " id="mitPZ" name="mitPZ"></div>
        <br>

        <a href="import.php">
        <button  class="  items-center h-8 px-5 text-indigo-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-indigo-800">
              <span>  Datei hochladen</span>
        </button>
        </a>

    </form>





    <div class="mt-10">
      <h1>Upload mit einer ;-getrennten CSV-Datei (CSV-UTF-8) mit genau folgenden Spaltenüberschriften:<h1>
      <h1>Nachname, Vorname, Mitgliedsnummer, gültig, gültig bis </h1>
    </div>


<?php  }
else
  {
    $csvFile =file($_FILES["userfile"]["tmp_name"]);
    $data = [];
        foreach ($csvFile as $line) {
            $zeile=explode(";",$line);
            $data[] = $zeile;
    };

  $ogNum=$pdo->get("ogNum","tblOrtsgruppen","ogId",$user->refOgId);
  $bezId=$pdo->get("refBezId","tblOrtsgruppen","ogId",$user->refOgId);
  $bezNum=$pdo->get("bezNum","tblBezirke","bezId",$bezId);
  $lvId=$pdo->get("refLvId","tblBezirke","bezId",$bezId);
  $lvNum=$pdo->get("lvNum","tblLandesverband","lvId",$lvId);

  $countZeilen=count($data);
  $countSpalten=count($data[0]);

  for ($i=0;$i<$countSpalten;$i++)
    {

      if(str_contains($data[0][$i],"Vorname"))
        {
          $spalteVoN=$i;
        }
      elseif(str_contains($data[0][$i],"Nachname"))
        {
          $spalteNaN=$i;
        }
      elseif(str_contains($data[0][$i],"Mitgliedsnummer"))
        {
          $spalteMNr=$i;
        }
      elseif(str_contains($data[0][$i],"gültig bis"))
        {
          $spalteGueltigBis=$i;
        }
      elseif(str_contains($data[0][$i],"gültig"))
        {
          $spalteGueltig=$i;
        };

    };

  for($i=1;$i<$countZeilen;$i++)
    {
      $vorn=$data[$i][$spalteVoN];
      $nonceByteVoN=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
      $nonceVoN=base64_encode($nonceByteVoN); // laenge 32
      $vorname=base64_encode(sodium_crypto_secretbox($vorn,$nonceByteVoN,$key));
      $checkVoN=$nonceVoN.$vorname;

      $nachn=$data[$i][$spalteNaN];
      $nonceByteNaN=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
      $nonceNaN=base64_encode($nonceByteNaN); // laenge 32
      $nachname=base64_encode(sodium_crypto_secretbox($nachn,$nonceByteNaN,$key));
      $checkNaN=$nonceNaN.$nachname;

      if(!empty($spalteGueltig))
        {
          $bezahlt=$data[$i][$spalteGueltig];
        }
      else
        {
          $bezahlt="";
        };

      if(!empty($spalteGueltigBis))
        {
          $bezahltBis=$data[$i][$spalteGueltigBis];
        }
      else
        {
          $bezahltBis="0000-00-00";
        };


      $datum=date_create($bezahltBis);

      $mitgliedsnummer=$data[$i][$spalteMNr];
      $mitCNrKurz=$lvNum.$bezNum.$ogNum.$mitgliedsnummer;
      $d=date("d");
      $m=date("m");
      $y=date("Y");

      $zahl=$y.$m.$d.$mitCNrKurz;
      $pz=99-bcmod($zahl,"89");
      if (!empty($_POST["mitPZ"]))
        {
          $nummer=$pz.$mitCNrKurz;
        }
      else
        {
          $nummer=$mitCNrKurz;
        };






      $checkId=$pdo->checkMtglNr($mitCNrKurz,$user->refOgId);
      if (empty($checkId))
        {// Mitglied noch nicht vorhanden.... wird neu eingepflegt
          if (strlen($bezahltBis)>9 and $bezahltBis<>"0000-00-00")
            {// Es gibt ein Gültigkeitsdatum, wird eingebeb.
              $bezahltBis=date_create($bezahltBis);
              $bezahltBisForm=date_format($bezahltBis,"Y-m-d");
              $pdo->addMtgl($checkVoN,$checkNaN,$nummer,$bezahltBisForm,$user->refOgId);

            }
          else
            {
              if(str_contains($bezahlt,"ja"))
                {
                  $pdo->addMtgl($checkVoN,$checkNaN,$nummer,1,$user->refOgId);
                }
              else
                {
                  $pdo->addMtgl($checkVoN,$checkNaN,$nummer,0,$user->refOgId);
                };
              };
          }
        else
          {
            if (strlen($mitgliedsnummer)==7)
              {
                $pdo->change("tblCheck","mitCNr","checkId",$checkId,$nummer);
                $pdo->change("tblCheck","gedruckt","checkId",$checkId,0);
              };

            if (strlen($vorn>2))
              {
                $pdo->change("tblCheck","checkVoN","checkId",$checkId,$checkVoN);
              };

            if (strlen($nachn>2))
              {
                $pdo->change("tblCheck","checkNaN","checkId",$checkId,$checkNaN);
              };

            if (str_contains($bezahlt,"ja"))
              {
                $pdo->change("tblCheck","bezahlt","checkId",$checkId,1);
              }
            elseif (str_contains($bezahlt,"nein"))
              {
                $pdo->change("tblCheck","bezahlt","checkId",$checkId,0);
              };


            if (strlen($bezahltBis)>9)
              {
                $bezahltBis=date_create($bezahltBis);

                $bezahltBisForm=date_format($bezahltBis,"Y-m-d");
                $pdo->change("tblCheck","bezahltBis","checkId",$checkId,$bezahltBisForm);
                if ($bezahltBisForm>date_create(date("Y-m-d")))
                  {
                    $gueltig=1;
                  }
                else
                  {
                    $gueltig=0;
                  };
                $pdo->change("tblCheck","bezahlt",$gueltig,$checkId,$checkNaN);
              };

          };
    };
    header("Location: ../verwalten/uebersicht.php");
    die();
ob_end_flush();
};
?>
