
<?php

//-----------HEAD-------------------------------------------//
ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="verwalten";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
include("js/uebersicht.js");
include($dir."scr/js/sortElements.js");

ob_end_flush();


//----------BODY----------------------------//

$mtgls=$pdo->getAllActive("tblCheck");


?>
<form method="post" formaction="">
<div class="mt-10 flex">
    <h5 class="text-3xl flex-1 ">Zutrittsverwaltung</h5>
    <div class="mr-8">
      <input id="search" type="text" placeholder="Suche"
        class="w-full border-2 px-2 py-1 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-gray-300 focus:bg-gray-100" />
    </div>
    <div class="mr-8">
      <a  role="button "  href="../verwalten/addMtgl.php"><i title="Mitglied hinzufügen" alt="Mitglied hinzufügen" class="fas fa-user-plus fa-2x" /></i></a>
    </div>
    <div class="mr-8">
      <a  role="button "  href="../verwalten/csvImport.php"><i title="CSV-Import" alt="CSV-Import" class="fas fa-file-csv fa-2x" /></i></a>
    </div>
    <div class="mr-8">
      <button type="submit" class="buttonSubmit d-none"  formaction="../verwalten/deleteChecks.php">
        <a  role="button "  onclick="return  confirm('Sollen die aktivierten Mitglieder wirklich gelöscht werden?')"  href="../verwalten/deleteChecks.php"><i title="Alle loeschen" alt="Alle löschen" class="fas fa-trash-alt fa-2x" /></i></a>
      </button>
    </div>
    <div class="mr-8">
      <button type="submit" class="buttonSubmit d-none"  formaction="../verwalten/print.php">
        <a  role="button "  o  href="../verwalten/print.php"><i title="Drucken" alt="Drucken" class="fas fa-print fa-2x" /></i></a>
      </button>
    </div>
</div>



