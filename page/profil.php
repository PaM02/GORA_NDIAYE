<!DOCTYPE html> 
<html>    
<head>        
	<meta charset="utf-8" />        
	<title>Ndiaye's Couture</title>  
	<link rel="stylesheet" href="../css/style.css"/>
	<script src="../js/prefixfree.min.js"></script>



	
</head>    
<body>
	
	
	        <header style="text-align:center;">
				<h1><img src="../image/logo.jpg" class="logo" > Ndiaye's Couture</h1>
            </header>


	
	
		
			<nav>
				<ul>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="../page_accueil.html">Accueil</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="profil.php">Profil</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="boutique.php">Boutique</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="panier.php">Panier</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="connexion.php?action=deconnexion">Déconnection</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
				
				</ul>
			</nav><br>
			
<div class="page">

<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecte()) header("location:connexion.php");
// debug($_SESSION);
$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '</strong></p>';
$contenu .= '<div class="cadre"><h2> Voici vos informations </h2>';
$contenu .= '<p> votre email est: ' . $_SESSION['membre']['email'] . '<br>';
$contenu .= 'votre ville est: ' . $_SESSION['membre']['ville'] . '<br>';
$contenu .= 'votre cp est: ' . $_SESSION['membre']['code_postal'] . '<br>';
$contenu .= 'votre adresse est: ' . $_SESSION['membre']['adresse'] . '</p></div><br><br>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;
?>

</div>

<footer>
			<div id="reseaux">
				<h1>Réseaux Sociaux</h1>
				<p><a href="mailto:gndiaye2015@gmail.com"><img style="width:50px;height:50px;" src="../image/facebook.png" alt="Facebook"/></a><a href="mailto:ndiayegoraa@gmail.com"><img style="width:50px;height:50px;" src="../image/gmail.png" alt="Gmail"/></a></p>
			</div>
			<div id="carte">
				<h1>Nous retrouver</h1>
				Adresse:Sante yalla Rufisque<br>
				Pres de la mosquée<br>
				Dakar-Senegal
				
			</div>
			<div id="support">
				<h1>24h/24 7j/7</h1>
				<p> Appel(+221774720577)
			</div>
			<p>Copyright Mon site - Tous droits réservés<br />  
		</footer>
		
		
	
</body>
</html>
