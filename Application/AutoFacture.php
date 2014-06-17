<?php
require('./config/config.php');
protect();
protectsyndic();
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

		

    <?php  menufinance(); ?>
    <div id="three-column" class="container">
<div class="post">
<h2 class="title">Generation des factures automatiquements</h2>
<form action="creationauto.php" method="post" dir="ltr" lang="fr">
    <table width="1022" height="97" border="0" align="center" id="tableau">    <tr>
            
<td width="129" height="45"><strong> Facture du mois :</strong></td>
                <td width="200" ><select name='mois' id='mois'>
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
                <td width="160" height="45"><strong>Date création facture :</strong></td>
            <td width="172"><input name="datefacture" type="text" id="datefacture" size="15" required="required" />
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
<td width="164" height="45"><strong>Date limite de payement :</strong></td>
            <td width="171"><input name="datelimite" type="text" id="datelimite" size="15" required="required"/>
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
<td>
</td>
<td></td>
<td></td>
<td>
  <input name="send" type="submit" value="Creer les factures"  />
      </td> </tr>   </table>
           </form>
           </div>
           </div>
           </div>
           <?php piednoir(); ?>

</body>
</html>
