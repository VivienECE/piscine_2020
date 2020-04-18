<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
session_start();
$idAcheteur = $_SESSION['IdAcheteur'];
$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array(); $typeitem=array(); $hrefitem=array();

if (isset($_POST["delete"])) {
	if($debug){echo "DELETE";}
	$IdItem = htmlspecialchars($_POST["IdItem"]);
	$sql = "DELETE FROM `favoris` WHERE IdItem=$IdItem AND IdAcheteur=$idAcheteur" ;
	if($debug){echo "<br>".$sql;}
	$result = mysqli_query($db_handle, $sql);
}

$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join achatimmediat ON achatimmediat.IdItem = item.IdItem
    join favoris ON favoris.IdItem = item.IdItem
    WHERE favoris.IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,$data['PrixFinal']);
array_push($hrefitem,"clicEncheres.php");
array_push($hrefitem,"clicImmediat.php");}

$sql= "SELECT item.IdItem, Nom, Image
FROM item
	join enchere ON enchere.IdItem = item.IdItem
    join favoris ON item.IdItem = favoris.IdItem
    WHERE favoris.IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem, "Enchere");
array_push($hrefitem,"clicEncheres.php");}

$sql= "SELECT item.IdItem, Nom, Image
FROM item
	join meilleureoffre ON MeilleureOffre.IdItem = item.IdItem
    join favoris ON favoris.IdItem = item.IdItem
    WHERE favoris.IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem, "Prix negociable");
array_push($hrefitem,"clicOffre.php");}


//Code HTML de l'affichage
function display_item($iditem,$nomitem,$imageitem,$prixitem,$hrefitem) 
{
	echo "  <div class='col-md-4 col-md-4 col-sm-12'>
				<p align='center'><img src='images/favoris.png' height='50' width='50' style='margin-left: 70px;'></p>
				<div align='center' class='thumbnail'>
					<a href='$hrefitem"."?id=$iditem' target='_blank' >
					<img src='$imageitem' class='img-fluid'>
					<div class='caption'>
						<p id='id'>$iditem</p>
						<p id='titre'>$nomitem</p>
						<p id='prix'>$prixitem</p>
						<p align='center'>
						</a>
						<form name= '$iditem' method='POST'>
							<input type='hidden' name='IdItem' value='$iditem'>
							<input type='submit' src='images/croix.png' height='40' width='40'  onFocus='form.submit' name='delete' value='Supprimer'>
						</form>
					</div>
				</p>
				</div>
			</div>";
}



// Display the decrypted string 
//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay favoris</title>
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
			        <li class="ici"><a  class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br><br></p></div>

	<div><p><h1>MES FAVORIS</h1><br><br></p></div>

	<div class="container features">
		<div class="row">
			<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i],$hrefitem[$i]);}?>
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