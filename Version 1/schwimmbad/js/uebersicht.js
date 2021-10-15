<script>
$(document).ready(function(){

//Hier werden nach dem Laden der Seite alle Chargen, die nicht zum Lagerort gehören bzw. bereits ausgewählt sind auf hidden gesetzt.



//Aufklappen der divs und hinzufügen weiterer Zeilen
  $('#schwimmbadButton').on('click', function() {
    $("#schwimmbadUl").toggleClass("hidden"); // aufklappen Div
  });



  $('.click').on('click', function() {

// für Lager
    let schwimmbad=$(this).attr("id"); //einzelBestand[1]=laoName für Lager
    let firstEntry="";

    $("#schwimmbadUl").toggleClass("hidden"); // aufklappen Div
    $(this).parent().find("svg.visible").addClass("hidden");
    $(this).parent().find("svg.visible").removeClass("visible");
    $(this).find("svg").removeClass("hidden"); // haken soll sichtbar sein
    $(this).find("svg").addClass("visible"); //marker, dass haken sichtbar ist
    $(this).parent().find("input").val(schwimmbad); //zum weitergeben auf die nächste Seite via $_POST

    $("#schwimmbadButton").find("span.block").html(schwimmbad);
  });
});





</script>
