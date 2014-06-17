<?php
include('./config/config.php');
connect();
$idpseudo=$_GET["id"];

	
	mysql_query("UPDATE pseudo SET active = 0 WHERE id_pseudo = '$idpseudo';");
	echo'<script>alert("L\'utilisateur a ete desactiver  ")</script>';
	redirect("listeutilisateur.php");	

?>
