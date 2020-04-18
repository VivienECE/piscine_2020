<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;

$idVendeur = $_GET['IdVendeur']; 
session_start();
$msg="";

$sql= "SELECT IdUtilisateur, Nom, Prénom, ImageProfil, ImageFond
FROM vendeur WHERE vendeur.IdVendeur=$idVendeur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Email = $data['IdUtilisateur'];
$Prenom = $data['Prenom'];
$Nom = $data['Nom'];
$ImageProfil = $data['ImageProfil'];
$ImageFond = $data['ImageFond'];}
if($debug){echo "debug:true";}
if (isset($_POST["supprimer"])) {
	if($debug){echo "<br>"."button";}
	$sql="DELETE * from `vendeur` WHERE IdVendeur=$idVendeur";
	$result = mysqli_query($db_handle, $sql);
	$msg="Vendeur supprimé";	
}

for($i = 0;$i < sizeof($idVendeur);$i++)
	{
		$sqlItem="SELECT COUNT(*) as ventes FROM 'item' WHERE IdVendeur=$idVendeur[$i]"; //REQUETE
		$result=mysqli_query($db_handle, $sqlItem); //EXECUTION DE LA REQUETE
		array_push($nbItem,mysqli_fetch_assoc($result)["Ventes"]); //RECUPERE LE NB D'ITEM
	}



//Code HTML de l'affichage
function display_vendeur($ImageProfil,$Prenom,$Nom,$nbItem) 
{
	echo "	<div class='col-lg-5 col-md-5 col-sm-5'>
				<img src=$ImageProfil class='img-fluid' width='150' height='150' style='border-radius: 5em; margin-left: 40px;'><br><br>
			</div>
			<div class='col-lg-7 col-md-7 col-sm-7'>
				<p id='nom'><br>$Prenom $Nom</p>
				<p id='nb'>$nbItem article(s) en vente</p>
				<p id='email'>$Email</p>
			</div>";
}



//fermer la connexion
mysqli_close($db_handle);?><!DOCTYPE html>
<html>
<head>
	<title>ECEbay accueil</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="admin.css">
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
			        <li><a class="nav-link" href="accueiladmin.php">ACCEUIL</a></li>
			        <li class="ici"><a class="nav-link" href="vendeurs.php">VENDEURS</a></li>
			        <li><a class="nav-link" href="annonces.php">ANNONCES</a></li>
			     </ul>
			</div>
	</nav>
	
	<div><p><br><br><br></p></div>

	<div><p><h1>Informations Vendeur</h1><br></p></div>

	<div class="containerINFOS">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-7" style="background-color: #EFF8FF; border-radius: 3rem; box-shadow: rgba(0,0,0,0.4) 2px 2px;">
				<div><p><br></p></div>
				<div class="row">
					<?php display_vendeur($ImageProfil,$Prenom,$Nom,$nbItem) ?>
				</div>
			</div>
			<div align="center" class="col-lg-5 col-md-5 col-sm-5">
				<div><p><br><br><br></p></div>
				<button type="submit" name="supprimer" class="btn" style="background-color: red; color: white; width: 250px;"> SUPPRIMER </button></a>
			</div>
		</div>
	</div>

	<div><br></div>

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