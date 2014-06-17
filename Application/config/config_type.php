<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function addtype($nom,$surface,$balcon,$jardin){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`type_apart`  VALUES (NULL, '$nom', '$surface', '$balcon', '$jardin')");
}

?>