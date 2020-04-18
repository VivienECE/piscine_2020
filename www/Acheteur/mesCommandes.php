<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = true;
session_start();
$idacheteur = $_SESSION['IdAcheteur'];
$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array();$livraison=array();


$sql= "SELECT item.IdItem, Nom, Image, Prix, IdVendeur, Livraison
FROM commandes
	join item ON item.IdItem = commandes.IdItem
	WHERE IdAcheteur=$idacheteur";

$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,$data['Prix']);
array_push($livraison,$data['Livraison']);}

//Code HTML de l'affichage
function display_item($iditem,$nomitem,$imageitem,$prixitem,$livraison) 
{
	echo "	<div class='col-md-2 col-md-2 col-sm-4'>
					<img align='center' src='$imageitem' height='70' width='70' class='img-fluid'>
				</div>
                
                <div class='col-md-8 col-md-8 col-sm-8'>
                	<p style='font-size: 18px; font-weight: bold;'> $nomitem</p>
                	<p style='font-size: 14px; font-weight: bold;'> $iditem<br> $prixitem €<br> Livraison prévue le $livraison <br><a href='#'> Contacter le vendeur</a></p>
                </div>
			</div>

			<hr style='width: 500px; margin-left: 10px;'>";
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
	<script type="text/javascript">$(document).ready(function(){$('.header').height($(window).height());});</script>
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
		        <li><a class="nav-link" href="categories.php">CATEGORIES</a></li>
		        <li><a class="nav-link" href="panier.php"><img src="images/panier.png" width="20" height="20"></a></li>
		        <li><a class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
		        <li class="ici"><a  class="nav-link" href="moncompte.php">MON COMPTE</a></li>
		     </ul>
		</div>
	</nav>

	<div><p><br><br></p></div>

	<div><p><h1>Mes commandes</h1><br></p></div>

	<div class="container">
		<div class="row">
			<div class="col-md-3 col-md-3 col-sm-12">
				<div class="row">
					<div class="col-md-5 col-md-5 col-sm-5">
						<img align="center" src="images/compte.png" height="80" width="80">
					</div>
					<div class="col-md-7 col-md-7 col-sm-7" style="font-weight: bold; font-size: 14px; color: #C4BDE3">
						<p><br>Jean-Pierre SEDADO</p>
					</div>
				</div>
				<div class="row">
					<div class="menuBIS">
				 		<a href="mesInfos.php">Mes informations</a>
						<a href="modesPaiement.php">Mes modes de paiement</a>
						<a href="mesCommandes.php">Mes commandes</a>
						<a href="aide.php">Aide</a>
						<a href="deconnexion.php">Déconnexion</a>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-md-2 col-sm-12"></div>

			<div class="col-md-7 col-md-7 col-sm-12">
				
				<div class="row">
						<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i],$livraison[$i]);}?>
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
						<p>Ce site est destiné à la vente de particuliers à particuuliers. Il est formellement interdit aux professionnels de vendre leurs produits sur notre site.</p>

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