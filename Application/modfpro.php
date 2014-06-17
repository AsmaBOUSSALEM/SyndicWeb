<?php 
require('./config/config_facture.php');
protect();
protectsyndic();
connect();

$idfacture=$_GET['id'];
$montant1=$_GET['mon'];
$idresident=$_GET['res'];
$res=mysql_query("SELECT * from payementpro WHERE id_facture='$idfacture'; ");
$row=mysql_fetch_assoc($res);
if($row){
		echo"<script>alert(' Vous pouvez pas suprimer cette facture car elle a deja ete regle ')</script>";
redirect('listefacture.php');
die();


}
?>
    <?php 

error_reporting(E_ALL ^ E_NOTICE);







$datefacture = fran_angl($datefacture);



 $montant_f=((float)$_POST['montant_final']);
 
if($_POST['send']) {
	
	
$erm = array();
if(!$montant_f){
$erm[]="le montant saisie est incorecte ";
}
if(empty($erm)){
mysql_query("UPDATE facture SET montant ='$montant_f' WHERE id_facture = '$idfacture';");

echo"<script>alert(' La facture a ete Modifier avec succes ')</script>";
}
redirect('listefacture.php');
die();
 
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
	<?php $msg="modfpro.php?id=".$idfacture."&res=".$idresident."&mon=".$montant1."";  ?>
    
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
                <td width="328" height="45"><strong>Immeuble d'habitation: </strong></td>
                <td width="345" >
                <?php
				
				$result=mysql_query("SELECT * from proprietaire where id_proprietaire='$idresident';");
				$row1=mysql_fetch_assoc($result);
				$nomp=$row1['nom']." ".$row['prenom'];
				$idpart=$row1['id_apartement'];
				
				$result2=mysql_query("SELECT * from apartement where id_apartement='$idpart';");
				$row2=mysql_fetch_assoc($result2);
				
				$nomapart=$row2['nom'];
				$idimmeuble=$row2['id_immeuble'];
				
				
                $res = mysql_query("SELECT * from immeuble where id_immeuble='$idimmeuble'");
						$row = mysql_fetch_assoc($res);
						echo $row['nom'];
                ?>
                </td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Apartement d'habitation:</strong></td>
                <td width="345" >
                <?php echo $nomapart;?>
                </td>
              </tr>
 <tr>
        <td width="328" height="45"><strong> Propriaitere:</strong></td>
                
               
                 <td width="345" >
                <?php 
				
				echo $nomp ;
				
				?>
                 </td>
                
              </tr>
                  <td width="328" height="45"><strong> Montant :</strong></td>
              
                <td width="70" id='montant1' >
                  <input type="text" name="montant_final" value="<?php echo $montant1; ?>" />
                 
                </td>
                
              </tr>
              
              <tr>
              <td width="328" height="45"><strong> Facture du mois :</strong></td>
                <td width="70" >
                <?php 
				$res=mysql_query("SELECT * from facture where id_facture='$idfacture';");
				$row=mysql_fetch_assoc($res);
				echo $row['mois'];
				
				?>
                </td>
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
          
              <td height="46"></td>
              <td>
              <input name="send" type="submit" value="Modifier la facture"  />
              <a href="menu_revenu.php"><input name="retour" type="button" value="retour" height=45px /></a>
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

