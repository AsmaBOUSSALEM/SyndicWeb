<?php

include('./config/config.php');
protect();


?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);

$datedebut = $_POST['datedebut'];
$datefin = $_POST['datefin'];


$datedebut = fran_angl($datedebut);
$datefin = fran_angl($datefin);




 

         
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





<script type="text/javascript" src="jscal/onChangePro.js"></script>
        <style type="text/css">
        @import url(jscal/calendar-system.css);#user {
	color: #000000;
}
        #user {
	text-align: left;
}
        </style>
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
<h2 class="title">Consultation du Bilan par periode</h2>
<form action="bilan.php" method="post" dir="ltr" lang="fr">
    <table width="995" height="97" border="0" align="center" id="tableau">    <tr>
            
<td width="129" height="45">&nbsp;</td>
                <td width="200" ><strong>Date Début :</strong></td>
                <td width="160" height="45"><input name="datedebut" type="text" id="datedebut" size="15" required="required" />
<img src="jscal/img.gif" id="f_trigger_c" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datedebut", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c" // ID of the button
}
);
</script></td>
            <td width="177"><strong>Date Fin :</strong>
          </td>
<td width="163" height="45"><input name="datefin" type="text" id="datefin" size="15" required="required"/>
<img src="jscal/img.gif" id="f_trigger_c2" title="Sélectionner une date"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />

<script type="text/javascript">
Calendar.setup(
{
inputField : "datefin", // ID of the input field
ifFormat : "%d-%m-%Y", // the date format
button : "f_trigger_c2" // ID of the button
}
);
</script></td>
            <td width="140">
</td>
</tr>
<tr>
<td>
</td>
<td></td>
<td></td>
<td>
  <input name="send" type="submit" value="Consultation"  />
      </td> </tr>   </table>
           </form>
<h3 class="meta">&nbsp;</h3>
<table width="421" border="3" align="center" class="divider" id="user">
  <tr>
    <td width="426" id="user"><span id="user">Montant des revenues      </span></td>
    
     <td width="426" id="user"><span id="user">Montant des dépenses          </span></td>
    
  </tr>
  
<?php
if($_POST['send']) {
	
	$erm = array();
	
	if(ctrl_date($datedebut, $datefin))
{$erm[]=ctrl_date($datedebut, $datefin);}

if(empty($erm)){

	
$recherche = ("SELECT SUM(montantpayer) as sumrevenu FROM payementpro WHERE datepayement between '$datedebut' and '$datefin';" ) ;
$result = mysql_query($recherche);
$row2 = mysql_fetch_array($result);

$recherche2 = ("SELECT ROUND(SUM(montantpayer),1) as sumdepense FROM payementsoc WHERE datepayement between '$datedebut' and '$datefin';" ) ;
$result2 = mysql_query($recherche2);
$row3 = mysql_fetch_array($result2);

$revenu=$row2['sumrevenu'];
$depense=$row3['sumdepense'];


	
	echo "

	<tr> 
	<td width='426' id='user'>".$revenu."  Dhs    </td>
    
     <td width='426' id='user'>".$depense." Dhs </td>
   
   </tr>";
   	}


}

?>
    </table>
 <?php   
if($_POST['send']) {
if(empty($erm)){
	$somme=$revenu-$depense;
	
	echo "
	
		<table width='421' border='3' align='center' class='divider id='user'>
	<tr>
	 <td width='426' id='user'><h3>Bilan</h3> </td>
	 </tr>
	<tr>
	 <td width='426' id='user' align='center'><p align='center'>".$somme." Dhs </p> </td>
	 </tr>
	 </table>
	
	";
	
	
	
}
}

	?>
      </div>
                </div>
                </div>
                
                
                <?php piednoir(); ?>
  

</body>
</html>
