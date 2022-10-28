<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['id_produit']))  { $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); }
if($resultat->num_rows <= 0) { header("location:boutique.php"); exit(); }
 
$produit = $resultat->fetch_assoc();
$contenu .= "<h2>Titre : $produit[titre]</h2><hr><br>";
$contenu .= "<p>Categorie: $produit[categorie]</p>";
$contenu .= "<p>Couleur: $produit[couleur]</p>";
$contenu .= "<p>Taille: $produit[taille]</p>";
$contenu .= "<img src='$produit[photo]' ='150' height='150'>";
$contenu .= "<p><i>Description: $produit[description]</i></p><br>";
$contenu .= "<p>Prix : $produit[prix] FCFA</p><br>";
 
if($produit['stock'] > 0)
{
    $contenu .= "<i>Nombre d'produit(s) disponible : $produit[stock] </i><br><br>";
    $contenu .= '<form method="post" action="panier.php">';
        $contenu .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
        $contenu .= '<label for="quantite">Quantité : </label>';
        $contenu .= '<select id="quantite" name="quantite">';
            for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++)
            {
                $contenu .= "<option>$i</option>";
            }
        $contenu .= '</select>';
        $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier">';
    $contenu .= '</form>';
}
else
{
    $contenu .= 'Rupture de stock !';
}
$contenu .= "<br><a href='boutique.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a>";
//--------------------------------- AFFICHAGE HTML ---------------------------------//
;?>

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
			
			
				<div class="page">



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