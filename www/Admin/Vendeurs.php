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

$idVendeur=array(); $idUtilisateur=array(); $nomVendeur=array(); $prenomVendeur=array(); $photoVendeur=array(); $fondVendeur=array(); $hrefVendeur=array(); $nbItem=array(); 

$sql= "SELECT vendeur.IdVendeur, Nom, Prenom, ImageProfil, ImageFond
FROM vendeur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($idVendeur,$data['IdVendeur']);
array_push($prenomVendeur,$data['Prenom']);
array_push($nomVendeur,$data['Nom']);
array_push($photoVendeur,$data['ImageProfil']);
array_push($fondVendeur,$data["ImageFond"]);
array_push($hrefVendeur,"vendeursolo.php");
}

for($i = 0;$i < sizeof($idVendeur);$i++)
	{
		$sqlItem="SELECT COUNT(*) as ventes FROM 'item' WHERE IdVendeur=$idVendeur[$i]"; //REQUETE
		$result=mysqli_query($db_handle, $sqlItem); //EXECUTION DE LA REQUETE
		array_push($nbItem,mysqli_fetch_assoc($result)["Ventes"]); //RECUPERE LE NB D'ITEM
	}

//barre de recherche

$recherche = isset($_POST["recherche"])? $_POST["recherche"] : "";
if(isset($_POST["recherche"])){
	if($db_found){
		$sql = "SELECT * FROM vendeur WHERE Nom OR Prenom LIKE '%$recherche%'";
		
		$result = mysqli_query($db_handle, $sql);
		ob_end_clean();
		//regarder s'il y a des résultats
		if(mysqli_num_rows($result) != 0){
			echo "<div class='col-md-4 col-md-4 col-sm-12'>
					<br><br><h5>Aucun vendeur ne correspond à votre recherche.<br>
					</div>";
		}else{
			while($data = mysqli_fetch_assoc($result)){
				display_item($iditem,$nomitem,$imageitem,$prixitem,$hrefitem);
			}
		}

}else{
	echo "Database not found.";
}

}


//Code HTML de l'affichage
function display_item($idVendeur,$nomVendeur,$prenomVendeur,$idUtilisateur,$hrefVendeur, $nbItem, $photoVendeur) 
{
	echo "	<div class='col-md-4 col-md-4 col-sm-12'>
				<div align='center' class='thumbnail'>
					<a href='$hrefVendeur"."?id=$idVendeur'><img src=$photoVendeur class='img-fluid'>
					<div class='caption'>
						<p id='titre'>$prenomVendeur $nomVendeur</p>
						<p id='id'>$idUtilisateur</p>
						<p id='prix'>$nbItem</p>
						</div></a>
				</div>
			</div>";
}

// Display the decrypted string 
ob_start();

//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay Vendeurs</title>
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
				 	<li><a class="nav-link" href="accueiladmin.php">ACCUEIL</a></li>
			        <li class="ici"><a class="nav-link" href="Vendeurs.php">VENDEURS</a></li>
			        <li><a class="nav-link" href="Annonces.php">ANNONCES</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><h1>VENDEURS</h1><br></p></div>

	<div class="container features">
		<div class="row">
			<div class="col-md-3 col-md-3 col-sm-0"></div>
			<form method="post">
		      <input type="text" placeholder="  Rechercher..." name="recherche" style="width: 500px;">
		      <button name="recherche" class="btn" type="submit"><img src="images/loupe.png" width="20" height="20"></span></button><br><br>
			</form>
		</div>
		<div class="row"> <!--AFFICHAGE DE TT LES ARTICLES CATEGORIE ACESSOIRE DEPUIS LA BDD-->
					<?php for($i = 0;$i < sizeof($idVendeur);$i++){display_item($idVendeur[$i],$nomVendeur[$i],$prenomVendeur[$i],$idUtilisateur[$i],$hrefVendeur[$i], $nbItem[$i], $photoVendeur[$i]) ;}?>

		</div></div>
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