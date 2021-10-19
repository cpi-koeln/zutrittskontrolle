<?php
//-----------HEAD-----------------------------------///


ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren
include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include("js/qrCodeGen.js");

include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
ob_end_flush();

$ogNum=$pdo->get("ogNum","tblOrtsgruppen","ogId",$user->refOgId);
$bezId=$pdo->get("refBezId","tblOrtsgruppen","ogId",$user->refOgId);
$bezNum=$pdo->get("bezNum","tblBezirke","bezId",$bezId);
$lvId=$pdo->get("refLvId","tblBezirke","bezId",$bezId);
$lvNum=$pdo->get("lvNum","tblLandesverband","lvId",$lvId);


//----------------------BODY------------------------------------//

$id=$_GET["id"]; // würde auch mit cookie über jquery gehen. Mehrwert??
$mtgl=$pdo->fetchMtglById($id);
$datum=date_create($mtgl[0]->bezahltBis);

$mtglNr=substr($mtgl[0]->mitCNr,9,13);

$lengthVoN=strlen($mtgl[0]->checkVoN);
$nonceVoN=substr($mtgl[0]->checkVoN,0,32);
$nonceByteVoN=base64_decode($nonceVoN);
$vorname=substr($mtgl[0]->checkVoN,32,$lengthVoN);
$vorname=sodium_crypto_secretbox_open(base64_decode($vorname),$nonceByteVoN,$key);

$lengthNaN=strlen($mtgl[0]->checkNaN);
$nonceNaN=substr($mtgl[0]->checkNaN,0,32);
$nonceByteNaN=base64_decode($nonceNaN);
$nachname=substr($mtgl[0]->checkNaN,32,$lengthNaN);
$nachname=sodium_crypto_secretbox_open(base64_decode($nachname),$nonceByteNaN,$key);



$bezahltBisForm=date_format($datum,"d.m.Y");

if($mtgl[0]->bezahltBis=="0000-00-00")
  {
    $bezahltBis="";
  }
else
  {
    $datum=date_create($mtgl[0]->bezahltBis);
    $bezahltBis=date_format($datum,"d.m.Y");
  };

if ($mtgl[0]->bezahlt==1)
  {
    $bezahlt="checked";
  }
  else {
    $bezahlt="";
  };
if ($mtgl[0]->gedruckt==1)
  {
    $gedruckt="checked";
  }
  else {
    $gedruckt="";
  };
?>

<form action="changedMtgl.php" method="post" id="form1">
  <input id="ogNum" class="hidden" value="<?php echo $ogNum;?>" >
  <input id="bezNum" class="hidden" value="<?php echo $bezNum;?>" >
  <input id="lvNum" class="hidden" value="<?php echo $lvNum;?>" >
  <table class="sm:w-11/12 md:w-3/5 lg:w-3/5  table mt-10 mx-5 ">
    <tbody>

      <tr class="  ">
        <th class=" text-left pl-5">Vorname</th>
        <th></th>
        <th class=" text-left pl-5">Nachname</th>
      </tr>
      <tr class="h-20 border-8">
        <td class=""><input type="text" id="vorname" value="<?php echo $vorname;?>" name="vorname"  class="  mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td class="invisible">ff</td>
        <td class=""><input type="text" id="nachname" value="<?php echo $nachname;?>"name="nachname"  class=" mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
      </tr>
    </body>
  </table>
  <table class="sm:w-11/12 md:w-3/5 lg:w-3/5  table mt-10 mx-5 ">
    <tbody>

      <tr class="  ">
        <th class=" text-left pl-5">Mitgliedsnr.</th>
        <th class="  text-left pl-5">+</th>
        <th class=" text-left pl-5">Datum</th>
        <th class="  text-left pl-5">=></th>
        <th class="  text-left pl-5">QR-Code</th>
      </tr>
      <tr class="h-20 border-8">
        <td><input type="text" id="mtglNr" readonly value='<?php echo $mtglNr;?>'  name="mtglNr"  class="keyUp mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td></td>
        <td><input type="text" id="datum" placeholder="dd.mm.YYYY" name="datum"  class=" keyUp mb-10  border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td></td>
        <td><input type="text" id="qrCode" value='<?php echo $mtgl[0]->mitCNr;?>' name="qrCode"  class="mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
      </tr>
    </body>
  </table>

  <table class="sm:w4/5 md:w-3/5 lg:w-2/5  table  mx-5 ">
    <tbody>
      <tr class=" ">
        <th class="text-left pl-5 w-1/2 ">gültig bis</th>
        <th class=" text-xs w-1/2 ">oder</th>
        <th class=" text-left  w-1/2 ">gültig?</th>
      </tr>
      <tr class="h-20 border-8">
        <td><input type="text" value= '<?php echo $bezahltBis;?>' id="bezahltBis" placeholder="dd.mm.YYYY" name="bezahltBis"  class="border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td></td>
        <td><input type="checkbox" <?php echo $bezahlt;?> class="form-checkbox h-5 w-5 " id="bezahlt" name="bezahlt"></td>
      </tr>
    </tbody>
  </table>

  <table class="sm:w4/5 md:w-3/5 lg:w-2/5  table  mx-5 ">
    <tbody>
      <tr class=" ">
        <th class=" text-left  w-1/2 ">gedruckt?</th>
      </tr>
      <tr class="h-20 border-8">
        <td><input type="checkbox" <?php echo $gedruckt;?> class="form-checkbox h-5 w-5 " id="gedruckt" name="gedruckt"></td>
      </tr>
    </tbody>
  </table>



<br></br>
  <a href="verwalten/changedMtgl.php">
  <button  class="items-center h-8 px-5 text-indigo-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-indigo-800">
        <span>  Mitgliedsdaten ändern</span>
  </button>
  </a>
  <input name="id" type="text" class="hidden" value='<?php echo $mtgl[0]->checkId;?>'>

  </form>
<br>
<br>
