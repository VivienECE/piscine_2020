<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = true;

//DECLARATION DES LISTES
$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array(); $hrefitem=array();$datefin=array();

//RECUPERE DANS LA BDD CHAQUE ARTICLE EN ENCHERE
$sql= "SELECT item.IdItem, Nom, Image, PrixFinal, DateFin
FROM item
	join enchere ON item.IdItem = enchere.IdItem
	WHERE Statut='En cours!'";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,"Vente aux enchères !");
array_push($hrefitem,"clicencheres.php");
array_push($datefin,$data['DateFin']);}

//Code HTML de l'affichage de chaque article
function display_item($iditem,$nomitem,$imageitem,$prixitem,$hrefitem,$i) 
{
	echo "	<div class='col-md-4 col-md-4 col-sm-12'>
				<div align='center' class='thumbnail'>
					<a href='$hrefitem"."?id=$iditem' target='_blank' ><img src=$imageitem class='img-fluid'>
					<div class='caption'>
						<p id='id'>$iditem</p>
						<p id='titre'>$nomitem</p>
						<p id='timer"."$i' style='color:red'></p>
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
	<title>ECEbay panier</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="acheteur.css">
	<script type="text/javascript">$(document).ready(function(){$('.header').height($(window).height());});</script>
	<script type="text/javascript">
	// Set the date we're counting down to
	var dates = <?php echo json_encode($datefin);?>;
	// Update the count down every 1 second
	var x = setInterval(function() 
	{
		// Get today's date and time
		var now = new Date().getTime();
		for(i=0;i<3;i++)
		{
			// Find the distance between now and the count down date
			var countDownDate = new Date(dates[i]).getTime();
			var distance = countDownDate - now; 
			if (distance <= 0) {document.getElementById("timer"+i).innerHTML = "Expiré";}
			else
			{
				// Time calculations for days, hours, minutes and seconds
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				// Display the result in the element with id="timer+..."
				document.getElementById("timer"+i).innerHTML = days + "d " + hours + "h "
				+ minutes + "m " + seconds + "s ";
			} 
		}
	}, 1000);
	</script>

</head>
<body>
	<script src="time.js"></script>
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
	<div><p><br><h1>VENTES AUX ENCHERES</h1><br><br></p></div>

	<div class="container features">
		<div class="row">
			<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i],$hrefitem[$i],$i);}?>

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
