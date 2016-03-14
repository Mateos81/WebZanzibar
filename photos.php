<?php
    session_start();
    include("php/fonctions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/ZanzibarSite.css" />		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>			
		<script type="text/javascript" src="javascript/photos.js"></script> 		
		<script type="text/javascript" src="javascript/scroll.js"></script> 				
		<title>Zanzibar</title>
	</head>
	<body>		
		<div>	
			<header></header>
		</div>

		<div id='banderole'>
			<a href="index.php" class=banderole-link>Accueil</a>
			<a href="photos.php" class=banderole-link>Photos</a>
			<a href="contact.php" class=banderole-link>Contact</a>
			<a href="espPro.php" class=banderole-link>Espace Pro</a>
		</div>
		
		 <script>loadXMLDoc('xml/images.xml');</script> 

		<!-- Slide -->
		<div id="Photos"> 
			<span id="flecheGauche">
				<button onclick="scrollGauche()" ><img src="Images/scroller-arrows-Left.png" /></button>
			</span>
			<div id="slideshow"></div>
			<span id="flecheDroite">
				<button onclick="scrollDroit()" ><img src="Images/scroller-arrows-Right.png" /></button>	
			</span>
		</div> 

		<div id="LrgImg" ></div>	
				
		<footer><?php echo copyright(); ?></footer>
	</body>
</html>
