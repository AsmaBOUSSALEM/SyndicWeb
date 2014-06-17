<?php

require('./config/config_apart.php');
protect();
protectsyndic();
$apart=$_GET['id'];
?>
    <?php 
	
	
	
connect();
error_reporting(E_ALL ^ E_NOTICE);

$nom=$_POST['nom'];
$numEtage=$_POST['numEtage'];
$idtype=$_POST['type'];
$idimmeuble=$_POST['immeuble'];
$nom=mb_strtoupper($nom);

  
if($_POST['send']) {
	
	
$erm = array();
	
$recherche = ("SELECT * FROM apartement WHERE nom='$nom' AND id_immeuble='$idimmeuble' and id_apartement<>'$apart';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);

if ($row) {
	$erm[] = "Ce nom d'apartement est déja créer pour cette immeuble ";
}


if (!is_numeric($numEtage)) {
	$erm[] = "Le nombre d'étage que vous avez saisé est incorrecte";
}

if ($idtype==-1) {
	$erm[] = "Vous devez choisir un type si ce dernièr ne figure pas dans la liste veuillez l'ajouter <a href='add_type.php'>en cliquant ici</a>";
}
if ($idimmeuble==-1) {
	$erm[] = "Vous devez choisir un immeuble si ce dernièr ne figure pas dans la liste veuillez l'ajouter <a href='add_buil.php'>en cliquant ici</a>";
}

//Rechercher le nombre d'immeuble deja créer pour l'immeuble residence selectionner
$recherche1 = ("SELECT COUNT(*) FROM apartement WHERE id_immeuble='$idimmeuble';" ) ;
$result1 = mysql_query($recherche1);
$row1 = mysql_fetch_array($result1);
$count=$row1[0];


$recherche2 = ("SELECT * FROM immeuble WHERE id_immeuble='$idimmeuble';" ) ;
$result2 = mysql_query($recherche2);
$row2 = mysql_fetch_array($result2);
$nbre_Apart=$row2['nbreApart'];

$rec=mysql_query("SELECT * from apartement where id_apartement='$apart'");
$ro=mysql_fetch_assoc($rec);
if($ro['id_immeuble']==$idimmeuble)$n=0;
else $n=1;
if($n1==0){
	$count=$count-1;
}
if ($count>=$nbre_Apart){
		$erm[] = "Vous avez atteint le nombre maximum d'apartement pour cet immeuble . ";
}





if(empty($erm)){
	
mysql_query("UPDATE apartement set nom='$nom',num_etage='$numEtage',id_type='$idtype',id_immeuble='$idimmeuble' where id_apartement='$apart'");


echo'<script>alert("L\'apartement a ete modifier avec succes ")</script>'
;
redirect('listapart.php');
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
				<h2 class="title">modification d'apartement </h2>
				<div class="entry">
	<?php $msg="modapart.php?id=".$apart."";  ?>
<form action="<?php $msg; ?>" method="post" dir="ltr" lang="fr">
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
                <td width="422" height="45"><strong>Nom de l'apartement :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300" value="<?php 
				
				$e=mysql_query("SELECT * from apartement where id_apartement='$apart';");
				$r=mysql_fetch_assoc($e);
				echo $r['nom'];
				
				
				
				?>"></td>
              </tr>
              <tr>
                              <td width="422" height="45"><strong> Numero d'etage : </strong></td>
                <td width="345" ><input name="numEtage" type="text" required id="formule" width="300" value="<?php echo $r['num_etage']; ?>"></td>
              </tr>
              <tr>
                            <td width="422" height="45"><strong> Type d'apartement : </strong></td>
                <td width="345" ><select name='type' id='type' >
                <?php 
				$res = mysql_query("SELECT * FROM type_apart where id_type=".$r['id_type']."");
				$row=mysql_fetch_assoc($res);
				echo "<option value='".$row["id_type"]."'>".$row["nom"]."</option>";
				?>
                 
                  <?php
						
						$res = mysql_query("SELECT * FROM type_apart where id_type<>".$r['id_type']." ");
						while($row = mysql_fetch_assoc($res)){
							echo "<option value='".$row["id_type"]."'>".$row["nom"]."</option>";
						}
					?>
                </select></td>
              </tr>
          <tr>
 
                <td width="422" height="45"><strong>Nom de l'immeuble  : </strong></td>
        <td><select name='immeuble' id='immeuble' >
        <?php
		$res = mysql_query("SELECT * FROM immeuble where id_immeuble=".$r['id_immeuble']." ");
						$row = mysql_fetch_assoc($res);
		echo "<option value='".$row["id_immeuble"]."'>".$row["nom"]."</option>";
		
		?>
                  <?php
						connect();
						$res = mysql_query("SELECT * FROM immeuble where id_immeuble<>".$r['id_immeuble']." ");
						while($row = mysql_fetch_assoc($res)){
							echo "<option value='".$row["id_immeuble"]."'>".$row["nom"]."</option>";
						}
					?>
                </select></td>
              </tr>   
              <tr> 
              <td height="46"></td>
              <td>
              <input name="send" type="submit" value="Modifier"  />
                
<a href="listapart.php"><input name="retour" type="button" value="retour" height=45px /></a>
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
