<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier'])) 
{   // debug($_POST);
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
    $produit = $resultat->fetch_assoc();
    ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
}
//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}
//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
    for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++) 
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
        $produit = $resultat->fetch_assoc();
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            $contenu .= '<hr><div class="erreur">Stock Restant: ' . $produit['stock'] . '</div>';
            $contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
            if($produit['stock'] > 0)
            {
                $contenu .= '<div class="erreur">la quantité de l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else
            {
                $contenu .= '<div class="erreur">l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
                retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
                $i--;
            }
            $erreur = true;
        }
    }
    if(!isset($erreur))
    {
        executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
        $id_commande = $mysqli->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        }
        unset($_SESSION['panier']);
        mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_commande", "From:ndiayegoraa@gmail");
        $contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
    }
}
 
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
<body >
	
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
			
			
				<div class="page" style="background-image:url('../image/fond1.png');width:100%;">

			
			<?php


echo $contenu;
echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Produit</th><th>Quantité</th><th>Prix Unitaire</th></tr>";
if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
    {
        echo "<tr>";
        echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
        echo "</tr>";
    }
    echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " Francs CFA</td></tr>";
    if(internauteEstConnecte()) 
    {
        echo '<form method="post" action="">';
        echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>';
        echo '</form>';   
    }
    else
    {
        echo '<tr><td colspan="3">Veuillez vous <a style="text-decoration:none;padding:2% 2% 2% 2%;background-color:#4d6b80;color:white;" href="inscription.php">inscrire</a> ou vous <a style="text-decoration:none;padding:2% 2% 2% 2%;background-color:#4d6b80;color:white;" href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
    }
    echo "<tr><td colspan='5'><a href='?action=vider' >Vider mon panier</a></td></tr>";
} 
echo "</table><br>";
echo "<i>Réglement au moment de la livraison</i><br>";
// echo "<hr>session panier:<br>"; debug($_SESSION);
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