<?php

require('./config/config_societe.php');
protect();
protectsyndic();
$id=$_GET['id'];
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);
$raisonsocial=$_POST['raisonsocial'];
$adresse=$_POST['adresse'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$ville=$_POST['ville'];
$fax=$_POST['fax'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$nom=mb_strtoupper($nom);
$prenom=ucfirst(strtolower($prenom));
$raisonsocial=mb_strtoupper($raisonsocial); 
if($_POST['send']) {
	
	
$erm = array();
	
$recherche = ("SELECT * FROM societe WHERE raisonsocial='$raisonsocial' and id_societe<>'$id' ;" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	$erm[] = "Cette sociète existe déjà ";

}



if (!is_numeric($telephone)) {
	$erm[] = "Le numero télephone que vous avez saisé est incorrecte";

}
if (!is_numeric($fax)) {
	$erm[] = "Le numero de fax que vous avez saisé est incorrecte";

}





if(empty($erm)){
	mysql_query("UPDATE societe set raisonsocial='$raisonsocial',adresse='$adresse',ville='$ville',nom='$nom',prenom='$prenom',telephone='$telephone',fax='$fax',email='$email' where id_societe='$id'") or die('Erreur de modification ');

echo"<script>alert(' La societe a ete modifier avec succes ')</script>";
redirect('listsociete.php');
die();
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
<script type="text/javascript" src="jscal/onChange.js"></script>
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

		

    <?php  menufinance();?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Modification d'une societe</h2>
				<div class="entry">
	     <?php $ref="modsoc.php?id=$id";
 ?>
<form action="<?php echo $ref; ?>" method="post" dir="ltr" lang="fr">
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
                            <td width="422" height="45"><strong> Raison social de : </strong></td>
                <td width="345" ><input name="raisonsocial" type="text" required="required" id="formule6" width="300" value="<?php 
				$recherche1=mysql_query("SELECT * FROM societe where id_societe='$id';");
				$row1=mysql_fetch_assoc($recherche1);
				echo $row1['raisonsocial'];
				?>" /></td>
              </tr>
              <tr>
                            <td width="422" height="45"><strong> Adresse : </strong></td>
                <td width="345" >
                <span id='apart'></span>
                <input name="adresse" type="text" required="required" id="formule5" width="300" value="<?php echo $row1['adresse']; ?>" /></td>
              </tr>
              <tr>
                <td width="328" height="45"><strong>Ville  :</strong></td>
                <td width="345" ><input name="ville" type="text" required id="formule" width="300" value="<?php echo $row1['ville']; ?>"></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Nom Representant  : </strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300" value="<?php echo $row1['nom']; ?>"></td>
              </tr>
              <tr>
              <td width="328" height="45"> <strong>Prenom Representant  : :</strong>
              </td>
              <td width="345"><input name="prenom" type="text" required id="formule4" width="300" value="<?php echo $row1['prenom']; ?>" />
          
              
              </td>
              </tr>
                          <td width="328" height="45"><strong>Telephone : </strong></td>
                <td width="345" ><input name="telephone" type="text" required id="formule2" width="300" value="<?php echo '0'.$row1['telephone']; ?>"/></td>
              </tr>
              <tr>
                          <td width="328" height="45"><strong>Fax : </strong></td>
                <td width="345" ><input name="fax" type="text" required id="formule" width="300" value="<?php echo '0'.$row1['fax']; ?>"></td>
              </tr>
              <tr>
                          <td width="328" height="45"><strong>Adresse Email : </strong></td>
                <td width="345" ><input name="email" type="email" required id="formule3" width="300" value="<?php echo $row1['email']; ?>"/></td>
              </tr>
 <tr>
 
                <td width="328" height="45">&nbsp;</td>
        <td>&nbsp;</td>
              </tr>
              
              <td height="46">
              <td>
              <input name="send" type="submit" value="Modifier"  />
              <a href="listsociete.php">
              <input name="retour" type="button" value="retour" height=45px />
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
