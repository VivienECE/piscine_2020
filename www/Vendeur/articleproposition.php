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
$IdVendeur=$_SESSION['IdVendeur'];

$sql= "SELECT Nom, Description, Image, PrixFinal,IdMeilleureOffre
FROM item
	join meilleureoffre ON item.IdItem = meilleureoffre.IdItem
	WHERE item.IdItem=$idItem";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Nom = $data['Nom'];
$Description = $data['Description'];
$Image = $data['Image'];
$PrixFinal = $data['PrixFinal'];
$IdEnchere = $data['IdMeilleureOffre'];}

$nom=array(); $prenom=array(); $prix=array();

$sql= "SELECT Nom, Prenom, Prix FROM negocie join acheteur ON negocie.IdAcheteur = acheteur.IdAcheteur join meilleureoffre ON meilleureoffre.Idmeilleureoffre = negocie.Idmeilleureoffre WHERE idItem = $idItem  ";
if($debug){echo $sql;}
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($nom,$data['Nom']);
array_push($prenom,$data['Prenom']);
array_push($prix,$data['Prix']);
}

function display_item($nom,$prenom,$prix) 
{
	echo "	<p id='titre'> 
						$prenom $nom vous a proposé : <strong>$prix €</strong><br>
						<form method='post'>
						<a href='#''><img src='images/yes.png' width='30' height='30'></a>
						<a href='#''><img src='images/no.png' width='30' height='30'></a>
						<br>
						Contre-offre : <input style='width: 75px' type='text' name='contre'> € 
						 <input type='submit' class='submit3' alt='Submit button' name='button3' value='' />
						</form>
					</p>
					<div class='row'>
						<hr style='width: 200px; margin-top: 30px;'>
					</div>";
}
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
				 	<li><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			        <li class="ici"><a class="nav-link" href="mesventes.php">MES VENTES</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br><br></p></div>

	<div class="container features">
		<div class="row">
			<div class="col-md-7 col-md-7 col-sm-12">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
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
						      <img align="center" src="images/montre.jpg">
						    </div>

						    <div class="carousel-item">
						      <img align="center" src="images/montre.jpg">
						    </div>
						  </div>

						  <!-- Left and right controls -->
						  <a class="carousel-control-prev" href="#myCarousel1" data-slide="prev">
						    <span class="carousel-control-prev-icon"></span></a>
						  <a class="carousel-control-next" href="#myCarousel1" data-slide="next">
						    <span class="carousel-control-next-icon"></span></a>
						</div>
					</div>
			
					<div class="col-md-6 col-md-6 col-sm-12">
						<p>
							<h4><?php echo "$Nom";?></h4><br>
							<?php echo "$idItem";?><br><br>
							<?php echo "$Description";?> <br> 
						</p>
					</div>
				</div>
				<div class="row">
					<div align="center" class="col-lg-12 col-md-12 col-sm-12">
						<div><p><br><br><br></p></div>
						<a href="#"><button type="submit" class="btn">SUPPRIMER</button></a>
					</div>
				</div>
			</div>

			<div class="col-md-1 col-md-1 col-sm-0">
				<hr id="V" style="height: 300px;">
			</div>

			<div class="col-md-4 col-md-4 col-sm-12" style="background-color: #EFF8FF; border-radius: 3rem; box-shadow: rgba(0,0,0,0.4) 2px 2px;">
				<h5><br> Proposition(s) :</h5><br>
				<div class="addScroll2" align="center">
					<?php for($i = 0;$i < sizeof($nom);$i++){display_item($nom[$i],$prenom[$i],$prix[$i]);}?>
				</div> 
			</div>
		</div>
	</div>


	<div><p><br><br><br></p></div>

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