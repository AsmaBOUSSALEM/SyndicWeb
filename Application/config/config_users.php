<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function adduser($pseudo,$passwd,$email,$active,$ip,$nom,$prenom,$sexe,$idapartement){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`pseudo`  VALUES (NULL, '$pseudo', '$passwd', '$email', '$active', '$ip', '$nom', '$prenom','$sexe', CURRENT_TIMESTAMP,$idapartement)");

}



?>