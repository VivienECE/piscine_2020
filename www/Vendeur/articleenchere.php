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

$sql= "SELECT Nom, Description, Image, PrixFinal,IdEnchere, enchere.DateFin
FROM item
	join enchere ON item.IdItem = enchere.IdItem
	WHERE item.IdItem=$idItem";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Nom = $data['Nom'];
$Description = $data['Description'];
$Image = $data['Image'];
$PrixFinal = $data['PrixFinal'];
$DateFin = $data['DateFin'];
$IdEnchere = $data['IdEnchere'];}

$nom=array(); $prenom=array(); $prix=array();

$sql= "SELECT Nom, Prenom, Prix FROM offreenchere join acheteur ON offreenchere.IdAcheteur = acheteur.IdAcheteur join enchere ON enchere.IdEnchere = offreenchere.IdEnchere WHERE idItem = $idItem  ";
if($debug){echo $sql;}
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($nom,$data['Nom']);
array_push($prenom,$data['Prenom']);
array_push($prix,$data['Prix']);
}

function display_item($nom,$prenom,$prix) 
{
	echo "	<p id='titre'> Faite par $prenom $nom : <strong>$prix €</strong><br></p>";
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
	<script type="text/javascript">
	// Set the date we're counting down to
	var date = <?php echo json_encode($DateFin);?>;
	// Update the count down every 1 second
	var x = setInterval(function() 
	{
		// Get today's date and time
		var now = new Date().getTime();
		// Find the distance between now and the count down date
		var countDownDate = new Date(date).getTime();
		var distance = countDownDate - now; 

		if (distance <= 0) {document.getElementById("timer").innerHTML = "Expiré";}
		else
		{
			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			// Display the result in the element with id="timer+..."
			document.getElementById("timer").innerHTML = days + "d " + hours + "h "
			+ minutes + "m " + seconds + "s ";
		} 
	}, 1000);
	</script>
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
						      <img align="center"<?php echo "src='$Image'";?>>
						    </div>

						    <div class="carousel-item">
						      <img align="center" <?php echo "src='$Image'";?>>
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
				<h5><br> Dernière(s) enchère(s) :</h5><br>
				<div class="addScroll" align="center"> 
				<?php for($i = 0;$i < sizeof($nom);$i++){display_item($nom[$i],$prenom[$i],$prix[$i]);}?>
				</div> 
				<hr style="width: 200px;">
				<p><br><h3 id=timer></h3></p>
				<div class="row">
					<div class="col-md-12 col-md-12 col-sm-12" style="font-size: 20; font-weight: bold; text-align: center;"><a href="#"><button style="margin-left: 10px;" type="submit" class="btn"> Modifier </button></a><br></div>
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