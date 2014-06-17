<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function addbuil($nom,$nbreApart,$nbreEtage,$idresidence){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`immeuble`  VALUES (NULL, '$nom', '$nbreApart', '$nbreEtage', '$idresidence')");
}

?>