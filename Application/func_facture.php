<?php require(./config/config.php); ?>

<?php
$conn = mysql_connect('localhost','root', '');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
	
	mysql_select_db('syndic');

function addligne($mois,$datefacture,$datelimite,$an){
$recherche = ("SELECT * FROM apartement  WHERE numResident<>'';" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result))
{
	$a=$row['numApart'];
$recherche1 = ("SELECT * FROM montant  WHERE numApart='$a';" ) ;
$result1 = mysql_query($recherche1);
while($row1 = mysql_fetch_array($result1))
{
	$idmontant=$row1['idmontant'];
	$numApart=$row1['numApart'];
$recherche2 = ("SELECT numImm,nomApart,numResident FROM apartement  WHERE numApart='$numApart';" ) ;
$result2 = mysql_query($recherche2);
$row2 = mysql_fetch_array($result2);
$aide1=$row2['numImm'];
$nomApart=$row2['nomApart'];
$aide2=$row2['numResident'];

$recherche3 = ("SELECT * FROM immeuble  WHERE numImm='$aide1';" ) ;
$result3 = mysql_query($recherche3);
$row3 = mysql_fetch_array($result3);
$nomImm=$row3['nomImm'];

$recherche4 = ("SELECT * FROM resident  WHERE numResident='$aide2';" ) ;
$result4 = mysql_query($recherche4);
$row4 = mysql_fetch_array($result4);
$nomRrenom=$row4['nomResident']." ".$row4['prenomResident'];

$recherche5 = ("SELECT * FROM facture WHERE numApart='$numApart' and YEAR(datecreation)=$an And mois='$mois';" ) ;
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
   addfacture($idmontant,$numApart,$datefacture,$datelimite,$mois);
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
?>
