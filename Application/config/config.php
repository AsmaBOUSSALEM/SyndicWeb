<?php
require("./config/menu.php");
require("./config/piedpage.php");
require("./config/func_dates.php");



//ouvrire une sesion
session_start();
//Clé d'encryption 
define('key_encrypt',"gerg65er4g65er4g65e4fezugfgiezffezfq"); 
//Fonction pour se connecter
error_reporting(E_ALL ^ E_NOTICE);
function connect(){	
$conn = mysql_connect('localhost','root', '');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
	
	mysql_select_db('pfe_syndic');
	
	return $conn;
}

//Fonction pour la redirection
function redirect($url, $timer=0){
	if($url=="index.php"){$url = dirname($_SERVER["PHP_SELF"]);}
	global $use_header;
		if($use_header){
			header('location: '.$url);	
		}else{
			echo '<meta http-equiv="refresh" content="'.$timer.';URL='.$url.'">';	
		}
	}
function protect(){
	if(($_SESSION['pseudo']=="") and ($_SESSION['utilisateur']==""))
	{
	
	echo"<script>alert(' Vous devez etre connecter ')</script>";
	redirect("con_user.php");
	die();	
	}
}
function protectsyndic(){
	if(($_SESSION['utilisateur']==""))
	{
	
	echo"<script>alert(' Vous avez pas les droit d'accees pour ce page ')</script>";
	redirect("index.php");
	die();	
	
	}
}
?>


<?php  

function appele(){
if(isset($_SESSION['pseudo']) or isset($_SESSION['utilisateur']))
	{
deja();	
	}
	else conn();

}
	function conn(){
	
	connect();
$utilisateur=$_POST['pseudo'];
$passwd=$_POST['passe'];

$passwd=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(key_encrypt), $_POST['passe'], MCRYPT_MODE_CBC, md5(md5(key_encrypt))));






  
if($_POST['send']) {
$erm = array();
$recherche = ("SELECT * FROM syndic WHERE utilisateur='$utilisateur' and active=1;" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	if ($row['password']==$passwd) {
	
	$_SESSION['idsyndic'] = $row[0];
    $_SESSION['utilisateur'] = $row['utilisateur'];
    $_SESSION['nom'] = $row['nom'];
    $_SESSION['prenom'] = $row ['prenom'];
		redirect($_SERVER['PHP_SELF']);
	    die();
	}
	else $erm[]="Votre Mot de passe est Incorrecte";
	
}
else {
error_reporting(E_ALL ^ E_NOTICE);
$recherche = ("SELECT * FROM pseudo WHERE pseudo='$utilisateur';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if($row){
if ($row[2]==$passwd) {
		if( $row[4]==1){
			$_SESSION['idpseudo'] = $row[0];
        $_SESSION['pseudo'] = $row[1];
	    $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row ['prenom'];
		redirect($_SERVER['PHP_SELF']);
		die();
		}
		else $erm[]="Votre compte n'est pas activer ";
}
else $erm[]="Votre Mot de passe est Incorrecte";
}
else $erm[]="Se utilisateur n'existe pas !!!";
}
}
	echo '
<form action="'.$_SERVER['PHP_SELF'].'" method="post">
<table>
<tr>

<td>Pseudo :
</td>
<td>
<input name="pseudo" type="text">
</td>
</tr>

<tr>

<td>
Mot de passe :
</td>
<td>
<input name="passe" type="password">
</td>
</tr>

<tr>

<td>
</td>
<td>
<input name="send" type="submit" value="Se Connecter"  />
</td>
</tr>

</table>
</form>
';

	}

function deja(){

if(($_SESSION['pseudo'])) {
	$espace="Vous êtes connecté en tant que Résident";
$pseudo=$_SESSION['pseudo'];
$nom=$_SESSION['nom'];
$prenom=$_SESSION['prenom'];
}

if(($_SESSION['utilisateur'])){
$espace="vous êtes connecté en tant que Syndic";
$pseudo=$_SESSION['utilisateur'];
$nom=$_SESSION['nom'];
$prenom=$_SESSION['prenom'];	
	
}

echo '
<p>  '.$espace.'  </p>
<table>
<tr>

<td width="116">Pseudo :
</td>
<td width="120">'.$pseudo.'</td>
</tr>

<tr>

<td>
Nom et Prenom
</td>
<td>'.$nom.' '.$prenom.'</td>
</tr>

<tr>

<td>
</td>
<td>
<a href="deconnect.php"><input name="send" type="submit" value="Se deconnecter"  /></a>
</td>
</tr>

</table>
';
}



?>

