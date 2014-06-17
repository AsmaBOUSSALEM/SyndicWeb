<?php 
require('./config/config_societe.php');
protect();
protectsyndic();
?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$societe=$_POST['societe'];
$mois=$_POST['mois'];
$datefacture = $_POST['datefacture'];
$datelimite = $_POST['datelimite'];

$montant=((float)$_POST['montant']);
$datefacture = fran_angl($datefacture);
$datelimite = fran_angl($datelimite);
$an = substr($datefacture, 0, 4);




  
if($_POST['send']) {
	
	
$erm = array();


if(!$societe){
	$erm[] = "Vous devez en moin choisir une sociète.";
}

if(ctrl_date($datefacture, $datelimite))
{$erm[]=ctrl_date($datefacture, $datelimite);}

$recherche = ("SELECT YEAR(datefacture) FROM facture_s WHERE id_societe='$societe' AND YEAR(datefacture)=$an AND mois='$mois';" ) ;
$result = mysql_query($recherche);
$row = mysql_fetch_array($result);
if($row){
	$erm[]="Il y a deja une facture pour cette date";
}

if($mois==-1){
	$erm[]="vous devez choisir un mois";
}

if(!$montant){
		$erm[] = "Le montant saisie est incorrecte.";
	}
if(empty($erm)){

addfacture($societe,$montant,$datefacture,$datelimite,$mois);

echo"<script>alert(' La facture a été ajouté avec succès ')</script>";
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
	
<form action="facturesociete.php" method="post" dir="ltr" lang="fr">
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
                <td width="345" ><select name='societe' id='societe' >
                  <option value='-1'>-- Choisissez une sociète --</option>
                  <?php
						connect();
						$res = mysql_query("SELECT * FROM societe where active=1 ORDER BY raisonsocial");
						while($row = mysql_fetch_assoc($res)){
							echo "<option value='".$row["id_societe"]."'>".$row["raisonsocial"]."</option>";
						}
					?>
                </select></td>
              </tr>
 
                
              
                  <td width="328" height="45"><strong> Montant :</strong></td>
              <div id='mon' style='display:inline; color: #000000; font-family: ; font-size: 14px;'Courier New', Courier, monospace;'>
                <td width="70" id='montant1' ><input name="montant" type="text"  size="15" required="required" />
                 
                </td>
                </div>
              </tr>
              
              <tr>
              <td width="328" height="45"><strong> Facture du mois :</strong></td>
                <td width="70" ><select name='mois' id='mois'>
                  <option value='-1'>-- Choisissez un mois --</option>
                  <option value='janvier'> Janvier </option>
                  <option value='fevrier'> Février</option>
                  <option value='mars'> Mars </option>
                  <option value='avril'> Avril </option>
                  <option value='mai'> Mai </option>
                  <option value='juin'> Juin </option>
                  <option value='juillet'> Juillet </option>
                  <option value='aout'>  Août </option>
                  <option value='septembre'> Septembre </option>
                  <option value='octobre'> Octobre </option>
                  <option value='novembre'> Novembre </option>
                  <option value='decembre'> Decembre </option>
                </select></td>
              </tr>
 <tr > 
             <td width="328" height="45"><strong>Date création facture :</strong></td>
            <td width="70"><input name="datefacture" type="text" id="datefacture" size="15" required="required" />
<img src="jscal/img.gif" id="f_trigger_c" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datefacture", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c" // ID of the button
}
);
</script>
</td>
          </tr>
    <tr div class="texte"> 
<td width="328" height="45"><strong>Date limite de payement :</strong></td>
            <td width="42%"><input name="datelimite" type="text" id="datelimite" size="15" required="required"/>
<img src="jscal/img.gif" id="f_trigger_c2" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datelimite", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c2" // ID of the button
}
);
</script>
</td>
          </tr>      
          <tr>    
          
              <td height="46"></td>
              <td>
              <input name="send" type="submit" value="Creer la facture"  />
                <input name="effacer" type="reset" value="tout effacer" class="parametre" height=45px />
<a href="parametre.php"><input name="retour" type="button" value="retour" height=45px /></a>
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

