<?php require("./config/config.php"); ?>

<?php

function addsociete($raisonsocial,$adresse,$ville,$nom,$prenom,$telephone,$fax,$email){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`societe`  VALUES (NULL,  '$raisonsocial','$adresse','$ville','$nom','$prenom','$telephone','$fax','$email',1)");
}
 function addfacture($societe,$montant,$datefacture,$datelimite,$mois){
	 
	 connect();
	mysql_query("INSERT INTO `pfe_syndic`.`facture_s`  VALUES (NULL,  '$societe','$montant','$datefacture','$datelimite','$mois',1)");
 }
 
 
 function addpayement($idfacture,$societe,$montant_p,$datepayement){
 
  connect();
	mysql_query("INSERT INTO `pfe_syndic`.`payementsoc`  VALUES (NULL,  '$idfacture','$montant_p','$datepayement','$societe',1)");

 }
 
?>
