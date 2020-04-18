<!-- Conserver ce php -->

<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
// Display the decrypted string 
session_start();
if($debug){echo "ID:".$_SESSION['IdAdmin'];}

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
			        <li class="ici"><a class="nav-link" href="accueiladmin.html">ACCUEIL</a></li>
			        <li><a class="nav-link" href="Vendeurs.php">VENDEURS</a></li>
			        <li><a class="nav-link" href="Annonces.php">ANNONCES</a></li>
			</div>
	</nav>

	<div><p><br><br><br></p></div>

	<div class="container features">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-12">
				<a href="Annonces.php"><h3 class="feature-title">Annonces<br><br><br></h3></a>
				<div id="myCarousel1" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel1" data-slide-to="1"></li>
				    <li data-target="#myCarousel1" data-slide-to="2"></li>
				  </ul>

				  <!-- Wrapper for slides -->
				  <div align="center" class="carousel-inner">
				    <div class="carousel-item active">
				      <img src="images/piece.jpg" alt="Monnaie grecque">
				    </div>

				    <div class="carousel-item">
				      <img src="images/antiquite.jpg" alt="Antiquité">
				    </div>

				    <div class="carousel-item">
				      <img src="images/montre.jpg" alt="Montre">
				    	<a href="vendeursolo.html" target="_blank" >
				      <img align="center" src="images/piece.jpg" alt="Monnaie grecque">
				    </div>

				    <div class="carousel-item">
				    <a href="vendeursolo.html" target="_blank" >
				      <img align="center" src="images/antiquite.jpg" alt="Antiquité">
				    </div>

				    <div class="carousel-item">
				    	<a href="vendeursolo.html" target="_blank" >
				      <img align="center" src="images/montre.jpg" alt="Montre">
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel1" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span></a>
				  <a class="carousel-control-next" href="#myCarousel1" data-slide="next">
				    <span class="carousel-control-next-icon"></span></a>
				</div>
			</div>

			<div class="col-lg-1 col-md-1 col-sm-0">
				<hr id="V" style="height: 300px;">
			</div>
			
			<div class="col-lg-5 col-md-5 col-sm-12">
				<a href="Vendeurs.php"><h3 class="feature-title">Vendeurs<br><br><br></h3></a>
				<div id="myCarousel2" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				    <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel2" data-slide-to="1"></li>
				    <li data-target="#myCarousel2" data-slide-to="2"></li>
				  </ul>

				  <!-- Wrapper for slides -->
				  <div align="center" class="carousel-inner">
				    <div class="carousel-item active">
				    <a href="vendeursolo.html" target="_blank" >
				      <img src="images/clem.jpg" alt="Clémence">
				    </div>

				    <div class="carousel-item">
				    	<a href="vendeursolo.html" target="_blank" >
				      <img src="images/clem.jpg" alt="Clémence">
				    </div>

				    <div class="carousel-item">
				   <a href="vendeursolo.html" target="_blank" >
				      <img src="images/clem.jpg" alt="Clémence">
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span></a>
				  <a class="carousel-control-next" href="#myCarousel2" data-slide="next">
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