<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function addsyndic($nom,$prenom,$sexe,$cin,$telephone,$email,$utilisateur,$passwd,$idresidence){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`syndic`  VALUES (NULL, '$nom', '$prenom', '$sexe', '$cin', '$telephone', '$email','$utilisateur','$passwd','$idresidence')");
}




function delsyndic($idsyndic){
	connect();
	mysql_query("DELETE FROM syndic WHERE id_syndic=$idsyndic");
		
	
}
?>