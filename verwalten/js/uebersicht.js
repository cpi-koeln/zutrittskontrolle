<script>
$(document).ready(function(){
  $("#checkAll").on("click",function(){
    if ($(this).is(":checked"))
      {
        checks=[];
        $(".check").each(function(){
          $(this).prop("checked",true);
          id=$(this).attr("id");
          checks.push(id);
        });
        checkIdString=checks.join();
        $("#checks").val(checkIdString);
      }
    else
      {
        $(".check").each(function(){
          $(this).prop("checked",false);
        });
        $("#checks").val("");
      };
  });



  $(".check").on("click",function(){

    id=$(this).attr("id");
    checkIdString="";
    checkIdString=$("#checks").val();

    checkIds=[];
    if (checkIdString.length>0)
      {
        checkIds=checkIdString.split(",");
      };



    if ($(this).is(":checked"))
      {
        checkIds.push(id);
      }
    else
      {
        for(i=0;i<checkIds.length;i++)
          {
            if(checkIds[i]===id)
              {
                checkIds.splice(i,1);
              };
          };
      };

    checkIdString=checkIds.join();
    $("#checks").val(checkIdString);

  });


  $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#mainTable tr.table-secondary").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });


let widthMainTable=$(".mainTable").innerWidth();
$(".subTables").each(function(){

  $(this).attr("style","width:"+widthMainTable*0.8+"px");
});

$("#radio1").on("click",function(){
  $(".laoTyp").each(function(){
    $(this).removeClass("hidden");
  });
});

$("#radio2").on("click",function(){
  $(".laoTyp").each(function(){

    if(!$(this).hasClass("laoTypId_3"))
    {
      $(this).addClass("hidden");
    }
  });
});




$('div.order').on('click', function() {

    // add active class
    if ( !$(this).hasClass('active') ) {
        $('div.order').removeClass('active').removeClass('desc').removeClass('asc');
        $(this).addClass('active');
    }

    // Add ASC or DESC
    if ( $(this).hasClass('desc') ) {
        $(this).removeClass('desc').addClass('asc');
    } else {
        $(this).removeClass('asc').addClass('desc');
    }
    // Call sort function
    sort();
});



$('th.order3').on('click', function() {
    // add active class
    if ( !$(this).hasClass('active') ) {
        $('th.order3').removeClass('active').removeClass('desc').removeClass('asc');
        $(this).addClass('active');
    }

    // Add ASC or DESC
    if ( $(this).hasClass('desc') ) {
        $(this).removeClass('desc').addClass('asc');
    } else {
        $(this).removeClass('asc').addClass('desc');
    }
    artId=$(this).attr("artId")
    // Call sort function
    sort3(artId);
});



backgroundActive=0;
$(".click").on("click",function(){

  let artId=$(this).attr("artId");

  $("#overlay_"+artId).css("display","flex");

});


$(".overlay").on("click",function(){
  if(backgroundActive==1)
    {
      backgroundActive=0;
    }
  else
    {
      $(".overlay").css("display","none");
    }
});

$(".overlay2").on("click",function(){ //benöigt, damit man nicht durch das obere div durchklickt
  backgroundActive=1;
});



$(".hideColumn").on("click",function(){

    column=$(this).attr("columnName");
    $("td."+column).addClass("hidden");
    $("th."+column).addClass("hidden");
    $("div."+column).removeClass("hidden");
});

$(".plusColumn").on("click",function(){
  $("#showColumn").removeClass("hidden");
});

$(".showColumn").on("click",function(){

  column=$(this).attr("columnName");

  $("td."+column).removeClass("hidden");
  $("th."+column).removeClass("hidden");
  $("div."+column).addClass("hidden");
  $("#showColumn").addClass("hidden");


});

});





$(document).mouseup(function(e)
{
    var container = $("#showColumn");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length===0 && !container.hasClass("hidden"))
    {
        container.addClass("hidden");
    }

});





function sort() {
  var table = jQuery('#mainTable');
  jQuery('div.order')
      .each(function() {

          if ( jQuery(this).hasClass('desc') ) {
              var th = $(this).closest("th"),
                  thIndex = th.index(),
                  inverse = false;
          } else {
              var th = $(this).closest("th"),
                  thIndex = th.index(),
                  inverse = true;
          }

          th.click(function(){

              table.find('td.order2').filter(function(){
                  return jQuery(this).index() === thIndex;
              }).sortElements(function(a, b){ if(parseInt($.text([a])) && parseInt($.text([b])))
                {
                  return (parseInt($.text([a])) > parseInt($.text([b]))) ?
                      inverse ? -1 : 1
                      : inverse ? 1 : -1;
                }else{
                  return $.text([a]).toLowerCase()  > $.text([b]).toLowerCase()  ?
                      inverse ? -1 : 1
                      : inverse ? 1 : -1;
                };
              }, function(){
                  return this.parentNode;
              });
              inverse = !inverse;

          });

      });
} sort();


function sort3(artId) {
  var table = $('#TableSub_'+artId);

  $('th.order3')
      .each(function() {

          if ( $(this).hasClass('desc') ) {
              var th = $(this),
                  thIndex = th.index(),
                  inverse = false;
          } else {
              var th = $(this),
                  thIndex = th.index(),
                  inverse = true;
          }

          th.click(function(){
              table.find('td.order4').filter(function(){
                return jQuery(this).index() === thIndex;
            }).sortElements(function(a, b){ if(parseInt($.text([a])) && parseInt($.text([b])))
              {alert("jj");
                return (parseInt($.text([a])) > parseInt($.text([b]))) ?
                    inverse ? -1 : 1
                    : inverse ? 1 : -1;
              }else{alert("ll");
                return $.text([a]).toLowerCase() > $.text([b]).toLowerCase() ?
                    inverse ? -1 : 1
                    : inverse ? 1 : -1;
              };
            }, function(){
                return this.parentNode;
            });
            inverse = !inverse;


          });

      });
} sort3();


</script>
