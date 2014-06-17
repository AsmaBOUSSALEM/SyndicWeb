<?php

require('./config/config_buil.php');
protect();
protectsyndic();
$imm=$_GET['id'];
?>
    <?php 
	
	
	
connect();
error_reporting(E_ALL ^ E_NOTICE);

$nom=$_POST['nom'];
$nbreApart=$_POST['nbreApart'];
$nbreEtage=$_POST['nbreEtage'];
$idresidence=$_POST['residence'];
$nom=mb_strtoupper($nom);
//echo $idresidence;
  
if($_POST['send']) {
	
	
$erm = array();
	
$recherche = ("SELECT * FROM immeuble WHERE nom='$nom' AND id_residence='$idresidence' and id_immeuble<>'$imm';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);

if ($row) {
	$erm[] = "Ce nom d'immeuble est déja créer pour cette residence ";
}





if (!is_numeric($nbreApart)) {
	$erm[] = "Le nombre d'apartement que vous avez saisé est incorrecte";
}
if (!is_numeric($nbreEtage)) {
	$erm[] = "Le nombre d'étage que vous avez saisé est incorrecte";
}

if ($idresidence==-1) {
	$erm[] = "Vous devez choisir une résidence si cette dernière ne figure pas dans la liste veuillez l'ajouter <a href='add_residence.php'>en cliquant ici</a>";
}
//Rechercher le nombre d'immeuble deja créer pour la residence selectionner
$recherche1 = ("SELECT COUNT(*) FROM immeuble WHERE id_residence='$idresidence';" ) ;
$result1 = mysql_query($recherche1);
$row1 = mysql_fetch_array($result1);
$count=$row1[0];
//Rechercher le nombre d'apartement déja créer par immeuble pour la residence selectionner
$recherche1 = ("SELECT SUM(nbreApart) FROM immeuble
GROUP BY id_residence
 having id_residence='$idresidence';" ) ;
$result1 = mysql_query($recherche1);
$row1 = mysql_fetch_array($result1);
$sum=$row1[0];
$sum=$sum+$nbreApart;


$recherche2 = ("SELECT * FROM residence WHERE id_residence='$idresidence';" ) ;
$result2 = mysql_query($recherche2);
$row2 = mysql_fetch_array($result2);
$nbre_Imm=$row2['nbreImm'];
$nbre_Apart=$row2['nbreApart'];

$re=mysql_query("SELECT * from immeuble where id_immeuble='$imm';");
$ro=mysql_fetch_assoc($re);
if($ro['id_residence']==$idresidence) $n=0;
else $n=1;

if(n==1){
if ($count>$nbre_Imm){
		$erm[] = "Vous avez atteint le nombre maximum d'immeuble pour cette résidence . ";
}
}
$sum=$sum-$ro['nbreApart'];

if ($sum>$nbre_Apart){
		$erm[] = "Vous avez atteint le nombre maximum d'apartement pour cette résidence . ";
}

$recherche3=mysql_query("SELECT count(*) as c from apartement where id_immeuble=$imm;");
$row3=mysql_fetch_assoc($recherche3);
if($row3['c']>$nbreApart){
	$erm[] = "Le nombre d'apartement que vous avez saisie est inférieure au nombre d'apartement créer";
}


if(empty($erm)){

mysql_query("UPDATE immeuble set nom='$nom',nbreApart='$nbreApart',nbreEtage='$nbreEtage',id_residence='$idresidence' where id_immeuble='$imm'");

echo'<script>alert("L\'immeuble a ete modifier avec succes ")</script>';
redirect('listimm.php');
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
				<h2 class="title">Modification immeuble </h2>
				<div class="entry">
	<?php $msg="modimm.php?id=".$imm."";  ?>
<form action="<?php $imm ;?>" method="post" dir="ltr" lang="fr">
            <table width="777" height="97" border="0" align="center" id="tableau">    
            <tr>
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
                <td width="422" height="45"><strong>Nom de l'immeuble :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300" value="<?php 
				$r=mysql_query("SELECT * from immeuble where id_immeuble=$imm ;");
				$r=mysql_fetch_assoc($r);
				echo  $r['nom'];
				
				
				?>"/></td>
              </tr>
              <tr>
                            <td width="422" height="45"><strong> Nombre d'apartement : </strong></td>
                <td width="345" ><input name="nbreApart" type="text" required id="formule" width="300" value="<?php echo  $r['nbreApart']; ?>"></td>
              </tr>
              <tr>
                            <td width="422" height="45"><strong> Nombre d'étage : </strong></td>
                <td width="345" ><input name="nbreEtage" type="text" required id="formule" width="300" value="<?php echo  $r['nbreEtage']; ?>"></td>
              </tr>
          <tr>
 
                <td width="422" height="45"><strong> Raison social de la résidence à laquelle  l'immeuble appartient : </strong></td>
        <td><select name='residence' id='residence' >
       <?php 
	   connect();
	   $res = mysql_query("SELECT * FROM residence where id_residence=".$r['id_residence']."");
	   $row=mysql_fetch_assoc($res);
	   echo "<option value='".$row["id_residence"]."'>".$row["raisonsocial"]."</option>";
	   ?>
                  
                  <?php
						
						$res = mysql_query("SELECT * FROM residence where id_residence<>".$r['id_residence']."");
						while($row = mysql_fetch_assoc($res)){
							echo "<option value='".$row["id_residence"]."'>".$row["raisonsocial"]."</option>";
						}
					?>
                </select></td>
              </tr>    
              <tr>
              <td height="46"></td>
              <td>
              <input name="send" type="submit" value="Modifier"  />
               
<a href="listimm.php"><input name="retour" type="button" value="retour" height=45px /></a>
              </td>
              </tr>
              <tr>
              <td height="46"></td>
              <td>

              </td>
              </tr>
              
            </table>

          </form>
		
        </div>
        </div>
	
</div>

<?php piednoir(); ?>
</body>
</html>
