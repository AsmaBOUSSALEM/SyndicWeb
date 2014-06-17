<?php

require('./config/config_residence.php');
protect();
protectsyndic();
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$raisonsocial=$_POST['raisonsocial'];
$adresse=$_POST['adresse'];
$ville=$_POST['ville'];
$nbreImm=$_POST['nbreImm'];
$nbreApart=$_POST['nbreApart'];
$datecreation=$_POST['datecreation'];
$telephone=$_POST['telephone'];
$fax=$_POST['fax'];
$email=$_POST['email'];
$raisonsocial=ucfirst(strtolower($raisonsocial));
$ville=ucfirst(strtolower($ville));
$datecreation = fran_angl($datecreation);
if($_POST['send']) {
	
	
$erm = array();
	
$recherche = ("SELECT * FROM residence WHERE raisonsocial='$raisonsocial';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	$erm[] = "Ce nom de résidence est déja créer  ";
}

if (!is_numeric($telephone)) {
	$erm[] = "Le numero télephone que vous avez saisé est incorrecte";
}

if (!is_numeric($nbreImm)) {
	$erm[] = "Le nombre d'immeuble que vous avez saisé est incorrecte";
}

if (!is_numeric($nbreApart)) {
	$erm[] = "Le nombre d'apartement que vous avez saisé est incorrecte";
}




if(empty($erm)){
addresidence($raisonsocial,$adresse,$ville,$nbreImm,$nbreApart,$telephone,$fax,$email,$datecreation);
echo"<script>alert(' La Résidence a été ajouté avec succès ')</script>";

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
<style type="text/css">@import url(jscal/calendar-system.css);</style>
<script type="text/javascript" src="jscal/calendar.js"></script>
<script type="text/javascript" src="jscal/lang/calendar-fr.js"></script>
<script type="text/javascript" src="jscal/calendar-setup.js"></script>    
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
				<h2 class="title">ajout d'une residence </h2>
				<div class="entry">
	
<form action="add_residence.php" method="post" dir="ltr" lang="fr">
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
                <td width="328" height="45"><strong>Raison Sociale :</strong></td>
                <td width="345" ><input name="raisonsocial" type="text" required id="formule" width="300"></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Adresse : </strong></td>
                <td width="345" ><input name="adresse" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
              <td width="328" height="45"> <strong> Ville :</strong>
              </td>
              <td width="345"><input name="ville" type="text" required="required" id="formule2" width="300" />
                
              
              </td>
              </tr>
                            <td width="328" height="45"><strong> Nombre d'Immeuble : </strong></td>
                <td width="345" ><input name="nbreImm" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
                            <td width="328" height="45"><strong> Nombre d'Apartement : </strong></td>
                <td width="345" ><input name="nbreApart" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
                            <td width="328" height="45"><strong> Date d'ouverture de la résidence : </strong></td>
                <td width="345" >
                <input name="datecreation" type="text" id="datecreation" size="15" required="required" />
<img src="jscal/img.gif" id="f_trigger_c" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datecreation", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c" // ID of the button
}
);
</script>
                </td>
              </tr>
 <tr>
 
                <td width="328" height="45"><strong>Numero Telephone  : </strong></td>
        <td><input name="telephone" type="text" required id="formule" width="300"></td>
              </tr>
  <tr>
 
                <td width="328" height="45"><strong>Numero Fax  : </strong></td>
        <td><input name="fax" type="text" required id="formule" width="300"></td>
              </tr>
    <tr>
 
                <td width="328" height="45"><strong>Adresse Email de la residence  : </strong></td>
        <td><input name="email" type="email" required id="formule" width="300"></td>
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
