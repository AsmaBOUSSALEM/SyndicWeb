<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function addmontant($apartement,$proprio,$montant){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`montant_s`  VALUES (NULL, '$proprio', '$apartement', '$montant')");
}

?>