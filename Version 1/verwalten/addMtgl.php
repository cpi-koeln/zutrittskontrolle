<?php
//------------------HEAD--------------///

ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include("js/qrCodeGen.js");
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
ob_end_flush();

//750920000700347
//----------------------BODY------------------------------------//
?>

<form action="addedMtgl.php" method="post" id="form1">
  <table class="sm:w-11/12 md:w-3/5 lg:w-3/5  table mt-10 mx-5 ">
    <tbody>

      <tr class="  ">
        <th class=" text-left pl-5">Vorname</th>
        <th></th>
        <th class=" text-left pl-5">Nachname</th>
      </tr>
      <tr class="h-20 border-8">
        <td class=""><input type="text" id="vorname" name="vorname"  class="  mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td class="invisible">ff</td>
        <td class=""><input type="text" id="nachname" name="nachname"  class=" mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
      </tr>
    </body>
  </table>
  <table class="sm:w-11/12 md:w-3/5 lg:w-3/5  table  mx-5 ">
    <tbody>

      <tr class="  ">
        <th class=" text-left pl-5">Mitgliedsnr.</th>
        <th class="  text-left pl-5">+</th>
        <th class=" text-left pl-5">Datum</th>
        <th class="  text-left pl-5">=></th>
        <th class="  text-left pl-5">QR-Code</th>
      </tr>
      <tr class="h-20 border-8">
        <td><input type="text" id="mtglNr" name="mtglNr"  class="keyUp mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td></td>
        <td><input type="text" id="datum" placeholder="dd.mm.YYYY" name="datum"  class=" keyUp mb-10  border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td></td>
        <td><input type="text" id="qrCode" name="qrCode"  class="mb-10 border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
      </tr>
    </body>
  </table>
  <table class="sm:w4/5 md:w-3/5 lg:w-2/5  table  mx-5 ">
    <tbody>
      <tr class=" ">
        <th class="text-left pl-5 w-1/3 ">gültig bis</th>
        <th class=" text-xs w-1/3 ">oder</th>
        <th class=" text-left  w-1/3 ">gültig?</th>
      </tr>
      <tr class="h-20 border-8">
        <td><input type="text" id="bezahltBis" placeholder="dd.mm.YYYY" name="bezahltBis"  class="border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"></td>
        <td></td>
        <td><input type="checkbox" class="form-checkbox h-5 w-5 " id="bezahlt" name="bezahlt"></td>
      </tr>
    </tbody>
  </table>
<br></br>
  <a href="verwalten/addedMtgl.php">
  <button  class="items-center h-8 px-5 ml-5 text-indigo-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-indigo-800">
        <span> Mitglied hinzufügen</span>
  </button>
  </a>

  </form>
<br>
<br>
