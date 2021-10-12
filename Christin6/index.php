
<?php

//-----------HEAD-------------------------------------------//
ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="";  // zeigt ebene in der Ordnerstruktur an
$folder="index";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include("scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include("index.js");    //zum ein-und Ausblenden wird Javascript/jquery benötigt
include("scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
ob_end_flush();




//----------BODY----------------------------//

$mitglieder=$pdo->getAllActive("tblCheck");
foreach ($mitglieder  as $mitglied)
  {

    ?>
      <div id='<?php echo "ID_".$mitglied[0];?>' class='<?php echo "ID_".$mitglied[1];?>'  check='<?php echo $mitglied[2];?>'></div>

    <?php

  }
?>
<div class="mt-20 mx-auto">
  <h1 class="text-3xl">DLRG Zutrittskontrolle</h1>
  <div id="first" class="first"></div>
  <form>
    <div class="mt-10">
      <button class="qrcode-reader text-2xl w-60 h-16 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-auto" type="button" id="openreader-multi"
        data-qrr-multiple="true"
        data-qrr-repeat-timeout="0"
        data-qrr-line-color="#00FF00"
        data-qrr-target="#multiple">QR-Code scannen
      </button>
    </div>
  </form>
</div>
<br>
<br>



<script src="./dist/js/qrcode-reader.js"></script>  <!-- hier gehts zum QR-Reader-->
<script>

  $(function(){

    // overriding path of JS script and audio
    $.qrCodeReader.jsQRpath = "./dist/js/jsQR/jsQR.js";
    $.qrCodeReader.beepPath = "./dist/audio/beep.mp3";


    // bind all elements of a given class
    $(".qrcode-reader").qrCodeReader();

    // bind elements by ID with specific options // 12.10. auskommentiert
    //$("#openreader-multi2").qrCodeReader({multiple: true, target: "#multiple2", skipDuplicates: false});
    //$("#openreader-multi3").qrCodeReader({multiple: true, target: "#multiple3"});

    // read or follow qrcode depending on the content of the target input
    $("#openreader-single2").qrCodeReader({callback: function(code) {
      if (code) {
        window.location.href = code;
      }
    }}).off("click.qrCodeReader").on("click", function(){
      var qrcode = $("#single2").val().trim();
      if (qrcode) {
        window.location.href = qrcode;
      } else {
        $.qrCodeReader.instance.open.call(this);
      }
    });


  });

</script>
