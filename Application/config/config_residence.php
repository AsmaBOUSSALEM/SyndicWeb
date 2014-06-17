<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function addresidence($raisonsocial,$adresse,$ville,$nbreImm,$nbreApart,$telephone,$fax,$email,$datecreation){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`residence`  VALUES (NULL,'$raisonsocial','$adresse','$ville','$nbreImm','$nbreApart','$telephone','$fax','$email','$datecreation')");
}

?>