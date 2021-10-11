<script>


function check(data){
  if ($(".ID_"+data).length > 0 ) {

    if($(".ID_"+data).attr("check")==1)
      {

        first=0
        $(".bezahlt").each(function(){
          if(first==0)
            {
              first=1;
              if($(this).hasClass("hidden"))
                {
                  $(this).removeClass("hidden");
                };
            };
        });
        first=0
        $(".nichtBezahlt").each(function(){
          if(first==0)
            {
              first=1;
              if(!$(this).hasClass("hidden"))
                {
                  $(this).addClass("hidden");
                };
            };
        });
        first=0
        $(".unbekannt").each(function(){
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
    else {
      first=0
      $(".bezahlt").each(function(){
        if(first==0)
          {
            first=1;
            if(!$(this).hasClass("hidden"))
              {
                $(this).addClass("hidden");
              };
          };
      });
      first=0
      $(".nichtBezahlt").each(function(){
        if(first==0)
          {
            first=1;
            if($(this).hasClass("hidden"))
              {
                $(this).removeClass("hidden");
              };
          };
      });
      first=0
      $(".unbekannt").each(function(){
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

  }
  else {
    first=0
    $(".bezahlt").each(function(){
      if(first==0)
        {
          first=1;
          if(!$(this).hasClass("hidden"))
            {
              $(this).addClass("hidden");
            };
        };
    });
    first=0
    $(".nichtBezahlt").each(function(){
      if(first==0)
        {
          first=1;
          if(!$(this).hasClass("hidden"))
            {
              $(this).addClass("hidden");
            };
        };
    });
    first=0
    $(".unbekannt").each(function(){
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




}




</script>
