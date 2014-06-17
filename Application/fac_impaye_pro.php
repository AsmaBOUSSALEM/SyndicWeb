<?php

include('./config/config.php');
protect();
protectsyndic();

?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);
         
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





<script type="text/javascript" src="jscal/onChangePro.js"></script>
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
    <td width="72" id="user"><span id="user">Supprimer</span></td>
  </tr>
  
<?php  
  $recherche = ("SELECT * FROM facture WHERE id_facture NOT IN(select id_facture from payementPro)  and active=1 ORDER BY datefacture;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result)){
$montant=$row['montant'];
$id=$row['id_facture'];
$numResident=$row['id_proprietaire'];
$numApart=$row['id_apartement'];
	
//Récuperai le nom et prenom
$rech=("SELECT * FROM proprietaire WHERE id_proprietaire='$numResident' ; ");
$res = mysql_query($rech);
$row1 = mysql_fetch_array($res);
$nomPrenom=$row1['nom']." ".$row1['prenom'];


//Récuperai le nom d'apartement
$rech2=("SELECT * FROM apartement WHERE id_apartement='$numApart'; ");
$res2 = mysql_query($rech2);
$row2 = mysql_fetch_array($res2);
$nomApart=$row2['nom'];
$numImm=$row2['id_immeuble'];

//Recuperai le nom d'immeuble

$rech3=("SELECT * FROM immeuble WHERE id_immeuble='$numImm'; ");
$res3 = mysql_query($rech3);
$row3 = mysql_fetch_array($res3);
$nomImm=$row3['nom'];

$msg='<a href="payementpro.php?id='.$id.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Régler"/></a>';

$mod='<a href="modfpro.php?id='.$id.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Modifier"/></a>';
$del='<a href="delfpro.php?id='.$id.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Supprimer"/></a>';


	
	echo "
	<tr> 
	<td width='110' id='user'>".$nomImm."      </td>
    <td width='115' id='user'>".$nomApart." </td>
    <td width='167' id='user'>".$nomPrenom."          </td>
     <td width='52' id='user'>".$row['mois']."         </td>
    <td width='131' id='user'>".$row['datefacture']."             </td>
    <td width='147' id='user'>".$row['datelimite']."     </td>
    <td width='103' id='user'>".$montant." Dhs</td>
    <td width='92' id='user'>0 Dhs</td>
    <td width='99' id='user'>".$montant." Dhs</td>
    <td width='72' id='user'>".$msg."</td>
	<td width='72' id='user'>".$mod."</td>
	<td width='72' id='user'>".$del."</td>
   </tr>";
}

$recherche5 = ("SELECT * FROM facture where active=1 ;" ) ;
$result5 = mysql_query($recherche5);
while($row5 = mysql_fetch_array($result5)){
	$idfact=$row5['id_facture'];
	$montant=$row5['montant'];
$recherche = ("SELECT *,ROUND(SUM(montantPayer),1) as sum FROM payementPro 
where active=1
GROUP BY id_facture
HAVING id_facture=".$row5['id_facture']."
AND ROUND(SUM(montantPayer),1)<>'$montant'
;") ; 

$result = mysql_query($recherche);
$row6=mysql_fetch_array($result);
if($row6){
	$montant=$row5['montant'];
    $id=$row5['id_facture'];
    $numResident=$row5['id_proprietaire'];
    $numApart=$row5['id_apartement'];
	
	
	//Récuperai le nom et prenom
$rech=("SELECT * FROM proprietaire WHERE id_proprietaire='$numResident'; ");
$res = mysql_query($rech);
$row1 = mysql_fetch_array($res);
$nomPrenom=$row1['nom']." ".$row1['prenom'];


//Récuperai le nom d'apartement
$rech2=("SELECT * FROM apartement WHERE id_apartement='$numApart'; ");
$res2 = mysql_query($rech2);
$row2 = mysql_fetch_array($res2);
$nomApart=$row2['nom'];
$numImm=$row2['id_immeuble'];

//Recuperai le nom d'immeuble

$rech3=("SELECT * FROM immeuble WHERE id_immeuble='$numImm'; ");
$res3 = mysql_query($rech3);
$row3 = mysql_fetch_array($res3);
$nomImm=$row3['nom'];
	
	
	$montant2=$row6['sum'];
	$id2=$row5['id_facture'];
	$reste=$montant-$montant2;
	$msg='<a href="payementpro.php?id='.$id2.'&res='.$numResident.'&mon='.$reste.'"><input type="submit" value="Régler"/></a>';
	$mod='<a href="modfpro.php?id='.$id2.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Modifier"/></a>';
$del='<a href="delfpro.php?id='.$id2.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Supprimer"/></a>';
echo "
	<tr> 
	<td width='110' id='user'>".$nomImm."      </td>
    <td width='115' id='user'>".$nomApart." </td>
    <td width='167' id='user'>".$nomPrenom."          </td>
     <td width='52' id='user'>".$row5['mois']."         </td>
    <td width='131' id='user'>".$row5['datefacture']."             </td>
    <td width='147' id='user'>".$row5['datelimite']."     </td>
    <td width='103' id='user'>".$montant." Dhs</td>
    <td width='92' id='user'>".$montant2." Dhs</td>
    <td width='99' id='user'>".$reste." Dhs</td>
    <td width='72' id='user'>".$msg."</td>
	<td width='72' id='user'>".$mod."</td>
	<td width='72' id='user'>".$del."</td>
   </tr>";
}
}

?>
  </table>

      </div>
                </div>
                </div>
                
                
                <?php piednoir(); ?>
  

</body>
</html>
