<?php require("./config/config.php"); ?>

<?php

function addfacture($idapartement,$idproprietaire,$montant,$datefacture,$datelimite,$mois){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`facture`  VALUES (NULL,'$idapartement','$idproprietaire','$montant','$datefacture','$datelimite','$mois',1)");
}




function addligne($mois,$datefacture,$datelimite,$an){
$recherche = ("SELECT * FROM proprietaire  WHERE id_apartement<>'' and active=1;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result))
{
$a=$row['id_apartement'];
$recherche1 = ("SELECT * FROM montant_s  WHERE id_apartement='$a';" ) ;
$result1 = mysql_query($recherche1);
while($row1 = mysql_fetch_array($result1))
{
	$idmontant=$row1['id_montant'];
	$montant=$row1['montant'];
	$idapartement=$row1['id_apartement'];
$recherche2 = ("SELECT id_immeuble,nom FROM apartement  WHERE id_apartement='$idapartement';" ) ;
$result2 = mysql_query($recherche2);
$row2 = mysql_fetch_array($result2);
$aide1=$row2['id_immeuble'];
$nomApart=$row2['nom'];
$idproprietaire=$row1['id_proprietaire'];

$recherche3 = ("SELECT * FROM immeuble  WHERE id_immeuble='$aide1';" ) ;
$result3 = mysql_query($recherche3);
$row3 = mysql_fetch_array($result3);
$nomImm=$row3['nom'];

$recherche4 = ("SELECT * FROM proprietaire  WHERE id_proprietaire='$idproprietaire';" ) ;
$result4 = mysql_query($recherche4);
$row4 = mysql_fetch_array($result4);
$nomRrenom=$row4['nom']." ".$row4['prenom'];

$recherche5 = ("SELECT * FROM facture WHERE id_apartement='$idapartement' and YEAR(datefacture)=$an And mois='$mois';" ) ;
$result5 = mysql_query($recherche5);
$row5 = mysql_fetch_array($result5);
if(!$row5[0]) 

{
echo " <tr>
     <td>".$nomImm." </td>
     <td>".$nomApart."            </td>
     <td>".$nomRrenom."          </td>
     <td>".$mois."            </td>
     <td>".$datefacture."   </td>
	 <td>".$datelimite."   </td>
	 <td> Créer </td>

   </tr>";
   addfacture($idapartement,$idproprietaire,$montant,$datefacture,$datelimite,$mois);
   
}
else {
	echo " <tr>
     <td>".$nomImm." </td>
     <td>".$nomApart."            </td>
     <td>".$nomRrenom."          </td>
     <td>".$mois."            </td>
     <td>".$datefacture."   </td>
	 <td>".$datelimite."   </td>
     <td> Déja Créer </td>
   </tr>";
	
	
	
	}
}
}

}


function addpayement($idfacture,$idresident,$montant_p,$datepayement,$apart){
	 connect();
	mysql_query("INSERT INTO `pfe_syndic`.`payementpro`  VALUES (NULL,  '$idfacture','$montant_p','$datepayement','$apart','$idresident',1)");

	
	}
?>
