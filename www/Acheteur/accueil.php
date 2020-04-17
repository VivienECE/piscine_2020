<!-- Conserver ce php -->

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
$EnchereIdItem=array(); $EncherePrix=array(); $EnchereDate=array(); $EnchereNom=array();$EnchereImage=array();$EnchereCategorie=array();

$sql= "SELECT IdItem,PrixFinal,DateFin FROM enchere";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($EnchereIdItem,$data['IdItem']);
array_push($EncherePrix,$data['PrixFinal']);
array_push($EnchereDate,$data['DateFin']);}

for($i = 0;$i < sizeof($EnchereIdItem);$i++)
{
	$sql= "SELECT Nom,Image,Categorie FROM item where IdItem=".$EnchereIdItem[$i];
	$result = mysqli_query($db_handle, $sql);
	while ($data = mysqli_fetch_assoc($result)){
		array_push($EnchereNom,$data['Nom']);
		array_push($EnchereImage,$data['Image']);
		array_push($EnchereCategorie,$data['Categorie']);}
}

//IMMEDIAT
$ImmediatIdItem=array(); $ImmediatPrix=array(); $ImmediatDate=array(); $ImmediatNom=array();$ImmediatImage=array();$ImmediatCategorie=array();

$sql= "SELECT IdItem,PrixFinal,DateFin FROM achatimmediat";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($ImmediatIdItem,$data['IdItem']);
array_push($ImmediatPrix,$data['PrixFinal']);
array_push($ImmediatDate,$data['DateFin']);}

for($i = 0;$i < sizeof($ImmediatIdItem);$i++)
{
	$sql= "SELECT Nom,Image,Categorie FROM item where IdItem=".$ImmediatIdItem[$i];
	$result = mysqli_query($db_handle, $sql);
	while ($data = mysqli_fetch_assoc($result)){
		array_push($ImmediatNom,$data['Nom']);
		array_push($ImmediatImage,$data['Image']);
		array_push($ImmediatCategorie,$data['Categorie']);}
}

//OFFRE
$OffreIdItem=array(); $OffrePrix=array(); $OffreDate=array(); $OffreNom=array();$OffreImage=array();$OffreCategorie=array();

$sql= "SELECT IdItem,PrixFinal,DateFin FROM meilleureoffre";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($OffreIdItem,$data['IdItem']);
array_push($OffrePrix,$data['PrixFinal']);
array_push($OffreDate,$data['DateFin']);}

for($i = 0;$i < sizeof($OffreIdItem);$i++)
{
	$sql= "SELECT Nom,Image,Categorie FROM item where IdItem=".$OffreIdItem[$i];
	$result = mysqli_query($db_handle, $sql);
	while ($data = mysqli_fetch_assoc($result)){
		array_push($OffreNom,$data['Nom']);
		array_push($OffreImage,$data['Image']);
		array_push($OffreCategorie,$data['Categorie']);}
}

// Display the decrypted string 
session_start();

function display_item($Nom,$Image,$Prix) 
{
	echo  "
		  <div class='carousel-inner'>
		       <div class='carousel-item active'>
		       <span> <br>$Nom[0] </span>
		      <img src='$Image[0]' >
			  <span> $Prix[0] € </span>
		    </div>

		       <div class='carousel-item'>
		       <span> <br>$Nom[1] </span>
		      <img src='$Image[1]';>
			  <span> $Prix[1] € </span>
		    </div>
		    <div class='carousel-item'>
		       <span> <br>$Nom[2] </span>
		      <img src='$Image[2]' >
			  <span> $Prix[2] € </span>
		    </div>
		  </div>";
}

//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay accueil</title>
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
			        <li class="ici"><a class="nav-link" href="accueil.html">ACCUEIL</a></li>
			        <li><a class="nav-link" href="categories.html">CATEGORIES</a></li>
			        <li><a class="nav-link" href="panier.html"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="favoris.html"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="moncompte.html">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br><br></p></div>

	<div class="container features">
		<div class="row">
			<!-- ENCHERE -->
			<div class="col-lg-4 col-md-4 col-sm-12">
				<h3 class="feature-title">Ventes aux enchères<br><br><br><br></h3>
				<div id="myCarousel1" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel1" data-slide-to="1"></li>
				    <li data-target="#myCarousel1" data-slide-to="2"></li>
				  </ul>

				  <!-- Wrapper for slides -->
				<?php display_item($EnchereNom,$EnchereImage,$EncherePrix);?>

				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel1" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span>
				  <a class="carousel-control-next" href="#myCarousel1" data-slide="next">
				    <span class="carousel-control-next-icon"></span>
				  </a>
				</div>
			</div>
			<!-- IMMEDIAT -->
			<div class="col-lg-4 col-md-4 col-sm-12">
				<h3 class="feature-title">Ventes immédiates<br><br><br><br></h3>
				<div id="myCarousel2" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				    <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel2" data-slide-to="1"></li>
				    <li data-target="#myCarousel2" data-slide-to="2"></li>
				  </ul>

				  <!-- Wrapper for slides -->
				  	<?php display_item($ImmediatNom,$ImmediatImage,$ImmediatPrix);?>

				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span>
				  <a class="carousel-control-next" href="#myCarousel2" data-slide="next">
				    <span class="carousel-control-next-icon"></span>
				  </a>
				</div>
			</div>

			<!-- OFFRES -->
			<div class="col-lg-4 col-md-4 col-sm-12">
				<h3 class="feature-title">Meilleures offres<br><br><br><br></h3>
				<div id="myCarousel3" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				    <li data-target="#myCarousel3" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel3" data-slide-to="1"></li>
				    <li data-target="#myCarousel3" data-slide-to="2"></li>
				  </ul>

				  <!-- Wrapper for slides -->
				 	<?php display_item($OffreNom,$OffreImage,$OffrePrix);?>

				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel3" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span>
				  <a class="carousel-control-next" href="#myCarousel3" data-slide="next">
				    <span class="carousel-control-next-icon"></span>
				  </a>
				</div>
			</div>
	</div>

	<div><p><br><br><br></p></div></div>

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