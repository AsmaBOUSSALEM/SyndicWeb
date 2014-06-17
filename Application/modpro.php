<?php

require('./config/config_proprio.php');
protect();
protectsyndic();
$pro=$_GET['id'];
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$sexe=$_POST['sexe'];
$cin=$_POST['cin'];
$profession=$_POST['profession'];
$telephone=$_POST['telephone'];
$datehabita=$_POST['datehabita'];
$datehabita = fran_angl($datehabita);
$email=$_POST['email'];
$nom=mb_strtoupper($nom);
$prenom=ucfirst(strtolower($prenom));
  
if($_POST['send']) {
	
	
$erm = array();
	


if (!is_numeric($telephone)) {
	$erm[] = "Le numero télephone que vous avez saisé est incorrecte";

}
if($sexe!="M" and $sexe!="F"){
	$erm[] = "veuillez choisir un sexe pour le syndic";
}


if(ctrl_date1($datehabita))
{$erm[]=ctrl_date1($datehabita);}


if(empty($erm)){
	
	mysql_query("UPDATE proprietaire set nom='$nom',prenom='$prenom',sexe='$sexe',CIN='$cin',profession='$profession', telephone='$telephone',email='$email' , datehabita='$datehabita' where id_proprietaire='$pro'") or die("erreur modification");

echo'<script>alert("Le proprietaire a ete modifier avec succes ")</script>'
;
redirect('listpro.php');
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

		

    <?php  menuservice();?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Modification d'un proprietaire </h2>
				<div class="entry">
		<?php $msg="modpro.php?id=".$pro."";  ?>
<form action="<?php $msg ;?>" method="post" dir="ltr" lang="fr">
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
                            <td width="422" height="45"><strong> Nom apartement : </strong></td>
                <td width="345" ><strong><?php 
				$rec1=mysql_query("SELECT * from proprietaire where id_proprietaire='$pro';");
				$r1=mysql_fetch_assoc($rec1);
				
				$apart=$r1['id_apartement'];
				
				$rec2=mysql_query("SELECT * from apartement where id_apartement='$apart';");
				$r2=mysql_fetch_assoc($rec2);
				
				echo $r2['nom'];?></strong></td>
              </tr>
              <tr>
                <td width="422" height="45"><strong>Nom  :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300" value="<?php echo $r1['nom'];?>"></td>
              </tr>
 <tr>
                <td width="422" height="45"><strong>Prenom  : </strong></td>
                <td width="345" ><input name="prenom" type="text" required id="formule" width="300" value="<?php echo $r1['prenom'];?>"></td>
              </tr>
              <tr>
              <td width="422" height="45"> <strong> Sexe :</strong>
              </td>
              <td width="345"><p>
                <label>
                  <input type="radio" name="sexe" value="M" id="sm" align="left" />
                  Masculin</label>
               
                <label>
                  <input type="radio" name="sexe" value="F" id="sf" align="left" />
                  Féminin</label>
                <br />
              </p>
              
              </td>
              </tr>
                          <td width="422" height="45"><strong> CIN : </strong></td>
                <td width="345" ><input name="cin" type="text" required id="formule" width="300" value="<?php echo $r1['CIN'];?>"></td>
              </tr>
              <tr>
                          <td width="422" height="45"><strong> Profession : </strong></td>
                <td width="345" ><input name="profession" type="text" required id="formule" width="300" value="<?php echo $r1['profession'];?>"></td>
              </tr>
              <tr>
                          <td width="422" height="45"><strong> Telephone : </strong></td>
                <td width="345" ><input name="telephone" type="text" required id="formule" width="300" value="<?php echo $r1['telephone'];?>"></td>
              </tr>
 <tr>
 
                <td width="422" height="45"><strong>Adresse Email : </strong></td>
        <td><input name="email" type="email" required id="formule" width="300" value="<?php echo $r1['email'];?>"></td>
              </tr>
              <tr>
 
                <td width="422" height="45"><strong>Date d'habitation : </strong></td>
       <td width="345"><input name="datehabita" type="text" id="datehabita" size="15" required="required" value="<?php echo angl_fran($r1['datehabita']);?>"/>
<img src="jscal/img.gif" id="f_trigger_c" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datehabita", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c" // ID of the button
}
);
</script></td>
              </tr>
              
              <td height="46">
              <td>
              <input name="send" type="submit" value="Modifier"  />
              
<a href="listpro.php"><input name="retour" type="button" value="retour" height=45px /></a>
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
