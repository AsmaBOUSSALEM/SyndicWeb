<?php

require('./config/config_montant.php');
protect();
protectsyndic();
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$immeuble=$_POST['immeuble'];
$apartement=$_POST['apartement'];
$proprio=$_POST['proprietaire'];
$montant=((float)$_POST['montant']);





  
if($_POST['send']) {
	
	
$erm = array();
$recherche = ("SELECT * FROM montant_s WHERE id_apartement='$apartement';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if ($row) {
	$erm[] = "Cette apartement a déja un montant Syndicale.";
}
if(!$apartement){
	$erm[] = "Vous devez en moin choisir un apartement.";
}
if($proprio==0){
	$erm[] = "Cet apartement n'a pas de proprietaire.";
}

if(!$montant){
		$erm[] = "Le montant saisie est incorrecte.";
	}
	
if(empty($erm)){

		addmontant($apartement,$proprio,$montant);
		echo'<script>alert("Le montant a été ajouté avec succès ")</script>';
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

		

    <?php  menufinance(); ?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">ajout des montants</h2>
				<div class="entry">
	
<form action="montantsyndicale.php" method="post" dir="ltr" lang="fr">
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
                <td width="328" height="45"><strong>choisir immeuble d'habitation: </strong></td>
                <td width="345" ><select name='immeuble' id='immeuble' onchange='go_apart()'>
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
 <tr>
                <td width="328" height="45"><strong>choisir apartement d'habitation:</strong></td>
                <td width="345" >
                <span id='apart' >
                <select name='apartement' id='apartement' onchange='go_proprio()'>
                  <option value='-1'>-- Choisissez un apartement --</option>
                </select>
				</span></td>
              </tr>
 <tr>
        <td width="328" height="45"><strong> Propriaitere:</strong></td>
                <td>
                <span id='proprietaire' >
                
				</span>
                </td>
              </tr>
              <tr>
                  <td width="328" height="45"><strong> Montant :</strong></td>
                <td width="70" ><input name="montant" type="text" required id="formule" width="300" ></td>
              </tr>
 <tr>
 
                <td width="328" height="45">&nbsp;</td>
        <td>&nbsp;</td>
              </tr>
              <tr>
              <td height="46"></td>
              <td>
              <input name="send" type="submit" value="Valider"  />
                <input name="effacer" type="reset" value="tout effacer" class="parametre" height=45px />
<a href="parametre.php"><input name="retour" type="button" value="retour" height=45px />
              </a></td>
              </tr>
            </table>

          </form>
		
	
</div>
	</div>
    </div>
   </div>
    
<?php piednoir() ; ?>


</body>
</html>
