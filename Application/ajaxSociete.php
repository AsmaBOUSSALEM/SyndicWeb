
<?php require('./config/config.php'); ?>
<?php


	echo "<table width='1150' border='3' class='divider' id='user' >";
	
	if(isset($_POST["id_societe"])){
		
		connect();
		//Recuperer 
		$res = mysql_query("SELECT * FROM societe 
			WHERE id_societe=".$_POST["id_societe"]." ORDER BY id_societe");
			
		$row = mysql_fetch_assoc($res);
		
		$raisonsocial=$row['raisonsocial'];
		$idsociete=$row['id_societe'];
		
		
			
$recherche = ("SELECT id_facture FROM facture_s WHERE id_facture NOT IN(select id_facture from payementSoc where active=1) AND id_societe='$idsociete' ORDER BY datefacture and active=1;" ) ;

$result = mysql_query($recherche);


while($row2 = mysql_fetch_array($result)){
	$idfacture=$row2['id_facture'];
	$recherche1 = ("SELECT * FROM facture_s WHERE id_societe='$idsociete' and active=1;" ) ;
$result1 = mysql_query($recherche1);
$row3 = mysql_fetch_array($result1);
$id=$row3['id_facture'];
$montant=$row3['montant'];
$msg='<a href="payementsoc.php?id='.$id.'&soc='.$idsociete.'&mon='.$montant.'"><input type="submit" value="Régler"/></a>';
	
	$mod='<a href="modfsoc.php?id='.$id.'&soc='.$idsociete.'&mon='.$montant.'"><input type="submit" value="Modifier"/></a>';
    
	$del='<a href="delfsoc.php?id='.$id.'"><input type="submit" value="Supprimer"/></a>';
	
	echo "
	<tr> 
	<td width='110' id='user'>".$raisonsocial."      </td>
    
     <td width='52' id='user'>".$row3['mois']."         </td>
    <td width='131' id='user'>".$row3['datefacture']."             </td>
    <td width='147' id='user'>".$row3['datelimite']."     </td>
    <td width='103' id='user'>".$montant." Dhs</td>
    <td width='92' id='user'>0 Dhs</td>
    <td width='99' id='user'>".$montant." Dhs</td>
    <td width='72' id='user'>".$msg."</td>
	<td width='72' id='user'>".$mod."</td>
	<td width='72' id='user'>".$del."</td>
   </tr>";
}

$recherche5 = ("SELECT * FROM facture_s where id_societe='$idsociete'" ) ;
$result5 = mysql_query($recherche5);
while($row5 = mysql_fetch_array($result5)){
	$montant=$row5['montant'];
$recherche = ("SELECT *,ROUND(SUM(montantPayer),1) as sum FROM payementsoc 
where active=1
GROUP BY id_facture
HAVING id_facture=".$row5['id_facture']."
AND ROUND(SUM(montantPayer),1)<>'$montant'
;") ;
$result = mysql_query($recherche);
$row6=mysql_fetch_array($result);
if($row6){
	$montant2=$row6['sum'];
	$id2=$row5['id_facture'];
	$reste=$montant-$montant2;
	$msg='<a href="payementsoc.php?id='.$id2.'&soc='.$idsociete.'&mon='.$reste.'"><input type="submit" value="Régler"/></a>';
	$mod='<a href="modfsoc.php?id='.$id2.'&soc='.$idsociete.'&mon='.$montant.'"><input type="submit" value="Modifier"/></a>';
    
	$del='<a href="delfsoc.php?id='.$id2.'"><input type="submit" value="Supprimer"/></a>';
	
echo "
	<tr> 
	<td width='110' id='user'>".$raisonsocial."      </td>
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
}
	echo "</table> <br>";
	
?>







<?php

echo "<h3 class='meta'> La liste des factures réglées </h3>";
echo "<table width='1150' border='3' class='divider' id='user' >";
$recherche5 = ("SELECT * FROM facture_s where id_societe='$idsociete' and active=1;" ) ;
$result5 = mysql_query($recherche5);
while($row5 = mysql_fetch_array($result5)){
	$montant=$row5['montant'];
	$recherche = ("SELECT *,ROUND(SUM(montantPayer),1) FROM payementsoc 
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
	<td width='110' id='user'>".$raisonsocial."      </td>
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
?> 




<?php
echo "
</br>
<h3 class='meta'> Liste des payement   </h3>";
//liste des payement
echo '
<table width="1150" border="3" class="divider" id="user">
  <tr>
    <td width="110" id="user"><span id="user">Raison Social      </span></td>
    
     <td width="52" id="user"><span id="user">Mois          </span></td>
    <td width="131" id="user"><span id="user">Date payement            </span></td>
    <td width="92" id="user"><span id="user">Montant payer</span></td>
	 <td width="72" id="user"><span id="user">Modifier</span></td>
	  <td width="72" id="user"><span id="user">Supprimer</span></td>
  </tr>';
  
  $recherche1=("SELECT * FROM payementsoc where id_societe='$idsociete' and active=1 ;");
  $resulta1=mysql_query($recherche1);
  while($row1=mysql_fetch_array($resulta1)){
	 
	$r=("SELECT * FROM societe WHERE id_societe='$idsociete' and active=1 ;");
	$re=mysql_query($r);
	$ro=mysql_fetch_array($re);
	$raisonsocial=$ro['raisonsocial'];
	
	$r=("SELECT * FROM facture_s WHERE id_facture=".$row1['id_facture']." and active=1 ;");
	$re=mysql_query($r);
	$ro=mysql_fetch_array($re);
	$mois=$ro['mois'];
	$fac=$row1['id_facture'];
	$mon=$row1['montantPayer'];
	$id=$row1['id_payement'];
	
	$mod='<a href="modpsoc.php?id='.$id.'&fac='.$fac.'&soc='.$idsociete.'&mon='.$mon.'"><input type="submit" value="Modifier"/></a>';
    
	$del='<a href="delpsoc.php?id='.$id.'"><input type="submit" value="Supprimer"/></a>';
	
	
	  echo '
	  <tr>
    <td width="110" id="user"><span id="user">'.$raisonsocial.'      </span></td>
    
     <td width="52" id="user"><span id="user">'.$mois.'        </span></td>
    <td width="131" id="user"><span id="user">'.$row1[3].'           </span></td>
    <td width="92" id="user"><span id="user">'.$row1[2].' Dhs </span></td>
	<td>'.$mod.'</td>
	<td>'.$del.'</td>
  </tr>
  ';
	  
  
  
  }
  
  echo '</table>';






?>




<?php
echo "<h3 class='meta'> Détail payement  </h3>";
echo"<table width='294' border='3' align='center' class='divider' id='user2'>
  <tr>
    <td width='99' id='user'><span id='user2'>Total à Payer    </span></td>
    <td width='99' id='user'><span id='user2'>Total Payer  </span></td>
    <td width='99' id='user'><span id='user2'>Total Restant </span></td>
  </tr>"
  ;
$recherche5 = ("SELECT ROUND(SUM(montant),1) FROM facture_s 

where id_societe='$idsociete' and active=1 ;" ) ;
$result5 = mysql_query($recherche5);
$row5 = mysql_fetch_array($result5);

$count=$row5[0];
$total=$row5[0];
$recherche5 = ("SELECT ROUND(SUM(montantPayer),1) FROM payementsoc
where active=1
group by id_societe
having id_societe='$idsociete'  ;" ) ;
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

?>