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
$iditem=array(); $nomitem=array(); $imageitem=array(); $prixitem=array(); $typeitem=array(); $idachat=array();

//ITEM
$PrixTotal=0;
$sql= "SELECT item.IdItem, Nom, Image, PrixFinal, achatimmediat.IdAchatImmediat
FROM item
	join achatimmediat ON achatimmediat.IdItem = item.IdItem
    join selectionne ON achatimmediat.IdAchatImmediat = selectionne.IdAchatImmediat
    WHERE selectionne.IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($iditem,$data['IdItem']);
array_push($nomitem,$data['Nom']);
array_push($imageitem,$data['Image']);
array_push($idachat,$data['IdAchatImmediat']);
array_push($prixitem,$data['PrixFinal']);
$PrixTotal+=$data['PrixFinal'];}

//ACHETEUR
$sql= "SELECT Nom, Prenom, Adresse, CodePostal, Pays,TypeDeCarte, NumeroCarte, NomCarte, ExpirationCarte
FROM acheteur WHERE IdAcheteur=$idAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Nom = $data['Nom'];
$Prenom = $data['Prenom'];
$Adresse = $data['Adresse'];
$Pays = $data['Pays'];
$NumeroCarte = $data['NumeroCarte'];
$TypeDeCarte = $data['TypeDeCarte'];
$CodePostal = $data['CodePostal'];
$NomCarte = $data['NomCarte'];
$ExpirationCarte = $data['ExpirationCarte'];}

