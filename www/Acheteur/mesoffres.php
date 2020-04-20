<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = true;
session_start();
$IdAcheteur = $_SESSION['IdAcheteur'];
$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array();$livraison=array();$etape=array();

//Recupère dans la BDD les informations de l'acheteur qui utilise la session
$sql= "SELECT Prenom, Nom FROM acheteur WHERE IdAcheteur=$IdAcheteur ";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
 $Prenom = $data['Prenom'];
 $Nom = $data['Nom'];}

//Recupère dans la BDD les negociations de l'acheteur qui utilise la session
$sql= "SELECT item.IdItem, Nom, Image, Prix, EtapeNegociation 
FROM item
	join meilleureoffre ON MeilleureOffre.IdItem = item.IdItem
    join negocie ON MeilleureOffre.IdMeilleureOffre = negocie.IdMeilleureOffre
    WHERE negocie.IdAcheteur=$IdAcheteur AND EtapeNegociation!=0";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($etape,$data['EtapeNegociation']);
array_push($prixitem, $data['Prix']);}

if (isset($_POST['Proposer'])) //Si l'acheteur veut faire une contre-offre
{
	$PrixItem = htmlspecialchars($_POST["PRIX"]);
	$IdItem = htmlspecialchars($_POST["ID"]);
}
//Variable EtapeNegociation définit dans quelle camps est la proposition, lors de la proposition initiale de l'acheteur -> EtapeNegociation=1
//Elle s'incremente de 1 à chaque contre-offre, ou passe immédiatement à 0 si la proposition est supprimé/refusé par l'un des parties
//EtapeNegociation impair -> Le vendeur doit faire une contre-offre
//EtapeNegociation pair -> L'acheteur doit faire une contre-offre (sauf si EtapeNegociation=0 ou 6)
//Etape negociation = 5: Le vendeur n'a plus le choix de la contre offre et dois soit accepter, soit refuser
//Etape negociation = 6: L'offre est accepté, payé, l'étape negociation passe immédiatement à 6 si l'un des  partis accepte une proposition.

//[SQL] 1 seul objet negocie entre acheteur et vendeur pour 1 item. 

