<?php

require('./config/config_facture.php');
protect();
protectsyndic();
$idfacture=$_GET["id"];
$montant=$_GET["mon"];
$idresident=$_GET["res"];
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);
$datepayement = $_POST['datepayement'];

$datepayement = fran_angl($datepayement);
$montant_p=((float)$_POST['montant_p']);

  
if($_POST['send']) {
	
$erm = array();
	

if(!$montant_p){
$erm[]="le montant saisie est incorecte ";
}

if(ctrl_date1($datepayement))
{$erm[]=ctrl_date1($datepayement);}


if($montant_p>$montant){
$erm[]="Le montant entre est supérieur que le montant que vous devez payer";
}	











if(empty($erm)){
$res = mysql_query("SELECT * FROM proprietaire WHERE id_proprietaire='$idresident' ;");
			$row = mysql_fetch_assoc($res);
			$apart=$row['id_apartement'];	
	
	
addpayement($idfacture,$idresident,$montant_p,$datepayement,$apart);
echo"<script>alert(' Le payement a ete ajoute avec succes ')</script>";
redirect('menu_revenu.php');
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
<style type="text/css">@import url(jscal/calendar-system.css);</style>
<script type="text/javascript" src="jscal/calendar.js"></script>
<script type="text/javascript" src="jscal/lang/calendar-fr.js"></script>
<script type="text/javascript" src="jscal/calendar-setup.js"></script>        
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
				<h2 class="title">Reglement facture syndicale</h2>
				<div class="entry">
	
<?php $msg="payementpro.php?id='.$idfacture.'&res='.$idresident.'&mon='.$montant.'"  ?>
<form action="<?php $msg ?>" method="post" dir="ltr" lang="fr">


<table width="777" height="97" border="0" align="center" id="tableau">
  <tr>
    <td></td>
    <td><?php
 if(!empty($erm) and isset($erm)){
	?>
      <div class="error" >
        <?php
foreach($erm as $a=>$b){ echo "- ".$b."<br>";} 
}
?>
      </div></td>
  </tr>
  <tr>
    <td width="422" height="45"><strong> Nom Immeuble : </strong></td>
    <td width="345" ><strong><?php
	$res = mysql_query("SELECT * FROM proprietaire WHERE id_proprietaire='$idresident' ;");
			$row = mysql_fetch_assoc($res);
			$apart=$row['id_apartement'];
			
		$res1 = mysql_query("SELECT * FROM apartement WHERE id_apartement='$apart' ;");
			$row1 = mysql_fetch_assoc($res1);
			$immeuble=$row1['id_immeuble']	;
			
			$res2 = mysql_query("SELECT * FROM immeuble WHERE id_immeuble='$immeuble' ;");
			$row2 = mysql_fetch_assoc($res2);
			
	echo $row2['nom'];
	 ?></strong></td>
  </tr>
  <tr>
    <td width="422" height="45"><strong> Nom apartement : </strong></td>
    <td width="345" ><strong>
    <?php  echo $row1['nom']; ?>
    </strong>
    </td>
  </tr>
  <tr>
    <td width="328" height="45"><strong>Nom  et Prenom Proprietaire :</strong></td>
    <td width="345" ><strong>
	<?php echo $row['nom'].' '.$row['prenom'];?>
    </strong></td>
  </tr>
  <tr>
    <td width="328" height="45"><strong>Montant a payer   : </strong></td>
    <td width="345" ><strong>
	<?php echo $montant." Dhs" ;?>
    </strong></td>
  </tr>
  <tr>
    <td width="328" height="45"><strong> Date facture est mois :</strong></td>
    <td width="345"><strong>
    <?php 
				$res4 = mysql_query("SELECT * FROM facture WHERE id_facture='$idfacture' ORDER BY datefacture");
			$row4 = mysql_fetch_assoc($res4);
				echo $row4['datefacture']." du mois de : ".$row4['mois'];
				
				?>
    </strong>
    </td>
  </tr>
    <td width="328" height="45"><strong> Montant payer : </strong></td>
    <td width="345" ><input name="montant_p" type="text" required id="formule" width="300" /></td>
  </tr>
  <tr >
    <td width="328" height="45"><strong>Date payement facture :</strong></td>
    <td width="70"><input name="datepayement" type="text" id="datepayement" size="15" required="required" />
      <img src="jscal/img.gif" id="f_trigger_c" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
      <script type="text/javascript">
Calendar.setup(
{
inputField : "datepayement", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c" // ID of the button
}
);
    </script></td>
  </tr>
    <td height="46"></td>
    <td><input name="send" type="submit" value="Valider"  />
      <input name="effacer" type="reset" value="tout effacer" class="parametre" height=45px />
      <a href="parametre.php">
        <input name="retour" type="button" value="retour" height=45px />
      </a></td>
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
