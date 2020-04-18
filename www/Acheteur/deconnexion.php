<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
session_start();
$id=$_SESSION['IdAcheteur'];
if($debug){echo "ID:".$_SESSION['IdAcheteur'];}

$sql= "SELECT Prenom, Nom FROM acheteur WHERE IdAcheteur=$id ";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
 $prenom = $data['Prenom'];
 $nom = $data['Nom'];}

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
			        <li><a class="nav-link" href="accueil.html">ACCUEIL</a></li>
			        <li><a class="nav-link" href="categories.html">CATEGORIES</a></li>
			        <li><a class="nav-link" href="panier.html"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="favoris.html"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li class="ici"><a  class="nav-link" href="moncompte.html">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br></p></div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-md-3 col-sm-1"><p></p></div>
			<div align="center" class="col-md-5 col-md-5 col-sm-12" style="background-image: url(images/tableau.jpg); border-radius: 1.5rem ">
				<p><br><br><br><br><br><br><br><br><br><br><br><br><br></p>
				<p><button type="button" style="color: white; font-size: 16px; font-weight: bold; background-color: #C4BDE3; border-radius: 2rem;">A très bientôt <?php echo "$prenom $nom";?> !</button><br><br></p>
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