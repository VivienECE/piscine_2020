<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = true;
function get_file_extension($file) {

return;
}

$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array();$hrefitem=array();


$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join enchere ON item.IdItem = enchere.IdItem";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,"Vente aux enchères !");
array_push($hrefitem,"annonceench.php");}

$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join meilleureoffre ON item.IdItem = meilleureoffre.IdItem";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,"Proposez une offre au vendeur !");
array_push($hrefitem,"annonceof.php");}

$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join achatimmediat ON item.IdItem = achatimmediat.IdItem";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,$data['PrixFinal']."€");
array_push($hrefitem,"annonceim.php");}

//Code HTML de l'affichage
function display_item($iditem,$nomitem,$imageitem,$prixitem,$hrefitem) 
{
	echo "	<div class='col-md-4 col-md-4 col-sm-12'>
				<div align='center' class='thumbnail'>
					<a href='$hrefitem"."?id=$iditem'><img src=$imageitem class='img-fluid'>
					<div class='caption'><br>
						<p id='id'>$iditem</p>
						<p id='titre'>$nomitem</p>
						<p id='prix'>$prixitem</p><br><br>
						</div></a>
				</div>
			</div>";
}

// Display the decrypted string 
session_start();

//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay Annonces</title>
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
			         <li ><a class="nav-link" href="accueiladmin.php">ACCUEIL</a></li>
			        <li><a class="nav-link" href="Aendeurs.php">VENDEURS</a></li>
			        <li class="ici"><a class="nav-link" href="Annonces.php">ANNONCES</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><h1>ANNONCES</h1><br><br></p></div>

	<div class="container features">
		<div class="row">
			<div class="col-md-3 col-md-3 col-sm-3"></div>
			<div class="col-md-5 col-md-5 col-sm-5">
				<p align="center">
					<input class="form-control" id="myInput" type="text" placeholder="Rechercher..." style="width: 505px;"><br>
				</p>
			</div>
			<div class="col-md-1 col-md-1 col-sm-1">
				<a href="#"><img src="images/loupe.png" width="20" height="20"></a>
			</div>
		</div>
		<div class="row"> <!--AFFICHAGE DE TT LES ARTICLES CATEGORIE ACESSOIRE DEPUIS LA BDD-->
					<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i],$hrefitem[$i]);}?>
		</div></div>
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