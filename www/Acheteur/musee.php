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
//$sql= "SELECT IdItem, PrixFinal, DateFinal FROM enchere where ...?";
//$result = mysqli_query($db_handle, $sql);

/**
$sql= "SELECT * FROM enchere where IdItem = 1";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Eprix= $data['PrixFinal'];
$Edatefinal= $data['DateFin'];}
$sql= "SELECT * FROM item where IdItem = 1";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Enom= $data['Nom'];
$Eimage= $data['Image'];
$Ecategorie= $data['Categorie'];}**/
//ENCHERE
$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array();$typeitem=array();

$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join enchere ON item.IdItem = enchere.IdItem
	WHERE Categorie='musee'";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,"Vente aux enchères !");}

$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join meilleureoffre ON item.IdItem = meilleureoffre.IdItem
	WHERE Categorie='musee'";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,"Proposez une offre au vendeur !");}

$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join achatimmediat ON item.IdItem = achatimmediat.IdItem
	WHERE Categorie='musee'";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,$data['PrixFinal']."€");}

// Display the decrypted string 
session_start();

//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay panier</title>
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
			        <li><a class="nav-link" href="accueil.html">ACCUEIL</a></li>
			        <li><a class="nav-link" href="categories.html">CATEGORIES</a></li>
			        <li><a class="nav-link" href="panier.html"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="favoris.html"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="moncompte.html">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><h1>MUSEE</h1><br><br></p></div>

	<div class="container features">
		<div class="row">
			<div class="col-md-4 col-md-4 col-sm-12">
				<div align="center" class="thumbnail">
					<a href="images/antiquite.jpg" target="_blank" >
					<img <?php echo "src='$imageitem[0]'"; ?> class="img-fluid">
					<div class="caption">
						<p id="id"><?php echo "$iditem[0]"; ?></p>
						<p id="titre"><?php echo "$nomitem[0]"; ?></p>
						<p id="prix"><?php echo "$prixitem[0]"; ?></p>
					</div></a>
				</div>
			</div>

			<div class="col-md-4 col-md-4 col-sm-12">
				<div align="center" class="thumbnail">
					<a href="images/antiquite.jpg" target="_blank" >
					<img <?php echo "src='$imageitem[1]'"; ?> class="img-fluid">
					<div class="caption">
						<p id="id"><?php echo "$iditem[1]"; ?></p>
						<p id="titre"><?php echo "$nomitem[1]"; ?></p>
						<p id="prix"><?php echo "$prixitem[1]"; ?></p>
					</div></a>
				</div>
			</div>

			<div class="col-md-4 col-md-4 col-sm-12">
				<div  align="center" class="thumbnail">
					<a href="images/antiquite.jpg" target="_blank" >
					<img <?php echo "src='$imageitem[2]'"; ?> class="img-fluid">
					<div class="caption">
						<p id="id"><?php echo "$iditem[2]"; ?></p>
						<p id="titre"><?php echo "$nomitem[2]"; ?></p>
						<p id="prix"><?php echo "$prixitem[2]"; ?></p>
					</div></a>
				</div>
			</div>
		</div>
		<div><br></div>
		<div class="row">
			<div class="col-md-4 col-md-4 col-sm-12">
				<div align="center" class="thumbnail">
					<a href="images/antiquite.jpg" target="_blank" >
					<img <?php echo "src='$imageitem[3]'"; ?> class="img-fluid">
					<div class="caption">
						<p id="id"><?php echo "$iditem[3]"; ?></p>
						<p id="titre"><?php echo "$nomitem[3]"; ?></p>
						<p id="prix"><?php echo "$prixitem[3]"; ?></p>
					</div></a>
				</div>
			</div>

			<div class="col-md-4 col-md-4 col-sm-12">
				<div align="center" class="thumbnail">
					<a href="images/antiquite.jpg" target="_blank" >
					<img <?php echo "src='$imageitem[4]'"; ?> class="img-fluid">
					<div class="caption">
						<p id="id"><?php echo "$iditem[4]"; ?></p>
						<p id="titre"><?php echo "$nomitem[4]"; ?></p>
						<p id="prix"><?php echo "$prixitem[4]"; ?></p>
					</div></a>
				</div>
			</div>

			<div class="col-md-4 col-md-4 col-sm-12">
				<div align="center" class="thumbnail">
					<a href="images/antiquite.jpg" target="_blank" >
					<img <?php echo "src='$imageitem[6]'"; ?> class="img-fluid">
					<div class="caption">
						<p id="id"><?php echo "$iditem[6]"; ?></p>
						<p id="titre"><?php echo "$nomitem[6]"; ?></p>
						<p id="prix"><?php echo "$prixitem[6]"; ?></p>
					</div></a>
				</div>
			</div>
		</div>
	</div>

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