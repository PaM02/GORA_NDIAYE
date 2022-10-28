
<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//
$categories_des_produits = executeRequete("SELECT DISTINCT categorie FROM produit");
$contenu .= '<div class="boutique-gauche">';
$contenu .= "<ul>";
while($cat = $categories_des_produits->fetch_assoc())
{
    $contenu .= "<li><a href='?categorie=" . $cat['categorie'] . "'>" . $cat['categorie'] . "</a></li>";
}
$contenu .= "</ul>";
$contenu .= "</div>";
//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '<div class="boutique-droite">';
if(isset($_GET['categorie']))
{
    $donnees = executeRequete("select id_produit,reference,titre,photo,prix from produit where categorie='$_GET[categorie]'");  
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="boutique-produit">';
        $contenu .= "<h2>$produit[titre]</h2>";
		$contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] FCFA</p>";
        $contenu .= '<a style="text-decoration:none;padding:2% 2% 1% 2%;background-color:#4d6b80;color:white;" href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';
    }
}
$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>

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
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="inscription.php">Inscription</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="connexion.php">Connexion</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="boutique.php">Boutique</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="panier.php">Panier</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				
				</ul>
			</nav><br>
			
			
			
<div class="page" style="height:2500px;">

<div class="boutique-droite">
<h3> Nous vendons <br> différents types de produits <br> Vous pouvez <br> choisir le type de costume <br> que vous voulez </h3>


</div>
<?php echo $contenu;?>


		
	
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