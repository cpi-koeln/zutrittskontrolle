<script>
$(document).ready(function(){

$(".keyUp").keyup(function(){
  nummer=$("#mtglNr").val();
  datum=$("#datum").val();
  datumSplit=datum.split(".")
  qr=0;
  if (datumSplit.length==3)
    {
      d=parseInt(datumSplit[0]);
      m=parseInt(datumSplit[1]);
      y=parseInt(datumSplit[2]);
      if (y>2000)
      {
        if (m==1 || m==3 || m==5 || m==7 || m==8 || m==10 || m==12)
          {
            if(d>0 && d<=31)
              {
                qr=genQr(nummer,d,m,y);
              };
          }
        else if (m==4 || m==6 || m==9 || m==11)
          {
          if(d>0 && d<=30)
            {
              qr=genQr(nummer,d,m,y);
            };
          }
        else if(m==2)
          {
            if(d>0 && d<=29)
              {

                qr=genQr(nummer,d,m,y);
              };
          };
        };
      };



  $("#qrCode").val(qr);

});



});

function genQr(nummer,d,m,y){

d=d.toString();
m=m.toString();

if (d.length<2)
  {
    d="0"+d;
  };
if (m.length<2)
  {
    m="0"+m;
  };

  const zahl=BigInt(y+m+d+nummer);
  const mod=zahl%89n;

  pruefziffer=99-Number(mod);
  qr=pruefziffer.toString()+nummer;
  return qr;

};



</script>
