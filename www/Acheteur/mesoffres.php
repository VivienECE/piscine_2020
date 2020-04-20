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
//Variable EtapeNegociation définit dans quelle camps est la proposition, lors de la première proposition EtapeNegociation=1
//Elle s'incremente de 1 à chaque contre-offre, ou passe immédiatement à 0 si la proposition est supprimé/refusé par l'un des parties
//EtapeNegociation impair -> Le vendeur doit faire une contre-offre
//EtapeNegociation pair -> L'acheteur doit faire une contre-offre (sauf si EtapeNegociation=0 ou 6)
//Etape negociation = 5: Le vendeur n'a plus le choix de la contre offre et dois soit accepter, soit refuser
//Etape negociation = 6: L'offre est accepté, payé, l'étape negociation passe immédiatement à 6 si l'un des  partis accepte une proposition.
$sql= "SELECT item.IdItem, Nom, Image, Prix, EtapeNegociation 
FROM item
	join meilleureoffre ON MeilleureOffre.IdItem = item.IdItem
    join negocie ON MeilleureOffre.IdMeilleureOffre = negocie.IdMeilleureOffre
    WHERE negocie.IdAcheteur=$IdAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($etape,$data['EtapeNegociation']);
array_push($prixitem, "Proposition en attente. Vous avez proposé ".$data['Prix']);}


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
    if($etape==6){//A CHANGER 
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
    else{
    	echo "<p id='titre'> 
						Le vendeur vous a fait une contre-offre : <strong>$prix €</strong><br>
						<form method='post'>
						<a href='#''><img src='images/yes.png' width='30' height='30'></a>
						<a href='#''><img src='images/no.png' width='30' height='30'></a>
						<br>
						Contre-offre : <input style='width: 75px' type='text' name='contre'> € 
						 <input type='submit' class='submit3' alt='Submit button' name='button3' value='Proposer' />
						</form>
					</p>";
    }
    echo "<hr style='width: 500px; margin-left: 10px;'>";
                
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
	function Event(evt, div) {
	  // Declare all variables
	  var i, tabcontent, tablinks;

	  // Get all elements with class="tabcontent" and hide them
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }

	  // Get all elements with class="tablinks" and remove the class "active"
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }

	  // Show the current tab, and add an "active" class to the link that opened the tab
	  document.getElementById(div).style.display = "block";
	  evt.currentTarget.className += " active";
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
		        <li><a class="nav-link" href="accueil.php">ACCUEIL</a></li>
		        <li><a class="nav-link" class="tablinks" onclick="Event(event, 'categories')" >CATEGORIES</a></li>
		        <li><a class="nav-link" href="panier.php"><img src="images/panier.png" width="20" height="20"></a></li>
		        <li><a class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
		        <li class="ici"><a  class="nav-link" href="moncompte.php">MON COMPTE</a></li>
		     </ul>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-0"></div>
			<div   id="categories" class="col-lg-5 col-md-5 col-sm-12">
				<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5">
			  		<br><h5>TYPE DE VENTE</h5>
			  		<ul id="prix">
			  			<li><a href="enchere.php">Enchères</a></li>
			  			<li><a href="achatimmediat.php">Achat immédiat</a></li>
			  			<li><a href="meilleureoffre.php">Meilleure Offre</a></li>
			  		</ul>
			  	</div>
			  	<div class="col-lg-1 col-md-1 col-sm-1"><hr id="V" style="height: 50px;"></div>
			  	<div class="col-lg-6 col-md-6 col-sm-6">
			  		<br><h5>TYPE D'ARTICLE</h5>
			  		<ul id="prix">
			  			<li><a href="tresors.php">Féraille et trésors</a></li>
			  			<li><a href="musee.php">Musée</a></li>
			  			<li><a href="accessoires.php">Accessoire VIP</a></li>
			  		</ul>
			  	</div>
			  </div>
			</div>
		</div>

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
						<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i],$etape[$i]);}?>
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