<?php
 
include('config/config_facture.php');
protect();
protectsyndic();

?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);


$mois=$_POST['mois'];
$datefacture = $_POST['datefacture'];
$datelimite = $_POST['datelimite'];


$datefacture = fran_angl($datefacture);
$datelimite = fran_angl($datelimite);
$an = substr($datefacture, 0, 4);

$erm = array();


if(ctrl_date($datefacture, $datelimite))
{$erm[]=ctrl_date($datefacture, $datelimite);}

if($mois==-1){
	$erm[]="vous devez choisir un mois";
}

if(empty($erm)){

;
}
else{
	 
echo"<script>alert('Il y a une erreur dans les dates')</script>";
	redirect("autofacture.php");
	die();
	
}
 

         
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>pfe syndic</title>
<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />


        <style type="text/css">
        @import url(jscal/calendar-system.css);#user {
	color: #000000;
}
        </style>
<script type="text/javascript" src="jscal/calendar.js"></script>
<script type="text/javascript" src="jscal/lang/calendar-fr.js"></script>
<script type="text/javascript" src="jscal/calendar-setup.js"></script>

</head>
<body>
<table width="904">
<tr>
<td width="490">
<div id="wrapper">

	<div id="logo" class="container">
	  
      <h1>Syndic-web</h1>
      	</div>
</div>
</td>
<td width="402">        
      <div id="connect" class="connect" >  
      <?php appele(); ?>
</div>
</td>
</tr>
</table>
</div>

		

    <?php  menufinance(); ?>
    <div id="three-column" class="container">
<div class="post">
<h2 class="title">Generation des factures automatiquements</h2>

<table width="951" border="3" align="center" class="divider" id="user">
  <tr>
    <td width="133" id="user">Nom Immeuble     </td>
    <td width="128" id="user">Nom Apartement  </td>
    <td width="178" id="user">Nom et Prenom propritaire          </td>
     <td width="65" id="user">Mois          </td>
    <td width="128" id="user">Date creation facture            </td>
    <td width="148" id="user">Date limite de payement   </td>
    <td width="148" id="user">Statue   </td>
  </tr>
  <?php 
 

connect();
addligne($mois,$datefacture,$datelimite,$an);

?>
</table>
</div>
</div>
</div>
<?php piednoir(); ?>

</body>
</html>
