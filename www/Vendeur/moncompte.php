<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
session_start();
$id=$_SESSION['IdVendeur'];
if($debug){echo "ID:".$_SESSION['IdVendeur'];}

$sql= "SELECT Prenom, Nom, ImageFond, ImageProfil FROM vendeur WHERE IdVendeur=$id ";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
 $Prenom = $data['Prenom'];
 $Nom = $data['Nom'];
 $ImageFond = $data['ImageFond'];
 $ImageProfil = $data['ImageProfil'];}

if($debug){echo $sql;}
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
	<link rel="stylesheet" type="text/css" href="vendeur.css">
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
				 	<li class="ici"><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			        <li><a class="nav-link" href="mesventes.php">MES VENTES</a></li>
			     </ul>
			</div>
	</nav>
	<div><p><br><br></p></div>

	<div><p><h1>VOTRE COMPTE</h1><br></p></div>

	<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-4 col-sm-12">
			<div class="row">
				<div class="col-md-6 col-md-6 col-sm-6">
					<img align="center" src=<?php echo "'$ImageProfil'"; ?> height="100" width="100">
				</div>
				<div class="col-md-6 col-md-6 col-sm-6" style="font-weight: bold; font-size: 14px; color: #C4BDE3">
					<p><br>Bonjour<br><?php echo "$Prenom $Nom" ?></p>
				</div>
			</div>
			<div class="row">
				<div class="menu">
			 		<a href="mesInfos.php">Mes informations</a>
					<a href="aide.php">Aide</a>
					<a href="../autres/login.php">Deconnexion</a>
				</div>
			</div>
		</div> <!-- <php echo "'$ImageFond'"; ?> -->
		<div class="col-md-2 col-md-2 col-sm-12"></div>
		<div class="col-md-5 col-md-5 col-sm-12" style="background-image: url("<?php echo "$ImageFond"; ?>"); border-radius: 2rem ">
			<p><br>                <button type="button" style="color: white; font-size: 16px; font-weight: bold; background-color: #C4BDE3; border-radius: 2rem;">BIENVENUE SUR VOTRE COMPTE</button></p>
			<p><br><br><br><br><br><br><br><br><br><br><br><br><br></p>
			<p><a href="#"><img  style="background-color: lightgrey;" src="images/modifier.png" width="20" height="20"><br><br></a></p>
		</div>
	</div></div>

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