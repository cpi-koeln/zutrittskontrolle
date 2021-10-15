<?php
//------------------HEAD-------------------//
$dir="../"; // Festlegen des aktuellen Pfads um die richtige Adressen für die Navbar zu generieren
// Einfügen der später notwendigen Dateien und des Headers
$folder="benutzerVerwalten";
include($dir."scr/header1_2.php");
include($dir."init.php");
include($dir."scr/header2_2.php");
include("scr/fcts/sortObjectArray.php");



//----------------------BODY-----------------------//
$sort=NULL;   // falls keine Sortierreihenfolge gewählt wurde sort=0 ansonsten jeweils Spaltenname nach dem sortiert werden soll
if (!empty($_GET))
  {
    $get=$_GET;
    $sort=$get["sort"];
    $sortOrder=$get["sortOrder"];
  }
else
  {
    $sort="useName";
    $sortOrder="DESC";
  };

if ($sortOrder!=NULL) // falls die Seite über Klicken der Tabellenüberschriften zum Sortieren neugeladen wird--> wird das Main-Objekt neu sortiert.
  {             // Da die Lager- und Reservierungsdaten jeweils unter dem Main-Objekt angeordnet sind, werden diese mitsortiert
    if ($sortOrder=="Asc")
      {
        $sortDef=array($sort=>"ASC");
        $sortOrder="Desc";
      }
    else
      {
        $sortDef=array($sort=>"DESC");
        $sortOrder="Asc";
      };
  };

$users=$pdo->fetchUsers();

if ($sort!=NULL) // falls die Seite über Klicken der Tabellenüberschriften zum Sortieren neugeladen wird--> wird das Main-Objekt neu sortiert.
  {             // Da die Lager- und Reservierungsdaten jeweils unter dem Main-Objekt angeordnet sind, werden diese mitsortiert
    $users=sortObjectArray($users,$sortDef);
  };
?>
  <table  class="w-full my-8  mx-1 table-fixed hover1 mainTable">
      <thead class="darkgrey-background">
        <tr> <!-- im Folgrnden wird den Überschriften ein Link übergeben, der den Get-Befehl für die Sortierreihenfolge (sort) enthält -->
          <th style="hyphens:auto" class="w-auto break-words text-white text-left "><a  href="overviewUser.php?sort=useName&sortOrder=<?php echo $sortOrder; ?>">Benutzername</a></th>
          <th style="hyphens:auto" class="w-2/12 break-words text-white text-left "><a  href="overviewUser.php?sort=useVoN&sortOrder=<?php echo $sortOrder; ?>">Vorname</a></th>
          <th style="hyphens:auto" class="w-2/12 break-words text-white text-left "><a  href="overviewUser.php?sort=useNaN&sortOrder=<?php echo $sortOrder; ?>">Nachname</a></th>
          <th style="hyphens:auto" class="w-1/12 break-words text-white text-left "><a  href="overviewUser.php?sort=useAdmin&sortOrder=<?php echo $sortOrder; ?>">Admin?</a></th>
          <th style="hyphens:auto" class="w-1/12 break-words text-white text-left "><a  href="overviewUser.php?sort=useLager&sortOrder=<?php echo $sortOrder; ?>">Lager?</a></th>
          <th style="hyphens:auto" class="w-1/12 break-words text-white text-left "><a  href="overviewUser.php?sort=useCheck&sortOrder=<?php echo $sortOrder; ?>">Check?</a></th>
          <th style="hyphens:auto" class="w-2/12 break-words text-white text-left "><a ></a></th>
        </tr>
      </thead>
      <tbody id="myTable">
      <?php
      $countUsers=count($users);
      foreach ($users as $user) //Schleife durch refArtikel
       {
         if ($user->useAdmin==1)
          {
            $admin="ja";
          }
        else
          {
            $admin="nein";
          };

        if ($user->useLager==1)
         {
           $lager="ja";
         }
       else
         {
           $lager="nein";
         };

       if ($user->useCheck==1)
        {
          $check="ja";
        }
      else
        {
          $check="nein";
        };
          ?>
         <tr name=<?php echo $user->useId;?> class="h-10 table-secondary filter subTableClick " >
           <td style="hyphens:auto" class='<?php echo "class".$user->useId." text-left break-words  border-b-2 border-gray-400 hover1";?>'><span ><?php echo $user->useName;?></span><!--<span style ="color:red; font-size:70%;"> <?php //echo $addText; ?></span>--></td>
           <td style="hyphens:auto" class='<?php echo "class".$user->useId." text-left break-words  border-b-2 border-gray-400 hover1";?>'><?php echo $user->useVoN;?></td>
           <td style="hyphens:auto" class='<?php echo "class".$user->useId." text-left break-words  border-b-2 border-gray-400 hover1";?>'><?php echo $user->useNaN;?></td>
           <td style="hyphens:auto" class='<?php echo "class".$user->useId." text-left break-words  border-b-2 border-gray-400 hover1";?>'><?php echo $admin;?></td>
           <td style="hyphens:auto" class='<?php echo "class".$user->useId." text-left break-words  border-b-2 border-gray-400 hover1";?>'><?php echo $lager;?></td>
           <td style="hyphens:auto" class='<?php echo "class".$user->useId." text-left break-words  border-b-2 border-gray-400 hover1";?>'><?php echo $check;?></td>
           <td class="border-b-2 border-gray-400 hover1">
             <div>
                <table>
                  <tr>
                     <td>
                       <a  role="button"  href='<?php echo "changeUser.php?useName=".$user->useName;?>'><i title="Bearbeiten" alt="Bearbeiten" class="fas fa-2x fa-edit " /></i></a>
                     </td>
                     <td>
                       <a  role="button" onclick="return  confirm('Soll der Benutzer mit allen Einstellungen wirklich gelöscht werden?')"  href='<?php echo "../user/deleteUser.php?useId=".$user->useId;?>'><i title="Entfernen" alt="Entfernen" class="fas fa-2x fa-trash-alt " /></i></a>
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