if (isset($_POST["confirmer"])) {
	if($debug){echo "COMMANDE:";}
	for($i=0;$i<sizeof($idachat);$i++)
	{
		$sql =  "UPDATE `item` SET `Statut` = 'Vendu!' WHERE `item`.`IdItem` = $iditem[$i] ";
		$result = mysqli_query($db_handle, $sql);
		$sql =  "DELETE FROM `selectionne` WHERE `IdAchatImmediat` = $idachat[$i] ";
		if($debug){echo "<br>".$sql."<br>";}
		$result = mysqli_query($db_handle, $sql);
		$sql =  "DELETE FROM `favoris` WHERE `IdItem` = $iditem[$i] ";
		if($debug){echo "<br>".$sql."<br>";}
		$result = mysqli_query($db_handle, $sql);
		$sql =  "INSERT INTO `commandes`(`IdItem`, `IdAcheteur`, `NomPrenom`, `Adresse`, `CP`, `Pays`, `Livraison`, `Prix`) VALUES ($iditem[$i],$idAcheteur,'$Nom $Prenom','$Adresse','$CodePostal','$Pays',CURRENT_DATE()+INTERVAL 1 WEEK,'$prixitem[$i]')";
		if($debug){echo "<br>".$sql."<br>";}
		$result = mysqli_query($db_handle, $sql);
	}
}
//Code HTML de l'affichage
function display_item($iditem,$nomitem,$imageitem,$prixitem) 
{
	echo "
<div id='paiement' class='row'>
					<div class='col-md-3 col-md-3 col-sm-12'>
						<p><img src='$imageitem' class='img-fluid'></p>
					</div>

					<div class='col-md-5 col-md-5 col-sm-12'>
						$nomitem<p id='id'>$iditem</p>
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
	<title>ECEbay paiement</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="acheteur.css">
	<script type="text/javascript">$(document).ready(function(){$('.header').height($(window).height());});</script>
</head>
<body>
	<form method="post">
	<nav class="navbar navbar-expand-md">
		<a class="navbar-brand" href="#"><img src="images/logoblanc.png" width="109" height="30"></a>
		<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
			<div class="collapse navbar-collapse" id="main-navigation">
				 <ul class="nav navbar-nav navbar-right">
			        <li><a class="nav-link" href="accueil.php">ACCUEIL</a></li>
			        <li><a class="nav-link" href="categories.php">CATEGORIES</a></li>
			        <li class="ici"><a class="nav-link" href="panier.php"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li><a  class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br></p></div>

	<div><p><h1>Votre panier</h1><br></p></div>

	<div class="container">
		
		<div class="row">
			<div class="col-md-6 col-md-6 col-sm-12">
				<?php for($i = 0;$i < sizeof($iditem);$i++){display_item($iditem[$i],$nomitem[$i],$imageitem[$i],$prixitem[$i]);}?>
			</div>

			<hr id="V" style="height: 100px;">

			<div class="col-md-5 col-md-5 col-sm-12">
				<p id="total" align="center"><br><br>Total : <?php echo "$PrixTotal";?> €</p>
			</div>
		</div>

		<div><p id="total"><br><br>Moyen de paiement</p></div>
		<hr style="width: 1100px; margin-top: 5px;">
		<div class="row">
			<div div class="col-md-6 col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-1 col-md-1 col-sm-4"><input type="radio" name="Mpaiement"></div>
					<div class="col-md-1 col-md-1 col-sm-4">
						<img align="center" src="images/visa.png" style="margin-bottom: 10px;" height="30" width="50">
						<img align="center" src="images/MC.png" height="30" width="50">
						<img align="center" src="images/AE.png" height="30" width="50">
					</div>
                
                <div class="col-md-6 col-md-6 col-sm-8">
                	<p style="margin-left: 10px; font-size: 18px; font-weight: bold; color: grey"> 
                	    <?php echo"
	                	$Prenom $Nom <br>
	                	".str_repeat('*', strlen($NumeroCarte) - 4) . substr($NumeroCarte, -4)." <br> 
	                	$ExpirationCarte <br>	"?>
                	</p>
                </div>
			</div>
		</div>

			<div div class="col-md-6 col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-1 col-md-1 col-sm-4"><input type="radio" name="Mpaiement"></div>
					<div class="col-md-1 col-md-1 col-sm-1">
					<img align="center" src="images/cheque.png" height="70" width="70">
				</div>
                
                <div style="margin-left: 20px;" class="col-md-8 col-md-8 col-sm-8">
                	<p style="font-size: 18px; font-weight: bold; color: grey;"><br> On vous remercie pour votre fidélité !<br><br><a style="color: grey" href="#">Profitez d'un chèque cadeau de 10 € !</a></p>
                </div>
				</div>
			</div>
		</div>


		<div><p id="total"><br><br>Adresse de livraison</p></div>
		<hr style="width: 1100px; margin-top: 5px;">
		<div class="row">
			<div div class="col-md-6 col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-1 col-md-1 col-sm-4"><input type="radio" name="livraison"></div>
	                <div class="col-md-6 col-md-6 col-sm-8">
	                	<p style="margin-left: 10px; font-size: 18px; font-weight: bold; color: grey"> 
	                		<?php echo"
	                		$Prenom $Nom <br>
	                	$Adresse <br> 
	                	$CodePostal <br>
	                	$Pays"?></p>
	                </div>
	                <div align="center" class="col-md-5 col-md-5 col-sm-8">
	                	<p><br><br><br><button type="button" style="color: white; font-size: 16px; font-weight: bold; background-color: #B6B6BA; border-radius: 2rem;"> Modifier </button></p>
	                </div>
				</div>
			</div>

			
				<div div class="col-md-6 col-md-6 col-sm-12">
					<div class="row">
						<div class="col-md-1 col-md-1 col-sm-4"><input type="radio" name="livraison"></div>
		                <div class="col-md-6 col-md-6 col-sm-8">
		                	<form method=post>
		                	<p style="margin-left: 10px; font-size: 18px; font-weight: bold; color: grey"> 
		                	Agnès Dupont <br>
		                	186 avenue du Coq <br> 
		                	92600 Asnières <br>
		                	France</p>
		                </div>
		                <div class="col-md-5 col-md-5 col-sm-8">
		                	<p><br><br><br><button align="center" type="button" style="color: white; font-size: 16px; font-weight: bold; background-color: #B6B6BA; border-radius: 2rem;"> Modifier </button></p></form>
		                </div>
					</div>
				</div>
			</div>
		
		<div class="row">
			<div class="col-md-12 col-md-12 col-sm-12" align="center">
            	<p><br><br><br><button type="sumbit" name="confirmer" style="color: white; font-size: 16px; font-weight: bold; background-color: #B6B6BA; border-radius: 2rem;"> Confirmer la commande </button></p></form>
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