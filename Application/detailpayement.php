<?php

include('./config/config.php');
protect();


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
    
  </tr>
  </table>
<?php

	echo "<table width='1150' border='3' class='divider' id='user' >";
	
	if(isset($_SESSION['idpseudo']) and $_SESSION['idpseudo']!=""){
	
		connect();
		
		//Recuperer 
		$res = mysql_query("SELECT * FROM proprietaire 
			WHERE active=1 and id_proprietaire=".$_SESSION['idpseudo']." ORDER BY id_proprietaire");
			
		$row = mysql_fetch_assoc($res);
		
		$nomPrenom=$row['nom']." ".$row['prenom'];
		$numResident=$row['id_proprietaire'];
		$numApart=$row['id_apartement'];
		
		$res1 = mysql_query("SELECT * FROM apartement
			WHERE id_apartement='$numApart' ORDER BY id_apartement");
			$row1 = mysql_fetch_array($res1);
		
		$nomApart=$row1['nom'];
		$numImm=$row1['id_immeuble'];
		


$res2 = mysql_query("SELECT * FROM immeuble
			WHERE id_immeuble='$numImm' ORDER BY id_immeuble");
			$row2 = mysql_fetch_array($res2);
			$nomImm=$row2['nom'];
$recherche2 = ("SELECT * FROM montant_s WHERE id_apartement='$numApart' and id_proprietaire='$numResident';" ) ;

//$result2 = mysql_query($recherche2);
//$row4 = mysql_fetch_array($result2);
//$montant=$row4['montant'];
			
$recherche = ("SELECT id_facture FROM facture WHERE active=1 and id_facture NOT IN(select id_facture from payementPro where active=1) AND id_apartement='$numApart' and id_proprietaire='$numResident' ORDER BY datefacture;" ) ;
$result = mysql_query($recherche);


while($row2 = mysql_fetch_array($result)){
	$idfacture=$row2['id_facture'];
	$recherche1 = ("SELECT * FROM facture WHERE id_facture='$idfacture' and id_proprietaire='$numResident';" ) ;
$result1 = mysql_query($recherche1);
$row3 = mysql_fetch_array($result1);
$montant=$row3['montant'];
$id=$row3['id_facture'];

	
	echo "
	<tr> 
	<td width='110' id='user'>".$nomImm."      </td>
    <td width='115' id='user'>".$nomApart." </td>
    <td width='167' id='user'>".$nomPrenom."          </td>
     <td width='52' id='user'>".$row3['mois']."         </td>
    <td width='131' id='user'>".$row3['datefacture']."             </td>
    <td width='147' id='user'>".$row3['datelimite']."     </td>
    <td width='103' id='user'>".$montant." Dhs</td>
    <td width='92' id='user'>0 Dhs</td>
    <td width='99' id='user'>".$montant." Dhs</td>
    <td width='72' id='user'>Non Régler</td>

   </tr>";
}

$recherche5 = ("SELECT * FROM facture where id_apartement='$numApart' and id_proprietaire='$numResident' and active=1;" ) ;
$result5 = mysql_query($recherche5);
while($row5 = mysql_fetch_array($result5)){
	$montant=$row5['montant'];
$recherche = ("SELECT *,ROUND(SUM(montantPayer),1) as sum FROM payementPro where active=1 GROUP BY id_facture
HAVING id_facture=".$row5['id_facture']."
AND ROUND(SUM(montantPayer),1)<>'$montant'
;") ;
$result = mysql_query($recherche);
$row6=mysql_fetch_array($result);
if($row6){
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
    <td width='72' id='user'>Non Régler</td>

   </tr>";
}
}
}
	echo "</table> <br>";
	
?>
<?php
if(isset($_SESSION['idpseudo']) and $_SESSION['idpseudo']!=""){
echo "<h3 class='meta'> La liste des factures réglées </h3>";
echo "<table width='1150' border='3' class='divider' id='user' >";
$recherche5 = ("SELECT * FROM facture where id_apartement='$numApart' and active=1;" ) ;
$result5 = mysql_query($recherche5);
while($row5 = mysql_fetch_array($result5)){
	
	$montant=$row5['montant'];
	$recherche = ("SELECT *,ROUND(SUM(montantPayer),1) FROM payementPro 
	where active=1
	GROUP BY id_facture
HAVING id_facture=".$row5['id_facture']."
AND ROUND(SUM(montantPayer),1)='$montant' 
;") ;
$result = mysql_query($recherche);
$row9=mysql_fetch_array($result);
if($row9){
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

   </tr>";
}
}
echo "</table> <br>";
}
?> 



<?php
if(isset($_SESSION['idpseudo']) and $_SESSION['idpseudo']!=""){
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

  </tr>';
  
  $recherche1=("SELECT * FROM payementpro where id_proprietaire='$numResident' and active=1 ;");
  $resulta1=mysql_query($recherche1);
  while($row1=mysql_fetch_array($resulta1)){
	 

	$idp=$row1['id_payement'];
	$fac=$row1['id_facture'];
	$mon=$row1['montantPayer'];
	$id=$row1['id_payement'];
	

	
	
	  echo '
	  <tr>
    <td width="110" id="user"><span id="user">'.$nomImm.'      </span></td>
    
     <td width="110" id="user"><span id="user">'.$nomApart.'        </span></td>
    <td width="52" id="user"><span id="user">'.$nomPrenom.'           </span></td>
    <td width="131" id="user"><span id="user">'.$row1['datePayement'].'  </span></td>
	<td width="92" id="user"><span id="user">'.$row1['montantPayer'].' Dhs</span></td>
	

  </tr>
  ';
	  
  
  
  }
  
  echo '</table>';




}

?>


<?php
if(isset($_SESSION['idpseudo']) and $_SESSION['idpseudo']!=""){
echo "<h3 class='meta'> Détail payement  </h3>";
echo"<table width='294' border='3' align='center' class='divider' id='user2'>
  <tr>
    <td width='99' id='user'><span id='user2'>Total à Payer    </span></td>
    <td width='99' id='user'><span id='user2'>Total Payer  </span></td>
    <td width='99' id='user'><span id='user2'>Total Restant </span></td>
  </tr>"
  ;
$recherche5 = ("SELECT ROUND(SUM(montant),1) FROM facture 

where id_apartement='$numApart' and id_proprietaire='$numResident' and active=1;" ) ;
$result5 = mysql_query($recherche5);
$row5 = mysql_fetch_array($result5);
$count=$row5[0];
$total=$row5[0];
$recherche5 = ("SELECT ROUND(SUM(montantPayer),1) FROM payementPro where active=1 and id_proprietaire='$numResident'
group by id_apartement
having id_apartement='$numApart';" ) ;
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

?>



	


      </div>
                </div>
                </div>
                
                
                <?php piednoir(); ?>
  

</body>
</html>
