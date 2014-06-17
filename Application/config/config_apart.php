<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function addapart($nom,$numEtage,$idtype,$idimmeuble){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`apartement`  VALUES (NULL, '$nom', '$numEtage', '$idtype', '$idimmeuble')");
}

?>