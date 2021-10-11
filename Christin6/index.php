<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DLRG-Zutrittskontrolle</title>
    <link rel="stylesheet" href="./dist/css/qrcode-reader.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
<section class="h-screen w-screen bg-gray-200 flex flex-col-reverse sm:flex-row min-h-0 min-w-0 overflow-hidden">
  <aside class="sm:h-full sm:w-16 w-full h-12 bg-gray-800 text-gray-200">
    <ul class="text-center flex flex-row sm:flex-col w-full">
    </ul>
  </aside>
  <main class="sm:h-full flex-1 flex flex-col min-h-0 min-w-0 overflow-auto">
    <nav class="border-b bg-gray-200 px-6 py-12 flex items-center min-w-0 h-14">
      <div><img class="object-contain h-24 w-full" src="./pic/Logo.png"></div>
    </nav>
    <body>
<?php

include ("init.php");
$mitglieder=$pdo->getAllActive("zutrittskontrolle");
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
      data-qrr-target="#multiple">QR-Code scannen</button>
  </div>
</div>
  <br>
  <br>

</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<?php include ("./index.js");
?>

<script src="./dist/js/qrcode-reader.js"></script>  <!-- hier gehts zum QR-Reader-->

<script>

  $(function(){

    // overriding path of JS script and audio
    $.qrCodeReader.jsQRpath = "./dist/js/jsQR/jsQR.js";
    $.qrCodeReader.beepPath = "./dist/audio/beep.mp3";


    // bind all elements of a given class
    $(".qrcode-reader").qrCodeReader();

    // bind elements by ID with specific options
    $("#openreader-multi2").qrCodeReader({multiple: true, target: "#multiple2", skipDuplicates: false});
    $("#openreader-multi3").qrCodeReader({multiple: true, target: "#multiple3"});

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


</body>
</html>
