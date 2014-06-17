<?php 
require('./config/config_societe.php');
protect();
protectsyndic();
error_reporting(E_ALL ^ E_NOTICE);
$montant1=$_GET['mon'];
$idsociete=$_GET['soc'];
$idfacture=$_GET['id'];
connect();
$result=mysql_query("SELECT * FROM payementsoc WHERE id_facture='$idfacture';");
$row=mysql_fetch_assoc($result);
if($row){
	echo"<script>alert(' Vous pouvez pas modifier cette facture car elle a deja ete regle ')</script>";
redirect('listefacture_societe.php');
die();
}
?>
    <?php 

error_reporting(E_ALL ^ E_NOTICE);



$montant=((float)$_POST['montant']);

$facture=$_POST['facture'];



  
if($_POST['send']) {
	
	echo $facture;
$erm = array();

if(!$montant){
		$erm[] = "Le montant saisie est incorrecte.";
	}
if(empty($erm)){
mysql_query("UPDATE facture_s SET montant ='$montant' WHERE id_facture = '$idfacture';");
echo"<script>alert(' La facture a ete modifier avec succes ')</script>";
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

<script type="text/javascript" src="jscal/onChangeFac.js"></script>
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

		

    <?php  menufinance(); ?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Facture Proprietaire</h2>
				<div class="entry">
<?php $msg="modfsoc.php?id=".$idfacture."&soc=".$idsociete."&mon=".$montant1."";  ?>
<form action="<?php $msg;?>" method="post" dir="ltr" lang="fr">
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
                <td width="328" height="45"><strong>choisir une societe : </strong></td>
                <td width="345" ><?php 
				$res = mysql_query("SELECT raisonsocial FROM societe WHERE id_societe='$idsociete';");
				$row=mysql_fetch_assoc($res);
				echo $row['raisonsocial'];
				
				?></td>
              </tr>
 
                
              
                  <td width="328" height="45"><strong> Montant :</strong></td>
              <div id='mon' style='display:inline; color: #000000; font-family: ; font-size: 14px;'Courier New', Courier, monospace;'>
                <td width="70" id='montant1' ><input name="montant" type="text"  size="15" required="required" value="<?php echo $montant1;?>" />
                 
                </td>
                </div>
              </tr>
              
              <tr>
              <td width="328" height="45"><strong> Facture du mois :</strong></td>
                <td width="70" ><?php 
				$res=mysql_query("SELECT * from facture_s where id_facture='$idfacture'");
				$row=mysql_fetch_assoc($res);
				echo $row['mois'];
				?></td>
              </tr>
 <tr > 
             <td width="328" height="45"><strong>Date création facture :</strong></td>
            <td width="70"><?php echo angl_fran($row['datefacture']);?>
</td>
          </tr>
    <tr div class="texte"> 
<td width="328" height="45"><strong>Date limite de payement :</strong></td>
            <td width="42%"><?php echo angl_fran($row['datelimite']);?>
</td>
          </tr>      
          <tr>    
          
              <td height="46"><input type="hidden" value="<?php $idfacture ?> " name="facture"/></td>
              <td>
              <input name="send" type="submit" value="Modifier la facture"  />
              <a href="listefacture_societe.php"><input name="retour" type="button" value="retour" height=45px /></a>
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

