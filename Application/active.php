<?php
include('./config/config.php');
connect();
$idpseudo=$_GET["id"];

	
	mysql_query("UPDATE pseudo SET active = 1 WHERE id_pseudo = '$idpseudo';");
	echo'<script>alert("L\'utilisateur a ete activer  ")</script>';
	redirect("listeutilisateur.php");	

?>
