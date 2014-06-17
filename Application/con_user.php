<?php

require('./config/config.php');
?>
    <?php 
	if(isset($_SESSION['pseudo']) or isset($_SESSION['utilisateur']))
	{
	redirect("connecte.php");
	die();	
	}
else{
connect();
error_reporting(E_ALL ^ E_NOTICE);



$utilisateur=$_POST['utilisateur'];
$passwd=$_POST['passwd'];

$passwd=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(key_encrypt), $_POST['passwd'], MCRYPT_MODE_CBC, md5(md5(key_encrypt))));






  
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
		redirect("connecte.php");
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
		redirect("connecte.php");
		die();
		}
		else $erm[]="Votre compte n'est pas activer ";
}
else $erm[]="Votre Mot de passe est Incorrecte";
}
else $erm[]="Se utilisateur n'existe pas !!!";
}
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

       
</head>
<body>


<div id="wrapper">
	<div id="logo" class="container">
	  <h1>Syndic-web</h1>
		
	</div>
    
<?php menuconnect(); ?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Espace Membre </h2>
				<div class="entry">
	
<form action="con_user.php" method="post" dir="ltr" lang="fr">
            <table width="777" height="97" border="0" align="center" id="tableau">    <tr>
            <td></td>
            <td>
 <?php
 if(!empty($erm) ){
	?>
	<div class="error" >
	<?php
foreach($erm as $a=>$b){ echo "- ".$b."<br>";} 
}
?>
</div>            

            </td>
            </tr>
              <tr>
                <td width="328" height="45"><strong>Nom Utilisateur :</strong></td>
                <td width="345" ><input name="utilisateur" type="text" required id="formule2" width="300" /></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Mot de passe :</strong></td>
                <td width="345" ><input name="passwd" type="password" required id="formule3" width="300" /></td>
              </tr>

                
              
               
                           
 
              <tr>
              <td height="46"></td>
              <td>
              <input name="send" type="submit" value="Se Connecter"  />
              <a href="index.php">
              <input name="retour" type="button" value="retour" height=45px /></a>
              </td>
              </tr>
              <tr>
              <td height="46"></td>
              <td>
              
              <a href="add_user.php">
              - Créer un compte utilisateur
              </a>
              </td>
              </tr>
            </table>

          </form>
		
	</div>
        </div>
        </div>
</div>
	
    <?php piednoir(); ?>



</body>
</html>
