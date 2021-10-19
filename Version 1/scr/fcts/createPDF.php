<?php
function createPDF($ids,$namen,$rueckseite)
  {
    $count=count($ids);
    $dir="../";

    $pdf = new FPDF("L","mm",array(85.72,53.98));
    for ($i=0;$i<$count;$i++)
      {
        $pdf->AddPage();
        $pdf->Image($dir."pic/VSAusweis.png",0,0,85.72,53.98);
        $pdf->Image($dir."pic/balken.png",0,40,85.72);
        $pdf->SetFont("Arial","",8);
        $pdf->SetTextColor(227,6,19);
        $pdf->Text(53,12,substr($ids[$i],-13));
        $pdf->SetFont("Arial","",12);
        $pdf->Text(5,8,$namen[$i]);
        QRcode::png($ids[$i], $ids[$i].'_QR.png');
        $pdf->Image($ids[$i]."_QR.png",52.2,14,21.8);
      };




    //Rückseite
    $pdf->AddPage();
    $pdf->Image($dir."pic/adler.png",40,0,46);
    $pdf->Image($dir."pic/balken.png",0,40,85.72);
    $pdf->SetFont("Arial","B",8);
    $pdf->SetTextColor(0,0,0);
    $pdf->Text(10,10,"Deutsche Lebens-Rettungs-");
    $pdf->Text(10,13.5,"Gesellschaft");
    $pdf->Text(10,17,$rueckseite[0]);
    $pdf->SetFont("Arial","",8);
    $pdf->Text(10,20.5,iconv('UTF-8', 'windows-1252',$rueckseite[1]));
    $pdf->Text(10,24,$rueckseite[2]);
    $pdf->SetFont("Arial","",6);
    $pdf->Text(10,29,$rueckseite[3]);
    $pdf->SetFont("Arial","",8);
    $pdf->Text(10,34,$rueckseite[4]);
    $pdf->Text(10,37.5,$rueckseite[5]);


    $pdf->Output();
  }




 ?>
