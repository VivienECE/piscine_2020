<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
session_start();
$idAcheteur = $_SESSION['IdAcheteur'];
$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array(); $typeitem=array();

if (isset($_POST["delete"])) {
	$IdItem = htmlspecialchars($_POST["IdItem"]);
	$sql = "SELECT IdSelectionne FROM `selectionne` 
	join achatimmediat ON achatimmediat.IdAchatImmediat = selectionne.IdAchatImmediat
	WHERE IdAcheteur=$idAcheteur AND IdItem=$IdItem ";
	$result = mysqli_query($db_handle, $sql);
	$sql = "DELETE FROM `selectionne` WHERE IdSelectionne=".mysqli_fetch_assoc($result)["IdSelectionne"] ;
	if($debug){echo "<br>".$sql;}
	//$result = mysqli_query($db_handle, $sql);
	if(!mysqli_query($db_handle, $sql))
	{
		$sql = "SELECT IdNegociation FROM `negocie` 
		join meilleureoffre ON MeilleureOffre.IdMeilleureOffre = negocie.IdMeilleureOffre
		WHERE IdAcheteur=$idAcheteur AND IdItem=$IdItem ";
		if($debug){echo "<br>".$sql;}
		$result = mysqli_query($db_handle, $sql);
		$sql = "DELETE FROM `negocie` WHERE IdNegociation=".mysqli_fetch_assoc($result)["IdNegociation"] ;
		if(!mysqli_query($db_handle, $sql))
		{
			$sql = "SELECT IdOffre FROM `offreenchere` 
			join enchere ON enchere.IdEnchere = offreenchere.IdEnchere
			WHERE IdAcheteur=$idAcheteur AND IdItem=$IdItem ";
			if($debug){echo "<br>".$sql;}
			$result = mysqli_query($db_handle, $sql);
			$sql = "DELETE FROM `offreenchere` WHERE IdOffre=".mysqli_fetch_assoc($result)["IdOffre"] ;
			$result = mysqli_query($db_handle, $sql);
		}
	}
	
}
$PrixTotal=0;
$sql= "SELECT item.IdItem, Nom, Image, PrixFinal
FROM item
	join achatimmediat ON achatimmediat.IdItem = item.IdItem
    join selectionne ON achatimmediat.IdAchatImmediat = selectionne.IdAchatImmediat
    WHERE selectionne.IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem,$data['PrixFinal']);
$PrixTotal+=$data['PrixFinal'];}

$sql= "SELECT item.IdItem, Nom, Image, Prix
FROM item
	join enchere ON enchere.IdItem = item.IdItem
    join offreenchere ON enchere.IdEnchere = offreenchere.IdEnchere
    WHERE offreenchere.IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem, "Votre offre sur cette enchere est de ".$data['Prix']);}

$sql= "SELECT item.IdItem, Nom, Image, Prix
FROM item
	join meilleureoffre ON MeilleureOffre.IdItem = item.IdItem
    join negocie ON MeilleureOffre.IdMeilleureOffre = negocie.IdMeilleureOffre
    WHERE negocie.IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($prixitem, "Proposition en attente. Vous avez proposé ".$data['Prix']);}



//Code HTML de l'affichage
function display_item($iditem,$nomitem,$imageitem,$prixitem) 
{
	echo "	<div class='row'>
			<div class='col-md-3 col-md-3 col-sm-12'>
				<p id='panier'><img src='$imageitem' class='img-fluid'></p>
			</div>

			<div class='col-md-5 col-md-5 col-sm-12'>
				$nomitem<p id='id'>$iditem</p>
				<form method='post'>
					<input type='hidden' name='IdItem' value=$iditem />
					<button type='submit' name='delete' class='btn'> Supprimer </button>
				</form>
			</div>

			<div class='col-md-2 col-md-2 col-sm-3'>
				<p style='color: grey; font-weight: bold; text-shadow: rgba(0,0,0,0.4) 1px 1px; text-align: center; '>$prixitem €</p>
			</div>	
		</div>
";
}

// Display the decrypted string 
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
	<script type="text/javascript">$(document).ready(function(){$('.header').height($(window).height());});
	function myFunction() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(e) {
	  if (!e.target.matches('.dropbtn')) {
	  var myDropdown = document.getElementById("myDropdown");
	    if (myDropdown.classList.contains('show')) {
	      myDropdown.classList.remove('show');
	    }
	  }
	}</script>
</head>
<body>
	<nav class="navbar navbar-expand-md">
		<a class="navbar-brand" href="#"><img src="images/logoblanc.png" width="109" height="30"></a>
		<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
			<div class="collapse navbar-collapse" id="main-navigation">
				 <ul class="nav navbar-nav navbar-right">
			        <li><a class="nav-link" href="accueil.php" style="padding-top: 14px;">ACCUEIL</a></li>
			        
			        <li><div class="dropdown">
  							<button class="dropbtn" onclick="myFunction()">CATEGORIES</button></li>
							<div class="dropdown-content" id="myDropdown">
								
								<ul id="prix">
							  		<li><a href="enchere.php">Enchères</a></li>
									<li><a href="achatimmediat.php">Achats</a></li>
						  			<li><a href="meilleureoffre.php">Offres</a></li>
						  		</ul>
								
						  		<ul id="prix">
						  			<li><a href="tresors.php">Ferraille et trésors</a></li>
						  			<li><a href="musee.php">Musée</a></li>
						  			<li><a href="accessoires.php">Accessoire VIP</a></li>
								</ul>
							</div>
						</div>
					
			        <li style="list-style: none;"><a class="nav-link" href="panier.php"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li style="list-style: none;"><a class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li class="ici" style="list-style: none;"><a  class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>
	

		<div><p><br><br><br><h1>VOTRE PANIER</h1><br><br></p></div>
		<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i]);}?>

		<div class="row">
			<div class="col-md-3 col-md-3 col-sm-3"><p></p></div>	
			<div class="col-md-6 col-md-6 col-sm-6">
 					<hr>
			</div>
			<div class="col-md-3 col-md-3 col-sm-3"><p></p></div>
		</div>

		<div class="row">
			<div class="col-md-3 col-md-3 col-sm-3"><p></p></div>
			<div class="col-md-6 col-md-6 col-sm-6">
				<p id="total" align="center"><br><?php echo "Total : ".$PrixTotal." €"?></p>
			</div>
			<div class="col-md-3 col-md-3 col-sm-6">
				<br><br><a href="paiement.php"><button type="button" class="btn">Passer à la commande</button></a>
			</div>
		</div>
	</div>

	<div><br></div>

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