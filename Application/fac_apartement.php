<?php

include('./config/config.php');
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


if(empty($erm)){

;
}
else{
	/* 
echo"<script>alert('Il y a une erreur dans les dates')</script>";
	redirect("autofacture.php");
	die();
	*/
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





<script type="text/javascript" src="jscal/onChangeAprt.js"></script>
        <style type="text/css">
        @import url(jscal/calendar-system.css);#user {
	color: #000000;
}
        #user {
	text-align: left;
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
<h2 class="title">Liste des factures par Proprietaires</h2>
<table width="995" height="97" border="0" align="center" id="tableau">    <tr>
            
<td width="129" height="45"><strong> Choix Immeuble :</strong></td>
                <td width="200" >
                <select name='immeuble' id='immeuble' onchange='go_1()'>
                  <option value='-1'>-- Choisissez un immeuble --</option>
                  <?php
						connect();
						$res = mysql_query("SELECT * FROM immeuble ORDER BY id_immeuble");
						while($row = mysql_fetch_assoc($res)){
							echo "<option value='".$row["id_immeuble"]."'>".$row["nom"]."</option>";
						}
					?>
                </select>
                </td>
                <td width="160" height="45"><strong>Choix appartement :</strong></td>
            <td width="150">
            <div id='apar12' style='display:inline'>
                <select name='apartement' id='apartement' onchange='go()'>
                  <option value='-1'>-- Choisissez un apartement --</option>
                </select>
</td>


             
				</span>
</td>
</tr>
<tr>
<td>
</td>
<td></td>
<td></td>
<td>&nbsp;</td> 
</tr>   </table>
<h3 class="meta"> Les factures impayees </h3>
<table width="1150" border="3" class="divider" id="user">
  <tr>
    <td width="110" id="user"><span id="user">Nom Immeuble     </span></td>
    <td width="115" id="user"><span id="user">Nom Apartement  </span></td>
    <td width="167" id="user"><span id="user">Nom et Prenom propritaire          </span></td>
     <td width="52" id="user"><span id="user">Mois          </span></td>
    <td width="131" id="user"><span id="user">Date creation facture            </span></td>
    <td width="147" id="user"><span id="user">Date limite de payement   </span></td>
    <td width="103" id="user"><span id="user">Montant à payer</span></td>
    <td width="92" id="user"><span id="user">Montant payer</span></td>
    <td width="99" id="user"><span id="user">Montant Restant</span></td>
    <td width="72" id="user"><span id="user">Régler</span></td>
    <td width="72" id="user"><span id="user">Modifier</span></td>
    <td width="90" id="user"><span id="user">Supprimer</span></td>
  </tr>
  </table>
  <span id='facture'>
             
				</span>
                </div>
                </div>
                </div>
                
                
                <?php piednoir(); ?>
  

</body>
</html>
