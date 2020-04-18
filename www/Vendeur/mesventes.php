<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = true;

$iditem=array(); $nomitem=array(); $imageitem=array(); $etatitem=array(); $hrefitem=array();



$sql= "SELECT item.IdItem, Nom, Image, Statut
FROM item
join achatimmediat ON item.IdItem = achatimmediat.IdItem ";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($etatitem,$data['Statut']);
array_push($hrefitem,"articleimmediat");
}

$sql= "SELECT item.IdItem, Nom, Image, Statut
FROM item
join enchere ON item.IdItem = enchere.IdItem ";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($etatitem,$data['Statut']);
array_push($hrefitem,"articleenchere.php");
}

$sql= "SELECT item.IdItem, Nom, Image, Statut
FROM item
join meilleureoffre ON item.IdItem = meilleureoffre.IdItem ";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($etatitem,$data['Statut']);
array_push($hrefitem,"articleproposition.php");
}


//Code HTML de l'affichage
function display_item($iditem,$nomitem,$imageitem,$etatitem,$hrefitem) 
{
	echo "	<div class='col-md-4 col-md-4 col-sm-12'>
				<div align='center' class='thumbnail'>
					<a href='$hrefitem"."?id=$iditem' target='_blank' ><img src=$imageitem class='img-fluid'>
					<div class='caption'>
						<p id='id'>$iditem</p>
						<p id='titre'>$nomitem</p>
						<p id='prix'>$etatitem</p>
						</div></a>
				</div>
			</div>";
}

// Display the decrypted string 
session_start();

//fermer la connexion
mysqli_close($db_handle);?><!DOCTYPE html>

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

	<div><p><br><br></p></div>

	<div><p><h1>Mes ventes</h1><br></p></div>

	<div class="container features">
		<div class="row">
			<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$etatitem[$i],$hrefitem[$i]);}?>
		</div>
		<div class="row">
			<div align="center" class="col-md-12 col-md-12 col-sm-12">
				<hr style="width: 400px; margin-bottom: 20px;">
				<a href="nouvellevente.php"><h3>Nouvelle vente</h3></a>	
				<hr style="width: 400px; margin-top: 20px;">
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