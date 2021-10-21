<script>



function check(data){
  dataNumber=parseInt(data);
  lengthData=data.length;
  dataShort=data.substring(2,lengthData);

  if(dataNumber>0) // wenn code ist eine Zahl
    {
      if($(".ID_"+data).length > 0 ){ // wenn ID vorhanden
        if($(".ID_"+data).attr("check")==1) //ID vorhanden, bezahlt
          {
            remove("bezahlt");
            add("nichtBezahlt");
            add("unbekannt");
          }
        else{  // ID vorhanden, nicht bezahlt
            add("bezahlt");
            remove("nichtBezahlt");
            add("unbekannt");
          };
        }
      else { // ID nicht vorhanden
        if($(".ID_"+dataShort).length> 0 ) // wenn Nummer ohne Prüfziffer vorhanden ist
          {
            setCookie(data) // Um Änderungen auch ohne Internetverbindung später zu übertragen

            //hier wird die Nummer in der Datenbank noch aktualisiert mit Prüfziffer
            /* Der folgende Code klappt nur wenn beim Checken Internetverbindung besteht, daher rausgenommen und stattdessen Cookies gesetzt
            $.ajax({
              url: "scr/save.php",
              type: "POST",
              data: {
                      nummerNeu:data,
                      nummerAlt:dataShort,
              },
              cache: false,
            });*/
            if($(".ID_"+dataShort).attr("check")==1) //ID vorhanden, bezahlt
              {
                remove("bezahlt");
                add("nichtBezahlt");
                add("unbekannt");
              }
            else{  // ID vorhanden, nicht bezahlt
                add("bezahlt");
                remove("nichtBezahlt");
                add("unbekannt");
              };
          }
        else
          {
            add("bezahlt");
            add("nichtBezahlt");
            remove("unbekannt");
          };

      };
    }
  else { // keine Zahl
    add("bezahlt");
    add("nichtBezahlt");
    remove("unbekannt");
    };
  };



    function remove(ort){
      first=0
      $("."+ort).each(function(){
        if(first==0)
          {
            first=1;
            if($(this).hasClass("hidden"))
              {
                $(this).removeClass("hidden");
              };
          };
        });
    }

    function add(ort,attr){
      first=0
      $("."+ort).each(function(){
        if(first==0)
          {
            first=1;
            if(!$(this).hasClass("hidden"))
              {
                $(this).addClass("hidden");
              };
          };
        });
    }

function setCookie(data){

  min = Math.ceil(100000);
  max = Math.floor(999999);
  random=Math.floor(Math.random() * (max - min +1)) + min;
  document.cookie="cookie_"+random.toString()+"="+data.toString();
}




</script>
