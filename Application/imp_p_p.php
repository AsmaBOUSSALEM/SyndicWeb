<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php 
error_reporting(E_ALL ^ E_NOTICE);



$imp= "hamza bendhiba <br />
test";


   
require('html2pdf/html2pdf.class.php');
try{
	$pdf= new HTML2PDF('P','A4','fr');
	$pdf->pdf->SetDisplayMode('fullpage');
	$pdf->writeHTML($imp);
	$pdf->Output();
}catch (HTML2PDF_exception $e){
die($e);
}
?>
</body>
</html>