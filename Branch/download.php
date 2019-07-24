<?php
include_once("../config.php");
include_once("../lib/mpdf/mpdf.php");
   $mpdf = new mPDF();
       if (isset($_GET['Invoice']))  {
             $html  = InvoiceDownload($_GET['Invoice']);
$mpdf->WriteHTML($html);
$mpdf->Output();
       }
       
        if (isset($_GET['Order']))  {
             $html  = OrderDownload($_GET['Order']);
$mpdf->WriteHTML($html);
$mpdf->Output();
       }
       
         if (isset($_GET['Receipt']))  {
             $html  = ReceiptDownload($_GET['Receipt']);
$mpdf->WriteHTML($html);
$mpdf->Output();
       }
   
   
 
//call watermark content aand image
//$mpdf->SetWatermarkText('phpflow.COM');
//$mpdf->showWatermarkText = true;
//$mpdf->watermarkTextAlpha = 0.1;
 
 
//save the file put which location you need folder/filname
//$mpdf->Output("phpflow.pdf", 'F');
 
 
//out put in browser below output function

?> 