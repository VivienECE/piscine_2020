<?php
//identifier votre BDD
$database = "ecebay";
$uploaddir='../items/images/';
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = true;
session_start();
$IdVendeur=$_SESSION['IdVendeur'];
function get_file_extension($file) {
return substr(strrchr($file,'.'),1);
}
$erreur = "";

if (isset($_POST["button"]))
{
	if($debug){echo "VENTE:"."<br>";}
	if ($db_found) 
	{
			
		if(isset($_POST["categorie"])&&isset($_POST["vente"]))
		{
			
			$titre = htmlspecialchars($_POST["titre"]);
			$description = htmlspecialchars($_POST["description"]);
			$prix = htmlspecialchars($_POST["prix"]);
			//$video = htmlspecialchars($_POST["video"]);
			$categorie = htmlspecialchars($_POST["categorie"]);
			$typevente = htmlspecialchars($_POST["vente"]);
			$uploadfile = $uploaddir . basename($_FILES['image']['name']);
			$image = $_FILES['image']['name']; //chemin d'accès à l'image
			if($debug){echo $image."-".$uploadfile ;}
			//si aucune image de selectionnée, ajoute dans la bdd avec une image par défaut
			if(get_file_extension($image)!="jpg"&&get_file_extension($image)!="png"&&get_file_extension($image)!="PNG"&&get_file_extension($image)!="JPG")
			{
			   $erreur = "Mauvais format d'image";
			   if($debug){echo $erreur;}
			}
			//Deplace l'image dans nos fichiers www/vendeur/images, si succès: Ajout du reste des infos dans la BDD, redirection à l'acceuil
			else if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) 
			{
				$sql= "SELECT (MAX(IdItem)+1) as nb FROM item"; //Selectionne l'id max et rajoute+1 = futur IdItem attribué automatiquement pb en cas de suppression d'item mais pas de suppr de prévu
				$result=mysqli_query($db_handle, $sql);
				$nom_image = $uploaddir . 'item_'. (mysqli_fetch_assoc($result)['nb']) ."." . get_file_extension($image); 
				rename($uploadfile,$nom_image);
			    $sql= "INSERT INTO item (`idvendeur`,`Nom`, `Description`, `Categorie`, `Statut`, `Image`, `Video`,`PrixInitial`,`Date`) VALUES ($IdVendeur,'$titre','$description','$categorie','En cours!','$nom_image','','$prix',CURRENT_DATE)";
				$result = mysqli_query($db_handle, $sql);
			    if($debug){echo $sql;}
			} //Le dernier probleme est que l'image est trop volumineuse et ne ce charge pas.
			else 
			{
			   $erreur = "Image trop volumineuse";
			   if($debug){echo $erreur;}
			}
		}
	}
	else{echo $erreur="database not found";}
}
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
				 	<li><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			        <li><a class="nav-link" href="mesventes.php">MES VENTES</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br><br></p></div>
	<form method='post' enctype="multipart/form-data">
	<div><p><h1>Nouvelle vente</h1><br><br></p></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-0"></div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="thumbnail">
					<a href="#"><img id="profil" src="images/ajout1.png" style="width: 100px; height: 100px"></a><br><br>
						<!--IMAGE ARTICLE -->
							<input type="hidden" name="MAX_FILE_SIZE" value="80000" />  <!--Apparament taille max de l'image en ko? -->
							<input type="file" name="image" accept="image/gif, image/jpeg, image/png" onchange="loadImg(event)"> 
							<script>
							  var loadImg = function(event) {
							    var output = document.getElementById('profil');
							    output.src = URL.createObjectURL(event.target.files[0]);
							    output.onload = function() {
							      URL.revokeObjectURL(output.src) // free memory
							    }
							  };
							</script>
							<!--IMAGE DU PROFIL -->
				</div>

				<div class="thumbnail">
					<a href="#"><img id='video' src="images/ajout2.png" style="width: 100px; height: 100px"><br></a>
					<!--VIDEO ARTICLE -->
							<input type="hidden" name="MAX_FILE_SIZE" value="30000" />  <!--Apparament taille max de l'image en ko? -->
							<input type="file" name="video" accept="image/gif, image/jpeg, image/png" onchange="loadVideo(event)"> 
							<script>
							  var loadVideo = function(event) {
							    var output = document.getElementById('video');
							    output.src = URL.createObjectURL(event.target.files[0]);
							    output.onload = function() {
							      URL.revokeObjectURL(output.src) // free memory
							    }
							  };
							</script>
						<!--IMAGE DU PROFIL -->
				</div>
			</div>
			
			<div  style="color: #C4BDE3; font-weight: bold;" class="col-lg-6 col-md-6 col-sm-12">
					<table>
						<td>
							<tr>Titre : <input type="text" name="titre" required></tr><br>
							<tr>N° de vente : 7480392</tr><br><br>
							<tr><input style="border-radius: 0rem; height: 100px; width: 500px" type="text" name="description" placeholder="  Ajoutez une description" required></tr>
						</td>
					</table>
			</div>
		</div>

		<div><p><br><br></p></div>

		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-0"></div>
			<div class="col-lg-5 col-md-5 col-sm-6">
				<h4>Catégorie</h4>
				<table align="center" style="color: grey; font-weight: bold;">
					<td>
						<br><input type= "radio" name="categorie" value="tresor"> Féraille ou Trésor <br>
					
						<input type= "radio" name="categorie" value="musee"> Musée <br>
						
						<input type= "radio" name="categorie" value="accessoire"> Accessoire VIP<br>
					</td>
				</table>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-6"  class="checkbox-group required">
				<h4>Type de vente</h4>
				<table align="center" style="color: grey; font-weight: bold;">
					<td>
						<br><input type= "radio" name="vente" value="enchere"  > Enchères <br>
					
						<input type= "radio" name="vente" value="achatimmediat"> Immédiate   <input type="number" name="prix" style="width: 75px;" min="0" required> €<br>
						
						<input type= "radio" name="vente" value="meilleureoffre"> Meilleure offre <br>
					</td>
				</table>
			</div>
		</div>

		<div class="row">
			<div align="center" class="col-lg-12 col-md-12 col-sm-12">
				<div><p><br><br><br></p></div>
				<a href="#"><button type="submit" name="button" class="btn">Mettre en ligne</button></a>
				<? php echo $erreur ?>	
			</div>
		</div>
	</div>

	</form>
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