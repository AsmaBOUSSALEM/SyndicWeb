<?php

include('./config/config.php');
protect();
protectsyndic();

?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$datedebut = $_POST['datedebut'];
$datefin = $_POST['datefin'];


$datedebut = fran_angl($datedebut);
$datefin = fran_angl($datefin);




 

         
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
<h2 class="title">Liste des factures par periode</h2>
<form action="fac_pro_moi.php" method="post" dir="ltr" lang="fr">
    <table width="995" height="97" border="0" align="center" id="tableau">    <tr>
            
<td width="129" height="45">&nbsp;</td>
                <td width="171" ><strong>Date Début :</strong></td>
                <td width="189" height="45"><input name="datedebut" type="text" id="datedebut" size="15" required="required" />
<img src="jscal/img.gif" id="f_trigger_c" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datedebut", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c" // ID of the button
}
);
</script></td>
            <td width="132"><strong>Date Fin :</strong>
          </td>
<td width="194" height="45"><input name="datefin" type="text" id="datefin" size="15" required="required"/>
<img src="jscal/img.gif" id="f_trigger_c2" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datefin", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c2" // ID of the button
}
);
</script></td>
            <td width="154">
</td>
</tr>
<tr>
<td>
</td>
<td></td>
<td></td>
<td>
  <input name="send" type="submit" value="Consultation"  />
      </td> </tr>   </table>
           </form>
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
    <td width="72" id="user">
    <span id="user">Régler</span></td>
    <td width="72" id="user">
    <span id="user">Modifier</span></td><td width="72" id="user">
    <span id="user">Supprimer</span></td>
  </tr>
  
