<?php

include('./config/config_users.php');
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$pseudo=$_POST['user'];
$passwd=$_POST['passwd'];
$passwd2=$_POST['passwd2'];
$email=$_POST['email'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$active=0;
$immeuble=$_POST['immeuble'];
$idapartement=$_POST['apartement'];
$ip = $_SERVER['REMOTE_ADDR'];
$sexe=$_POST['sexe'];
$nom=mb_strtoupper($nom);
$prenom=ucfirst(strtolower($prenom));


  
if($_POST['send']) {
	
	
$erm = array();
	
$recherche = ("SELECT * FROM pseudo WHERE pseudo='$pseudo';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	$erm[] = "Le pseudo \"".htmlspecialchars($_POST['user'])."\" est déjà utilisé.";
}
/*
$recherche = ("SELECT * FROM utilisatuer WHERE utilisateur='$pseudo';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	$erm[] = "Le pseudo \"".htmlspecialchars($_POST['user'])."\" est déjà utilisé.";
}
*/

if(strlen($_POST['user'])<4){
		$erm[] = "Le pseudo doit faire au moins 4 caractères";
}

$recherche = ("SELECT * FROM pseudo WHERE email='$email';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	
	$erm[] = "L'e-mail \"".htmlspecialchars($_POST['email'])."\" est déjà utilisé.";
	
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$erm[] = "L'e-mail entré est invalide.";
	}
	
	
	if($_POST['passwd']!=$_POST['passwd2']){
		$erm[] = "Les deux mots de passes ne sont pas identique.";
	}
	
	if(strlen($_POST['passwd'])<6){
		$erm[] = "Le mot de passe doit faire au moins 6 caractères";
	}
	
	if($_POST['passwd']==$_POST['user']){
		$erm[] = "Le mot de passe doit être différent du pseudo";
	}
	
if($sexe!="M" and $sexe!="F"){
	$erm[] = "veuillez choisir un sexe.";
}

if ($idapatement==-1) {
	$erm[] = "Vous devez choisir un apartement.";
}

if(empty($erm)){
		$passwd=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(key_encrypt), $passwd, MCRYPT_MODE_CBC, md5(md5(key_encrypt))));
		adduser($pseudo,$passwd,$email,$active,$ip,$nom,$prenom,$sexe,$idapartement);
		
echo"<script>alert(' Votre Compte a été ajouté avec succès vous pourrez vous connecter  dès validation de votre compte par le syndic')</script>";
		redirect("index.php");
		//die();
		
}

}
            
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>pfe syndic</title>
<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />    
    
<script type="text/javascript" src="jscal/onChange.js"></script>   
<style type="text/css">
.inde {
	font-size: 14px;
}
.inde {
	color: #333333;
}
.inde {
	font-family: Verdana, Geneva, sans-serif;
}
</style>
</head>

<body>
<table width="904">
<tr>
<td width="490">
<div id="wrapper">

	<div id="logo" class="container">
	  
      <h1>Syndic-web</h1>
      	</div>
</div>
</td>
<td width="402">        
      <div id="connect" class="connect" >  
      <?php appele(); ?>
</div>
</td>
</tr>
</table>
</div>

		

    <?php  menu();?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Projet de fin d'etude : application web de gestion de syndic </h2>
				<div class="entry">
	
<p align="center" class="inde">
<br />
</p>
<p align="center" class="inde">Cette application a pour but d'aider le syndic à effectuer son travail, ainsi que de permettre aux proprietaires
  de suivre la situation de leur résidence et le bilan des revenus et des dépenses.<br />
  Nous souhaitons que notre travail soit au niveau, ou du moins proche, de vos expectations.<br />
  Travailler sur ce projet nous a donné l'opportunité de révéler beaucoup d'idées que nous ne savions même pas qu'elles existaient
  et parce que c'était notre premier projet concret nous avons été très confus au sujet de ce que nous devrions faire, mais avec votre soutien, nous avons pu
   surmonter plusieurs obstacles , de croire en nous-mêmes et ne jamais renoncer à nos rêves, car il semble toujours impossible jusqu'à ce
  qu'ils soient réalisés.<br />
  Alors, maintenant que c'est fait, nous tenons à vous remercier du fond du cœur pour nous avoir guider, inspirer et nous rendre
  ce que nous sommes aujourd'hui et ce que nous serons demain parce que les bons enseignants comme vous nous marquerons jusqu'à l'éternité, on ne pourra jamais dire où votre influence s'arrêtera. </p>
		
	

	
    </div>
      </div>
</div>
</div>
<?php piednoir(); ?>  



</body>
</html>
