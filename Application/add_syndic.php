<?php

require('./config/config_syndic.php');
protect();
protectsyndic();
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$sexe=$_POST['sexe'];
$cin=$_POST['cin'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$utilisateur=$_POST['utilisateur'];
$passwd=$_POST['passwd'];
$passwd2=$_POST['passwd2'];
$idresidence=$_POST['residence'];
$nom=mb_strtoupper($nom);
$prenom=ucfirst(strtolower($prenom));
  
if($_POST['send']) {
	
	
$erm = array();

$recherche = ("SELECT * FROM syndic WHERE utilisateur='$utilisateur';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);

if ($row) {
	$erm[] = "L'utilisateur \"".htmlspecialchars($_POST['utilisateur'])."\" est déjà utilisé.";
}

$recherche = ("SELECT * FROM pseudo WHERE pseudo='$utilisateur';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);

if ($row) {
	$erm[] = "L'utilisateur \"".htmlspecialchars($_POST['utilisateur'])."\" est déjà utilisé.";
}



if(strlen($_POST['utilisateur'])<4){
		$erm[] = "L'utilisateur doit faire au moins 4 caractères";
}

	if($_POST['idresidence']==-1){
		$erm[] = "Vous devez choisir une résidence si cette dernière ne figure pas dans la liste veuillez l'ajouter <a href='add_residence.php'> En cliquant ic </a> ";
	}
	
	
	if($_POST['passwd']!=$_POST['passwd2']){
		$erm[] = "Les deux mots de passes ne sont pas identique.";
	}
	
	if(strlen($_POST['passwd'])<2){
		$erm[] = "Le mot de passe doit faire au moins 6 caractères";
	}
	
	if($_POST['passwd']==$_POST['utilisateur']){
		$erm[] = "Le mot de passe doit être différent du pseudo";	
	}
	
$recherche = ("SELECT * FROM syndic WHERE nom='$nom';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	if($row['prenom']==$prenom){
	$erm[] = "Ce Syndic existe déja dans la liste des syndics";
}
}
if (!is_numeric($telephone)) {
	$erm[] = "Le numero télephone que vous avez saisé est incorrecte";

}
if($sexe!="M" and $sexe!="F"){
	$erm[] = "veuillez choisir un sexe pour le syndic";
}


if(empty($erm)){
	$passwd=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(key_encrypt), $passwd, MCRYPT_MODE_CBC, md5(md5(key_encrypt))));
addsyndic($nom,$prenom,$sexe,$cin,$telephone,$email,$utilisateur,$passwd,$idresidence);
echo"<script>alert(' Le syndic  a été ajouté avec succès ')</script>";

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

		

    <?php  menuservice();?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">ajout d'un syndic </h2>
				<div class="entry">
	
<form action="add_syndic.php" method="post" dir="ltr" lang="fr">
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
                <td width="328" height="45"><strong>Nom du Syndic :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300"></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Prenom du Syndic : </strong></td>
                <td width="345" ><input name="prenom" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
                <td width="328" height="45"><strong>la résidence pris en charge : </strong></td>
                <td width="345" ><select name='residence' id='residence' >
					<option value='-1'>-- Choisissez une Résidence --</option>
					<?php
						connect();
						$res = mysql_query("SELECT * FROM residence ORDER BY raisonsocial");
						while($row = mysql_fetch_assoc($res)){
							echo "<option value='".$row["id_residence"]."'>".$row["raisonsocial"]."</option>";
						}
					?>
				</select></td>
              </tr>
              <tr>
              <td width="328" height="45"> <strong> Sexe :</strong>
              </td>
              <td width="345"><p>
                <label>
                  <input type="radio" name="sexe" value="M" id="sm" align="left" />
                  Masculin</label>
               
                <label>
                  <input type="radio" name="sexe" value="F" id="sf" align="left" />
                  Féminin</label>
                <br />
              </p>
              
              </td>
              </tr>
                          <td width="328" height="45"><strong> CIN : </strong></td>
                <td width="345" ><input name="cin" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
                          <td width="328" height="45"><strong> Telephone : </strong></td>
                <td width="345" ><input name="telephone" type="text" required id="formule" width="300"></td>
              </tr>
 <tr>
 
                <td width="328" height="45"><strong>Adresse Email : </strong></td>
        <td><input name="email" type="email" required id="formule" width="300"></td>
              </tr>
              <tr>
                          <td width="328" height="45"><strong> Pseudo : </strong></td>
                <td width="345" ><input name="utilisateur" type="text" required id="formule" width="300"></td>
              </tr>
 <tr>
 
                <td width="328" height="45"><strong>Mot de passe : </strong></td>
        <td><input name="passwd" type="password" required id="formule" width="300"></td>
              </tr>
              
              <tr>
 
                <td width="328" height="45"><strong>Validation Mot de Passe : </strong></td>
        <td><input name="passwd2" type="password" required id="formule" width="300"></td>
              </tr>
              <td height="46"></td>
              <td>
              <input name="send" type="submit" value="Valider"  />
                <input name="effacer" type="reset" value="tout effacer" class="parametre" height=45px />
<a href="parametre.php"><input name="retour" type="button" value="retour" height=45px /></a>
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