<?php
if($_POST['send']) {
	
	$erm = array();
	
	if(ctrl_date($datedebut, $datefin))
{$erm[]=ctrl_date($datedebut, $datefin);}

if(empty($erm)){

	
$recherche = ("SELECT * FROM facture WHERE id_facture NOT IN(select id_facture from payementPro) AND datefacture between '$datedebut' and '$datefin'  and active=1 ORDER BY datefacture;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result)){
$montant=$row['montant'];
$id=$row['id_facture'];
$numResident=$row['id_proprietaire'];
$numApart=$row['id_apartement'];
	
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

$msg='<a href="payementpro.php?id='.$id.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Régler"/></a>';
	
	$mod='<a href="modfpro.php?id='.$id.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Modifier"/></a>';
$del='<a href="delfpro.php?id='.$id.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Suprimer"/></a>';

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

$recherche5 = ("SELECT * FROM facture WHERE datefacture between '$datedebut' and '$datefin' and active=1 ORDER BY datefacture;" ) ;
$result5 = mysql_query($recherche5);

while($row5 = mysql_fetch_array($result5)){
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
$del='<a href="delfpro.php?id='.$id2.'&res='.$numResident.'&mon='.$montant.'"><input type="submit" value="Suprimer"/></a>';
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

echo"</table>";	



//facture payer

echo "<h3 class='meta'> La liste des factures réglées </h3>";
echo "<table width='1150' border='3' class='divider' id='user' >";
$recherche5 = ("SELECT * FROM facture where datefacture between '$datedebut' and '$datefin' and active=1;" ) ;
$result5 = mysql_query($recherche5);
while($row5 = mysql_fetch_array($result5)){
	$montant=$row5['montant'];
$id=$row5['id_facture'];
$numResident=$row5['id_proprietaire'];
$numApart=$row5['id_apartement'];
	
	
	$recherche = ("SELECT *,ROUND(SUM(montantPayer),1) FROM payementPro 
	where active=1
	GROUP BY id_facture
HAVING id_facture=".$row5['id_facture']."
AND ROUND(SUM(montantPayer),1)='$montant'
 ;" ) ;
$result = mysql_query($recherche);
$row9=mysql_fetch_array($result);
if($row9){
	
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
	
echo "
	<tr> 
	<td width='110' id='user'>".$nomImm."      </td>
    <td width='115' id='user'>".$nomApart." </td>
    <td width='167' id='user'>".$nomPrenom."          </td>
     <td width='52' id='user'>".$row5['mois']."         </td>
    <td width='131' id='user'>".$row5['datefacture']."             </td>
    <td width='147' id='user'>".$row5['datelimite']."     </td>
    <td width='103' id='user'>".$montant." Dhs</td>
    <td width='92' id='user'>".$montant." Dhs</td>
    <td width='99' id='user'>0 Dhs</td>
    <td width='72' id='user'>Régler</td>
	<td width='72' id='user'><input type='submit' disabled='disabled' value='Modifier'/></td>
	<td width='72' id='user'><input type='submit' disabled='disabled' value='Supprimer'/></td>
   </tr>";
}
}
echo "</table> <br>";



echo "
</br>
<h3 class='meta'> Liste des payement   </h3>";
//liste des payement
echo '
<table width="1150" border="3" class="divider" id="user">
  <tr>
  <td width="110" id="user"><span id="user">Nom Immeuble      </span></td>
    <td width="110" id="user"><span id="user">Nom Apartement      </span></td>
    
     <td width="52" id="user"><span id="user">Proprietaire        </span></td>
    <td width="131" id="user"><span id="user">Date payement            </span></td>
    <td width="92" id="user"><span id="user">Montant payer</span></td>
	 <td width="72" id="user"><span id="user">Modifier</span></td>
	  <td width="72" id="user"><span id="user">Suprimer</span></td>
  </tr>';
  
  $recherche1=("SELECT * FROM payementpro where active=1 ;");
  $resulta1=mysql_query($recherche1);
  while($row1=mysql_fetch_array($resulta1)){


    $montant=$row1['montantpayer'];
    $id=$row1['id_facture'];
    $numResident=$row1['id_proprietaire'];
    $numApart=$row1['id_apartement'];

	$idp=$row1['id_payement'];
	$fac=$row1['id_facture'];
	$mon=$row1['montantPayer'];
	$id=$row1['id_payement'];

//Récuperai le nom et prenom
$rech=("SELECT * FROM proprietaire WHERE id_proprietaire='$numResident'; ");
$res = mysql_query($rech);
$row11 = mysql_fetch_array($res);
$nomPrenom=$row11['nom']." ".$row11['prenom'];


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
	 


	
	$mod='<a href="modppro.php?id='.$id.'&fac='.$fac.'&res='.$numResident.'&mon='.$mon.'&pay='.$idp.'"><input type="submit" value="Modifier"/></a>';
    
	$del='<a href="delppro.php?id='.$idp.'"><input type="submit" value="Suprimer"/></a>';
	
	
	  echo '
	  <tr>
    <td width="110" id="user"><span id="user">'.$nomImm.'      </span></td>
    
     <td width="110" id="user"><span id="user">'.$nomApart.'        </span></td>
    <td width="52" id="user"><span id="user">'.$nomPrenom.'           </span></td>
    <td width="131" id="user"><span id="user">'.$row1['datePayement'].'  </span></td>
	<td width="92" id="user"><span id="user">'.$row1['montantPayer'].' Dhs</span></td>
	
	<td width="72" id="user">'.$mod.'</td>
	<td width="72" id="user">'.$del.'</td>
  </tr>
  ';
	  
  
  }
 
  
  echo '</table>';




//montant
echo "<h3 class='meta'> Détail payement  </h3>";
echo"<table width='294' border='3' align='center' class='divider' id='user2'>
  <tr>
    <td width='99' id='user'><span id='user2'>Total Montant à Payer    </span></td>
    <td width='99' id='user'><span id='user2'>Total Montant Payer  </span></td>
    <td width='99' id='user'><span id='user2'>Total Montant Restant </span></td>
  </tr>"
  ;
$recherche5 = ("SELECT ROUND(SUM(montant),1) FROM facture 

where datefacture between '$datedebut' and '$datefin' and active=1;" ) ;
$result5 = mysql_query($recherche5);
$row5 = mysql_fetch_array($result5);
$count=$row5[0];
$total=$row5[0];
$recherche5 = ("SELECT ROUND(SUM(montantPayer),1) FROM payementPro
where datePayement between '$datedebut' and '$datefin' and active=1 ;" ) ;
$result5 = mysql_query($recherche5);
$row5 = mysql_fetch_array($result5);
$totalpayer=$row5[0];
$totalrestant=$total-$totalpayer;
echo "<tr>
    <td width='99' id='user'><span id='user2'>".$total." Dhs    </span></td>
    <td width='99' id='user'><span id='user2'>".$totalpayer." Dhs  </span></td>
    <td width='99' id='user'><span id='user2'>".$totalrestant." Dhs </span></td>
  </tr>";

echo"</table>";

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
