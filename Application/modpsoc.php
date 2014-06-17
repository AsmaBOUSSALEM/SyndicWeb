<?php

require('./config/config_societe.php');
protect();
protectsyndic();
error_reporting(E_ALL ^ E_NOTICE);
$idfacture=$_GET["fac"];
$montant=$_GET["mon"];
$societe=$_GET["soc"];
$idpayement=$_GET['id'];

connect();
$res = mysql_query("SELECT * FROM payementsoc WHERE id_payement='$idpayement' ;");

			$row = mysql_fetch_assoc($res);
			$date=$row['datePayement'];
			$date=angl_fran($date);


?>
    <?php 
connect();
$datepayement = $_POST['datepayement'];

$datepayement = fran_angl($datepayement);
$montant_p=((float)$_POST['montant_p']);
$reste1=$_POST['reste1'];

//$reste1=eval('$reste1 = $_POST["'.$reste.'"];');  
  
  
if($_POST['send']) {
	
	
$erm = array();
	

if(!$montant_p){
$erm[]="le montant saisie est incorecte ";
}

if(ctrl_date1($datepayement))
{$erm[]=ctrl_date1($datepayement);}

if($montant_p>$reste1){
$erm[]="Le montant entre est supérieur que le montant que vous devez payer";
}


if(empty($erm)){
connect();
mysql_query("UPDATE payementsoc SET datePayement ='$datepayement' , montantPayer='$montant_p' WHERE id_payement = '$idpayement';");
	
echo"<script>alert(' Le payement a ete Modifier avec succes ')</script>";
redirect('listefacture_societe.php');
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
				<h2 class="title">Modification Payement Facture</h2>
				<div class="entry">
	<?php $msg="modpsoc.php?id=".$idpayement."&fac=".$idfacture."&soc=".$societe."&mon=".$montant."";  ?>
<form action="<?php echo $msg ?>" method="post" dir="ltr" lang="fr">
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
                            <td width="422" height="45"><strong> Raison social : </strong></td>
                <td width="345" ><strong> <?php 
				$res = mysql_query("SELECT * FROM societe WHERE id_societe=$societe ORDER BY raisonsocial");
			$row = mysql_fetch_assoc($res);
				echo $row['raisonsocial'];
				
				
				?> </strong></td>
              </tr>
              
             
 <tr>
                <td width="328" height="45"><strong>Montant restant   : </strong></td>
                <td width="345" ><?php 
				$res1 = mysql_query("SELECT montant FROM facture_s WHERE id_facture=$idfacture ");
			$row1 = mysql_fetch_assoc($res1);
			$mon1=$row1['montant'];
		
			
			$res2 = mysql_query("SELECT ROUND(SUM(montantPayer),1) as sum FROM payementsoc GROUP BY id_facture HAVING id_facture='$idfacture' ");
			$row2 = mysql_fetch_assoc($res2); 
				$mon2=$row2['sum'];
				
				
				$reste=$mon1-($mon2-$montant);
				
				echo $reste." Dhs ";
				
				
				?>
                <input type="hidden" name="reste1" value="<?php echo "$reste" ;

        ?>">
                </td>
              </tr>
              <tr>
              <td width="328" height="45"> <strong> Date facture est mois :</strong>
              </td>
              <td width="345">
                <?php 
				$res = mysql_query("SELECT * FROM facture_s WHERE id_facture='$idfacture' ORDER BY datefacture");
			$row = mysql_fetch_assoc($res);
				echo $row['datefacture']." du mois de : ".$row['mois'];
				
				?>
              
              </td>
              </tr>
                          <td width="328" height="45"><strong> Montant payer : </strong></td>
                <td width="345" ><input name="montant_p" type="text" required id="formule" width="300" value="<?php echo $montant ; ?>"></td>
              </tr>
              
  <tr > 
             <td width="328" height="45"><strong>Date payement facture :</strong></td>
            <td width="70">
           
            <input name="datepayement" type="text" id="datepayement" size="15" required="required" value="<?php echo $date ;?>"/>
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
</script>
</td>
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