<table id="mainTable" class="w-full  mt-8 mx-1 table-fixed hover1 mainTable">
  <thead class="darkgrey-background">
    <tr>
      <th  style="hyphens:auto" class=" break-words  text-black text-left  ">
        <input type="checkbox" id='checkAll' class=" form-checkbox h-5 w-5 ml-2"  >
      </th>
      <th  style="hyphens:auto" class="w-3/12 break-words nummer text-black text-left  ">
        <div class="flex  flex-start ">
          <div class="order" >
            <a style="text-align: left;"    class="list-group-item clickable" >Nummer</a>
          </div>
          <div columnName="nummer"   class="my-auto hideColumn">
            <a   class="ml-5 my-auto  " >
              <i class="fas fa-minus-circle"></i>
            </a>
          </div>
        </div>
      </th>
      <th  style="hyphens:auto" class="w-2/12 break-words bezahltBis text-black text-left  ">
        <div class="flex  flex-start ">
          <div class="order" >
            <a style="text-align: left;"    class="list-group-item clickable" >gültig bis</a>
          </div>
          <div columnName="bezahltBis"  class="my-auto hideColumn">
            <a    class="ml-5 my-auto" >
              <i class="fas fa-minus-circle"></i>
            </a>
          </div>
        </div>
      </th>
      <th  style="hyphens:auto" class="w-2/12 break-words bezahlt text-black text-left  ">
        <div class="flex  flex-start ">
          <div class="order" >
            <a style="text-align: left;"    class="list-group-item clickable" >gültig?</a>
          </div>
          <div columnName="bezahlt"  class="my-auto hideColumn">
            <a    class="ml-5 my-auto" >
              <i class="fas fa-minus-circle"></i>
            </a>
          </div>
        </div>
      </th>
      <th  style="hyphens:auto" class="w-2/12 break-words gedruckt text-black text-left  ">
        <div class="flex  flex-start ">
          <div class="order" >
            <a style="text-align: left;"    class="list-group-item clickable" >gedruckt?</a>
          </div>
          <div columnName="gedruckt"  class="my-auto hideColumn">
            <a    class="ml-5 my-auto" >
              <i class="fas fa-minus-circle"></i>
            </a>
          </div>
        </div>
      </th>
      <th  style="hyphens:auto" class="w-2/12 break-words plusColumn text-black text-left  ">
        <div class="flex justify-center my-auto">
          <a class=" my-auto " >
            <i class="fas fa-plus-circle"></i>
          </a>
        </div>
        <div id="showColumn" class="hidden flex justify-center absolute text-black right-0 w-50 mr-6 origin-top-right rounded-md shadow-lg bg-gray-100 md:w-48">
          <ul>

            <li>
              <div columnName="nummer" class="showColumn h-8 nummer hidden">
                Nummer
              </div>
            </li>
            <li>
              <div columnName="bezahltBis" class="showColumn h-8 bezahltBis hidden">
                gültig bis
              </div>
            </li>
            <li>
              <div columnName="bezahlt" class="showColumn h-8 bezahlt hidden">
                gülitg?
              </div>
            </li>
            <li>
              <div columnName="gedruckt" class="showColumn h-8 gedruckt hidden">
               gedruckt?
              </div>
            </li>
          </ul>
        </div>
      </th>
    </tr>
  </thead>
  <!--Ende  Head der  Haupttabelle-->
  <tbody id="myTable">

    <?php
    // Durchführen der in Datenbankabfragen als Methoden von pdo. Die Ergebnisse werden als Objekte übergeben.
    // $articles gibt alle Zeilen von refArtikel wieder.
    // storage gibt alle Zeilen von refArtikelrefLagerbestaende wieder
    $lineCounter=0;
    foreach($mtgls as $mtgl)   // durchlauf durch alle Main-Objekte
     {
       $lineCounter++;


        if ($mtgl->bezahltBis<>"0000-00-00")
          {
            $bezahltBis=date_create($mtgl->bezahltBis);
            if ($bezahltBis>date_create(date("Y-m-d")))
              {
                if ($mtgl->bezahlt==0)
                  {
                    $mtgl->bezahlt=1;
                    $pdo->update("tblCheck","checkId",$mtgl->checkId,"bezahlt",1);
                  }
              }
            else
              {
                if ($mtgl->bezahlt==1)
                  {
                    $mtgl->bezahlt=0;
                    $pdo->update("tblCheck","checkId",$mtgl->checkId,"bezahlt",0);
                  }

                $mtgl->bezahlt=0;
              };
          };

        if ($mtgl->bezahlt==1)
         {
           $bezahlt="ja";
         }
       else
         {
           $bezahlt="nein";
         };
        if ($mtgl->gedruckt==1)
          {
            $gedruckt="ja";
          }
        else
          {
            $gedruckt=0;
          };
         ?>
       <tr name=<?php echo $mtgl->checkId;?> class="h-10 table-secondary filter subTableClick " >
         <td style="hyphens:auto" id='<?php echo $mtgl->checkId;?>' class='<?php echo "order2 click class".$mtgl->checkId." text-left break-words  border-b-2 border-gray-400 hover1  ";?>'>
           <input type="checkbox" id='<?php echo $mtgl->checkId;?>' class="check form-checkbox h-5 w-5 ml-2"  name="check">
         </td>
         <td style="hyphens:auto" id='<?php echo $mtgl->checkId;?>' class='<?php echo "order2 click class".$mtgl->checkId." text-left break-words  border-b-2 border-gray-400 hover1 nummer ";?>'><?php echo $mtgl->mitCNr;?></td>
         <td style="hyphens:auto" id='<?php echo $mtgl->checkId;?>' class='<?php echo "order2 click class".$mtgl->checkId." text-left break-words  border-b-2 border-gray-400 hover1 bezahltBis";?>'><?php echo $mtgl->bezahltBis;?></td>
         <td style="hyphens:auto" id='<?php echo $mtgl->checkId;?>' class='<?php echo "order2 click class".$mtgl->checkId." text-left break-words  border-b-2 border-gray-400 hover1  pl-2 bezahlt";?>'><?php echo $bezahlt;?></td>
         <td style="hyphens:auto" id='<?php echo $mtgl->checkId;?>' class='<?php echo "order2 click class".$mtgl->checkId." text-left break-words  border-b-2 border-gray-400 hover1  pl-4 gedruckt";?>'><?php echo $gedruckt;?></td>
         <td style="hyphens:auto" id='<?php echo $mtgl->checkId;?>' class='<?php echo "order2 click class".$mtgl->checkId." text-left break-words  border-b-2 border-gray-400 hover1 plus";?>'>
           <div>
              <table >
                <tr >

                  <td class="pr-3">
                    <a  role="button "  href='<?php echo "../verwalten/changeMtgl.php?id=".$mtgl->checkId;?>'><i title="Bearbeiten" alt="bearbeiten" class="fas fa-edit fa-2x" /></i></a>
                  </td>

                  <td>
                    <a  role="button" onclick="return  confirm('Soll das Mitglied  wirklich gelöscht werden?')"  href='<?php echo "../verwalten/deleteMtgl.php?id=".$mtgl->checkId;?>'><i title="Entfernen" alt="Entfernen" class="fas fa-trash-alt fa-2x" /></i></a>
                  </td>
                </tr>
              </table>
           </div>
         </td>

      </tr>
     <?php
     };
     ?>
  </tbody>
</table>
  <input id="checks" name="checks" type="text" class="hidden" value=''>
</form>
</main>
</section>
</body>
</html>
<!---Ende der Haupttabelle-->
