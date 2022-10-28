<?php require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if($_POST)
{
    debug($_POST);
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']); 
    if(!$verif_caractere && (strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20) ) // 
    {
        $contenu .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à 9</div>";
    }
    else
    {
        $membre = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
        if($membre->num_rows > 0)
        {
            $contenu .= "<div class='erreur'>Pseudo indisponible. Veuillez en choisir un autre svp.</div>";
        }
        else
        {
            // $_POST['mdp'] = md5($_POST['mdp']);
            foreach($_POST as $indice => $valeur)
            {
                $_POST[$indice] = htmlEntities(addSlashes($valeur));
            }
            executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");
            $contenu .= "<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
        }
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
			
			<div class="page" >
			

		<div class="message_formulaire" >
				<img src="../image/fond2.jpg">
		</div>
			
		<div class="formulaire">
			
<?php echo $contenu; ?>
 
<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="votre pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>
          
    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" required="required"><br><br>
          
    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" placeholder="votre nom"><br><br>
          
    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" placeholder="votre prénom"><br><br>
  
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
          
    <label for="civilite">Civilité</label><br>
    <input name="civilite" value="m" checked="" type="radio">Homme
    <input name="civilite" value="f" type="radio">Femme<br><br>
                  
    <label for="ville">Ville</label><br>
    <input type="text" id="ville" name="ville" placeholder="votre ville" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_."><br><br>
          
    <label for="cp">Code Postal</label><br>
    <input type="text" id="code_postal" name="code_postal" placeholder="code postal" pattern="[0-9]{5}" title="5 chiffres requis : 0-9"><br><br>
          
    <label for="adresse">Adresse</label><br>
    <textarea id="adresse" name="adresse" placeholder="votre dresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés :  a-zA-Z0-9-_."></textarea><br><br>
 
    <input type="submit" name="inscription" value="S'inscrire">
</form>
 
 </div>
 
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