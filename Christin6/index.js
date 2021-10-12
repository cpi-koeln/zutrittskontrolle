<script>



function check(data){
  dataNumber=parseInt(data);
  if(dataNumber>0) // wenn code ist eine Zahl
    {
      if($(".ID_"+data).length > 0 ) { // wenn ID vorhanden
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
        add("bezahlt");
        add("nichtBezahlt");
        remove("unbekannt");
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






</script>
