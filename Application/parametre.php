<?php require('./config/config.php');?>
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

		

    <?php  menuservice(); ?>
    <div id="three-column" class="container">

	
		
		
	<p><table width="200" border="0">
  <tr>
    <td height="354">    <div id="tbox3">
			<div class="box-style box-style03">
            <a href="menu_residence.php">
        
				<div class="content">
					<div class="image"><img src="images/reside.jpg" width="198" height="200" alt="" /></div>
					<h2>informations sur la <br> residence</h2>
</div></a>
			</div>
	  </div>
	</td>
    <td>    <div id="tbox2">
			<div class="box-style box-style02">
            <a href="menu_buil.php">
				<div class="content">
					<div class="image"><img src="images/imm.jpg" width="198" height="200" alt="" /></div>
					<h2>informations sur les immeubles</h2>
					
				</div></a>
			</div>
	  </div></td>
    <td>		<div id="tbox1">
			<div class="box-style box-style01">
            <a href="menu_aprt.php">
				<div class="content">
					<div class="image"><img src="images/great-dec.jpg" width="198" height="200" alt="" /></div>
					<h2>informations sur les apartements</h2>
				</div></a>
			</div>
		</div></td>
         <td>    <div id="tbox4">
			<div class="box-style box-style04">
            <a href="menu_prop.php">
				<div class="content">
					<div class="image"><img src="images/family-home.jpg" width="198" height="200" alt="" /></div>
					<h2>informations sur les proprietaires</h2>
					
				</div></a>
			</div>
	  </div>
	</td>
     <td>    <div id="tbox5">
			<div class="box-style box-style05">
            <a href="menu_syndic.php">
				<div class="content">
					<div class="image"><img src="images/syndic.png" width="198" height="200" alt="" /></div>
					<h2> informations sur le <br> syndic</h2>
					
				</div></a>
			</div>
	  </div>
	</td>
  </tr>
</table>
</p>
</div>
	<?php piednoir();?>
</body>
</html>
