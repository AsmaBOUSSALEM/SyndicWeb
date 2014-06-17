<?php

require('./config/config_type.php');
protect();
protectsyndic();
$idtype=$_GET['id'];
?>
    <?php 
	
	
	
connect();
error_reporting(E_ALL ^ E_NOTICE);

$nom=$_POST['nom'];
$surface=$_POST['surface'];
$balcon=$_POST['balcon'];
$jardin=$_POST['jardin'];
$type=$_POST['type'];
$nom=mb_strtoupper($nom);

  
if($_POST['send']) {
	
	
$erm = array();
	
$recherche = ("SELECT * FROM type_apart WHERE id_type<>'$idtype' and nom='$nom';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);

if ($row) {
	$erm[] = "Ce nom de type est déja créer";
}


if (!is_numeric($surface)) {
	$erm[] = "La surface que vous avez saisé est incorrecte";
}

if ($balcon!="OUI" and $balcon!="NON") {
	$erm[] = "Vous devez choisir si l'apartement a un balcon";
}

if ($jardin!="OUI" and $jardin!="NON") {
	$erm[] = "Vous devez choisir si l'apartement a un jardin";
}


if(empty($erm)){
	connect();
	echo $type;

mysql_query("UPDATE type_apart SET nom ='$nom' ,surface='$surface', balcon='$balcon',jardin='$jardin' WHERE id_type = '$type';");

echo'<script>alert("Le type a ete modifier avec succes ")</script>';
redirect("listapart.php");
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
				<h2 class="title">modification type apartement</h2>
				<div class="entry">
	<?php $msg="modtype.php?id=".$idtype."";  ?>
<form action="<?php $msg ?>" method="post" dir="ltr" lang="fr">
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
                <td width="422" height="45"><strong>Nom du type :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300" value="<?php 
				$res=mysql_query("select * from type_apart where id_type='$idtype'");
				$row=mysql_fetch_assoc($res);
				echo $row['nom'];
				
				?>"></td>
              </tr>
                              <td width="422" height="45"><strong>La surface de l'apartement par m² : </strong></td>
                <td width="345" ><input name="surface" type="text" required id="formule" width="300" value="<?php echo $row['surface'];?>"></td>
              </tr>
              <tr>
                            <td width="422" height="45"><strong> Balcon : </strong></td>
                <td width="345" >
                <p>
                <label>
                  <input type="radio" name="balcon" value="OUI" id="sm" align="left" />
                  Oui</label>
               
                <label>
                  <input type="radio" name="balcon" value="NON" id="sf" align="left" />
                  Non</label>
                <br />
              </p></td>
              </tr>
          <tr>
 
                <td width="422" height="45"><strong>Jardin  : </strong></td>
        <td>
        <p>
                <label>
                  <input type="radio" name="jardin" value="OUI" id="sm" align="left" />
                  Oui</label>
               
                <label>
                  <input type="radio" name="jardin" value="NON" id="sf" align="left" />
                  non</label>
                <br />
              </p>
        </td>
              </tr>    
              <td height="46">
              <td>
              <input name="send" type="submit" value="Modifier"  />
              <a href="listapart.php">
              <input name="retour" type="button" value="retour" height=45px /></a>
              </td>
              </tr>
            </table>
<input type="hidden" value="<?php echo $idtype?>" name="type" />
          </form>
		
	</div>
        </div>
        </div>
	
</div>
<?php piednoir(); ?>
</body>
</html>
