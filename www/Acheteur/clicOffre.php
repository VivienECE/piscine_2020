<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
$idItem = $_GET['id']; 
session_start();
$IdAcheteur=$_SESSION['IdAcheteur'];
$msg="";

$sql= "SELECT IdVendeur, Nom, Description, Image, PrixFinal, IdMeilleureOffre
FROM item
	join meilleureoffre ON item.IdItem = meilleureoffre.IdItem
	WHERE item.IdItem=$idItem";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$IdVendeur = $data['IdVendeur'];
$Nom = $data['Nom'];
$Description = $data['Description'];
$Image = $data['Image'];
$PrixFinal = $data['PrixFinal'];
$IdMeilleureOffre = $data['IdMeilleureOffre'];}
if($debug){echo "debug:true";}

if (isset($_POST["button"])) {
	if($debug){echo "<br>"."button";}
	$prix = htmlspecialchars($_POST["enchere"]);
	$sql="SELECT * from `negocie` WHERE IdAcheteur=$IdAcheteur AND IdMeilleureOffre=$IdMeilleureOffre";
	if($debug){echo "<br>".$sql;}
	$result=mysqli_query($db_handle, $sql);
	if (mysqli_num_rows($result) == 0)
	{
		$sql="INSERT INTO `negocie`( `IdVendeur`, `IdAcheteur`, `IdMeilleureOffre`, `EtapeNegociation`, `prix`) VALUES ($IdVendeur,$IdAcheteur,$IdMeilleureOffre, 1, $prix)";
		if($debug){echo "<br>".$sql;}
		$result=mysqli_query($db_handle, $sql);
		$msg="Proposition envoyée";
	}else{$msg="Veuillez attendre la réponse du vendeur";}
	
}
//Si on appuie sur le bouton favoris
if (isset($_POST["favoris"]))
{
	$sql="SELECT `IdAcheteur`, `IdItem` from `favoris` WHERE IdAcheteur=$IdAcheteur AND IdItem=$idItem";
	$result=mysqli_query($db_handle, $sql);
	if (mysqli_num_rows($result) == 0)
	{
		$sql = "INSERT  INTO `favoris` (`IdAcheteur`, `IdItem`) VALUES ($IdAcheteur, $idItem)";
		if($debug){echo "<br>".$sql;}
		$result=mysqli_query($db_handle, $sql);
	}
}
//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay article</title>
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
			        <li><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br><br></p></div>

	<div class="container features">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div align="center" id="myCarousel1" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel1" data-slide-to="1"></li>
				    <li data-target="#myCarousel1" data-slide-to="2"></li>
				  </ul>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <img align="center" <?php echo "src='$Image'";?>>
				    </div>

				    <div class="carousel-item">
				      <img align="center" src="images/antiquite.jpg">
				    </div>

				    <div class="carousel-item">
				      <img align="center" src="images/antiquite.jpg">
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel1" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span></a>
				  <a class="carousel-control-next" href="#myCarousel1" data-slide="next">
				    <span class="carousel-control-next-icon"></span></a>
				</div>
			</div>

			<div class="col-md-7 col-md-7 col-sm-11">
				<p>
					<h4><?php echo "$Nom";?></h4><br>
					<?php echo "$idItem";?><br><br>
					<?php echo "$Description";?> <br> 
				</p>
			</div>

			<form name= "1" method="POST">
				<div class="col-md-1 col-md-1 col-sm-1">
					<!--
					<a class="fav" href="#"><img src="images/favoris.png" width="30" height="30"></a>-->
					<input type="hidden" name="favoris" value="add">
					<input type='image' src="images/favoris.png" width="30" height="30" onFocus='form.submit' name='favoris'/>
				</div>
			</form>
		</div>
		
		<hr style="width: 500px;">

		<div class="row">
			<div align="center" class="col-md-12 col-md-12 col-sm-12">
				<p><br><h3>Proposez une offre au vendeur !</h3></p>
			</div>
		</div>

		<div class="row">
			<div align="center" class="col-md-10 col-md-10 col-sm-10">
				<form method="post">
				<br><p style="font-weight: bold; font-size: 22px; color: grey;">Votre offre : <input type="number" style="width: 60px;" name="enchere" required>  €</p>
				<?php echo "$msg";?>
			</div>
			<div align="right" class="col-md-2 col-md-2 col-sm-2">
				<br><br><br><a href="#"><button type="submit" name="button"class="btn"> Envoyer au vendeur</button></a>
			</form>
			</div>
		</div>
	</div>

	<div><p><br></p></div>

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