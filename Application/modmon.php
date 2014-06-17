<?php

require('./config/config_montant.php');
protect();
protectsyndic();
$mnt=$_GET['ida']
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);


$proprio=$_POST['proprietaire'];
$montant=((float)$_POST['montant']);





  
if($_POST['send']) {
	
	
$erm = array();


if(!$montant){
		$erm[] = "Le montant saisie est incorrecte.";
	}
	
if(empty($erm)){

mysql_query("UPDATE montant_s set id_proprietaire='$idpro',montant='$montant' where id_montant='$mnt' ;");
		echo'<script>alert("Le montant a ete modifier avec succes ")</script>';
		redirect('listmontant.php');
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
				<h2 class="title">modification des montants</h2>
				<div class="entry">
	
    <?php 
	$r=mysql_query("SELECT * from montant_s where id_montant='$mnt';");
	$ro=mysql_fetch_assoc($r);
	$idapart=$ro['id_apartement'];
	$apar=$ro3['nom'];
	
	$r1=mysql_query("SELECT * from proprietaire where id_apartement='$idapart	';");
	$ro1=mysql_fetch_assoc($r1);
	$nompre=$ro1['nom']." ".$ro1['prenom'];
	$idpro=$ro1['id_proprietaire'];
	

	
	$r3=mysql_query("SELECT * from apartement where id_apartement='$idapart	';");
	$ro3=mysql_fetch_assoc($r3);
	$apar=$ro3['nom'];
	$idimm=$ro3['id_immeuble'];
	
	
	
		$r2=mysql_query("SELECT * from immeuble where id_immeuble='$idimm	';");
	$ro2=mysql_fetch_assoc($r2);
	$imm=$ro2['nom'];
	?>
    <?php $msg="modmon.php?id=".$apart."";  ?>
<form action="<?php $msg; ?>" method="post" dir="ltr" lang="fr">
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
                <td width="328" height="45"><strong>Nom d'immeuble d'habitation: </strong></td>
                <td width="345" ><strong><?php echo $imm ;?></strong></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Nom d'apartement d'habitation:</strong></td>
                <td width="345" ><strong><?php echo $apar ;?></strong></td>
              </tr>
 <tr>
        <td width="328" height="45"><strong> Propriaitere:</strong></td>
                <td><strong>
<?php echo $nompre ;?></strong>
                </td>
              </tr>
              <tr>
                  <td width="328" height="45"><strong> Montant :</strong></td>
                <td width="70" ><input name="montant" type="text" required id="formule" width="300" value="<?php echo $ro['montant'];?>"></td>
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
<a href="listmontant.php"><input name="retour" type="button" value="retour" height=45px />
              </a></td>
              </tr>
            </table>
<input type="hidden" name="proprietaire" value="<?php $idpro ;?>"/>
          </form>
		
	
</div>
	</div>
    </div>
   </div>
    
<?php piednoir() ; ?>


</body>
</html>
