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

		

    <?php  menuconnect();?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">ajout d'un proprietaire </h2>
				<div class="entry">
	
<form action="add_user.php" method="post" dir="ltr" lang="fr">
            <table width="777" height="97" border="0" align="center" id="tableau">    <tr>
            <td></td>
            <td>
            <?php
 if(!empty($erm) and isset($erm)){
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
                <td width="328" height="45"><strong>User :</strong></td>
                <td width="345" ><input name="user" type="text" required id="formule" width="300"></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Mot de passe : </strong></td>
                <td width="345" ><input name="passwd" type="password" required id="formule" width="300"></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong> Confirmation Mot de Passe:</strong></td>
                <td width="345" ><input name="passwd2" type="password" required id="formule" width="300"></td>
              </tr>
                <td width="328" height="45"><strong> email :</strong></td>
                <td width="345" ><input name="email" type="email" required id="formule" width="300"></td>
              </tr>
              
                <td width="328" height="45"><strong> nom :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300"></td>
              </tr>
                            <td width="328" height="45"><strong> prenom : </strong></td>
                <td width="345" ><input name="prenom" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
              <td width="328" height="45"> <strong> Sexe :</strong>
              </td>
              <td width="345"><p>
                <label>
                  <input type="radio" name="sexe" value="M" id="sm" />
                  Masculin</label>
               
                <label>
                  <input type="radio" name="sexe" value="F" id="sf" />
                  Féminin</label>
                <br />
              </p>
              
              </td>
              </tr>
                          <td width="328" height="45"><strong> choisir immeuble d'habitation: </strong></td>
                <td width="345" >
                <select name='immeuble' id='immeuble' onchange='go_apart()'>
                  <option value='-1'>-- Choisissez un immeuble --</option>
                  <?php
						connect();
						$res = mysql_query("SELECT * FROM immeuble ORDER BY id_immeuble");
						while($row = mysql_fetch_assoc($res)){
							echo "<option value='".$row["id_immeuble"]."'>".$row["nom"]."</option>";
						}
					?>
                </select></td>
              </tr>
                          <td width="328" height="45"><strong> choisir apartement d'habitation: </strong></td>
                <td width="345" ><span id='apart'><select name='apartement' id='apartement'>
                  <option value='-1'>-- Choisissez un apartement --</option>
                </select></span></td>
              </tr>
 <tr>
 
                <td width="328" height="45">&nbsp;</td>
        <td>&nbsp;</td>
              </tr>
              
              <td height="46">
              <td>
              <input name="send" type="submit" value="Valider"  />
                <input name="effacer" type="reset" value="tout effacer" class="parametre" height=45px />
<a href="parametre.php"><input name="retour" type="button" value="retour" height=45px />
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
