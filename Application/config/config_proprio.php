<?php require("./config/config.php"); ?>
<?php 

//Fonction pour ajouter un syndic
function addproprio($nom,$prenom,$sexe,$profession,$cin,$telephone,$email,$idapartement,$datehabita){
	connect();
	mysql_query("INSERT INTO `pfe_syndic`.`proprietaire`  VALUES (NULL, '$nom', '$prenom', '$sexe','$profession', '$cin', '$telephone', '$email','$idapartement','$datehabita',1,'0000-00-00')")or die("Erreur de connection a la base de donnee");
}

?>