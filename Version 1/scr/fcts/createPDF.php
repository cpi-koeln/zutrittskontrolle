<?php
function createPDF($id)
  {



    $pdf = new FPDF("L","mm",array(85.72,53.98));
    $pdf->AddPage();
    $dir="../";
    $pdf->Image($dir."pic/VSAusweis.png",0,0,85.72,53.98);
    $pdf->Image($dir."pic/balken.png",0,40,85.72);
    $pdf->SetFont("Arial","",8);
    $pdf->SetTextColor(227,6,19);

    $pdf->Text(53,12,substr($id,-13));
    $pdf->SetFont("Arial","",12);
    $pdf->Text(5,8,"Max Mustermann");
    QRcode::png($id, $id.'_QR.png');

    $pdf->Image($id."_QR.png",52.2,14,21.8);
    $pdf->AddPage();
    $pdf->Image($dir."pic/adler.png",40,0,46);
    $pdf->Image($dir."pic/balken.png",0,40,85.72);
    $pdf->SetFont("Arial","B",8);
    $pdf->SetTextColor(0,0,0);
    $pdf->Text(10,10,"Deutsche Lebens-Rettungs-");
    $pdf->Text(10,13.5,"Gesellschaft");
    $pdf->Text(10,17,"Bezirk Remscheid e.V.");
    $pdf->SetFont("Arial","",8);
    $pdf->Text(10,20.5,iconv('UTF-8', 'windows-1252', "Kräwinklerbrücke 10"));
    $pdf->Text(10,24,"42897 Remscheid");
    $pdf->SetFont("Arial","",6);
    $pdf->Text(10,29,"Amtsgericht Wuppertal 20959");
    $pdf->SetFont("Arial","",8);
    $pdf->Text(10,34,"info@remscheid.dlrg.de");
    $pdf->Text(10,37.5,"www.remscheid.dlrg.de");


    $pdf->Output();
  }




 ?>