//Code HTML de l'affichage des offres
function display_item($iditem,$nomitem,$imageitem,$prix,$etape) 
{
	echo "	<div class='col-md-2 col-md-2 col-sm-4'>
					<img align='center' src='$imageitem' height='70' width='70' class='img-fluid'>
				</div>
                
                <div class='col-md-6 col-md-6 col-sm-6'>
                	<p style='font-size: 18px; font-weight: bold;'> $nomitem</p>
                </div>";

         //       <div class='col-md-1 col-md-1 col-sm-0'>
         //       	<hr id='V' style='height: 200px;'>
         //       </div>";
    if($etape==6){//Si offre accepté
    	echo "<div class='col-md-3 col-md-3 col-sm-3' style='background-color: #EFF8FF; border-radius: 3rem; box-shadow: rgba(0,0,0,0.4) 2px 2px;'>
                	<p id='titre'> 
						Le vendeur a accepté votre offre au prix de : <strong>$prix €</strong><br>
					</p>
					<form method='post'> 
					<br><button type='submit' name='panier' class='btn'> Ajouter au panier </button></a>
			        </form>
				    <br>$msg
                </div>";
    }
    else if($etape%2==0){//Si contre-offre reçu
    	echo "<p id='titre'> 
						Le vendeur vous a fait une contre-offre : <strong>$prix €</strong><br>
						<form method='post'>
						<a href='#''><img src='images/yes.png' width='30' height='30'></a>
						<a href='#''><img src='images/no.png' width='30' height='30'></a>
						<br>
						 Contre-offre : <input style='width: 75px' type='text' name='contre' required> € 
						 <input type='hidden' name='ID' value='$iditem' />
						 <input type='hidden' name='PRIX' value='$prix' />
						 <input type='submit' class='submit3' alt='Submit button' name='Proposer' value='Proposer' />
						</form>
					</p>";}
	else if($etape%2!=0){//Si offre/contre-offre en attente
    	echo "<p id='titre'> 
						En attente de la réponse du vendeur. <br> Vous avez fait une offre de: <strong>$prix €</strong><br>
					</p>";
    }
    echo "<hr style='width: 500px; margin-left: 10px;'></div>";
                
}

// Display the decrypted string 


//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay compte</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="acheteur.css">
	<script type="text/javascript">$(document).ready(function(){$('.header').height($(window).height());});
	function myFunction() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(e) {
	  if (!e.target.matches('.dropbtn')) {
	  var myDropdown = document.getElementById("myDropdown");
	    if (myDropdown.classList.contains('show')) {
	      myDropdown.classList.remove('show');
	    }
	  }
	}</script>
</head>
<body>
	<nav class="navbar navbar-expand-md">
		<a class="navbar-brand" href="#"><img src="images/logoblanc.png" width="109" height="30"></a>
		<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
			<div class="collapse navbar-collapse" id="main-navigation">
				 <ul class="nav navbar-nav navbar-right">
			        <li><a class="nav-link" href="accueil.php" style="padding-top: 14px;">ACCUEIL</a></li>
			        
			        <li><div class="dropdown">
  							<button class="dropbtn" onclick="myFunction()">CATEGORIES</button></li>
							<div class="dropdown-content" id="myDropdown">
								
								<ul id="prix">
							  		<li><a href="enchere.php">Enchères</a></li>
									<li><a href="achatimmediat.php">Achats</a></li>
						  			<li><a href="meilleureoffre.php">Offres</a></li>
						  		</ul>
								
						  		<ul id="prix">
						  			<li><a href="tresors.php">Ferraille et trésors</a></li>
						  			<li><a href="musee.php">Musée</a></li>
						  			<li><a href="accessoires.php">Accessoire VIP</a></li>
								</ul>
							</div>
						</div>
					
			        <li style="list-style: none;"><a class="nav-link" href="panier.php"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li style="list-style: none;"><a class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li class="ici" style="list-style: none;"><a  class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

		<div><p><br><br><h1>Mes propositions d'offre</h1><br></p></div>
		<div class="row">
			<div class="col-md-3 col-md-3 col-sm-12">
				<div class="row">
					<div class="col-md-5 col-md-5 col-sm-5">
						<img align="center" src="images/compte.png" height="80" width="80">
					</div>
					<div class="col-md-7 col-md-7 col-sm-7" style="font-weight: bold; font-size: 14px; color: #C4BDE3">
						<p><br><?php echo "$Prenom $Nom" ?></p>
					</div>
				</div>
				<div class="row">
					<div class="menuBIS">
				 		<a href="mesInfos.php">Mes informations</a>
						<a href="modesPaiement.php">Mes modes de paiement</a>
						<a href="mesoffres.php">Mes propositions d'offre</a>
						<a href="mesCommandes.php">Mes commandes</a>
						<a href="aide.php">Aide</a>
						<a href="deconnexion.php">Déconnexion</a>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-md-2 col-sm-12"></div>

			<div class="col-md-7 col-md-7 col-sm-12">
				
				<div class="row">

						<?php  for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i],$etape[$i]);}?>
				</div>
		    </div>
		</div>
	</div>

	<div><p><br><br></p></div>

	<footer class="page-footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12">
						<h6 class="text-uppercase font-weight-bold">Informations additionnelles</h6>
						<p>Ce site est destiné à la vente de particuliers à particuliers. Il est formellement interdit aux professionnels de vendre leurs produits sur notre site.</p>

						<p>Nous restons à l'écoute de nos clients et sommes disponible si ils rencontrent quelconque problème.</p>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-12">
						<h6 class="text-uppercase font-weight-bold">Contact</h6>
						<p>37, quai de Grenelle, 75015 Paris, France <br>serviceclient@ecebay.fr <br>0800 000 689 740</p>
					</div>
				</div>
				<div class="footer-copyright text-center">&copy; 2020 Copyright | Droit d'auteur: baptistevivienclemence@ecebay.fr</div>
		</footer>

</body>
</html>