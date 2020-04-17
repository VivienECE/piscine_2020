<?php
//identifier votre BDD
$database = "ecebay";
$uploaddir = '../vendeur/images/';
function get_file_extension($file) {
return substr(strrchr($file,'.'),1);
}
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$doublon = false;
$debug = false;

//Recupération des données du formulaires
if (isset($_POST["button"])) {
		$pseudo = htmlspecialchars($_POST["pseudo"]);
		$motdepasse = sha1($_POST["motdepasse"]);
		$email = htmlspecialchars($_POST["email"]);
		
		if ($db_found) {

			//Verification doublon table utilisateur
			$sql = "SELECT pseudo FROM utilisateur WHERE pseudo = '$pseudo'";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) != 0) {
			$erreur = "Nom d'utilisateur déja utilisé.";
			$doublon = true;
			}

			$sql = "SELECT email FROM utilisateur WHERE email = '$email'";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) != 0) {
			$erreur ="Email déja utilisé.";
			$doublon = true;
			}
			
			//Si aucun doublon (pseudo/mail), ajout dans la BDD utilisateur et vendeur
			if (!$doublon) {
				$uploadfile = $uploaddir . basename($_FILES['image']['name']);
				$image = $_FILES['image']['name']; //chemin d'accès à l'image
				
				//si aucune image de selectionnée, ajoute dans la bdd avec une image par défaut
				if(!$image)
				{
				    $sql= "INSERT INTO utilisateur (`Pseudo`, `MotDePasse`) VALUES ('$pseudo','$motdepasse')";
					$result = mysqli_query($db_handle, $sql);
					$sql= "SELECT IdUtilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
					$result = mysqli_query($db_handle, $sql);
					$idutilisateur= mysqli_fetch_assoc($result)['IdUtilisateur'];
					$sql= "INSERT INTO `vendeur`(`IdUtilisateur`,`Email`,`Image` ) VALUES ('$idutilisateur','$email','images/compte.png')";
				    if($debug){echo $sql;}
					$result =mysqli_query($db_handle, $sql);
					session_start();
					$_SESSION['id'] = $idutilisateur;
					header("Location: ../Vendeur/accueil.php");
				}//sinon verifie le format
				else if(get_file_extension($image)!="jpg"&&get_file_extension($image)!="png"&&get_file_extension($image)!="PNG"){
				   $erreur = "Mauvais format d'image";
				}
				//Deplace l'image dans nos fichiers www/vendeur/images, si succès: Ajout du reste des infos dans la BDD, redirection à l'acceuil
				else if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
				    $sql= "INSERT INTO utilisateur (`Pseudo`, `MotDePasse`) VALUES ('$pseudo','$motdepasse')";
					$result = mysqli_query($db_handle, $sql);
					$sql= "SELECT IdUtilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
					$result = mysqli_query($db_handle, $sql);
					$idutilisateur= mysqli_fetch_assoc($result)['IdUtilisateur'];
					$nom_image = $uploaddir . 'imageprofil_'. $idutilisateur."." . get_file_extension($image); //Dans l'immediat, jpg/pnj le changement du type ne derange pas
					rename($uploadfile,$nom_image);
					$sql= "INSERT INTO `vendeur`(`IdUtilisateur`,`Email`,`Image` ) VALUES ('$idutilisateur','$email','$nom_image')";
				    if($debug){echo $sql;}
					$result =mysqli_query($db_handle, $sql);
					session_start();
					$_SESSION['id'] = $idutilisateur;
					header("Location: ../Vendeur/accueil.php");
				} //Le dernier probleme est que l'image est trop volumineuse et ne ce charge pas.
				else {
				   $erreur = "Image trop volumineuse";
				}
			}
		}
		else {echo "Database not found";}
	}

//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
	<head>
		<title>ECEbay login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="login.css">
		<script type="text/javascript">$(document).ready(function(){$('.header').height($(window).height());});</script>
	</head>
	
	<body>
		<div class="container1" >
			<div class="row">
				<div class="col-lg-2 col-md-2"></div>
				<div class="col-lg-8 col-md-8 col-sm-12" align="center" style=" background-color: #C4BDE3; background-position: left 100px top">
					<h1 class="logo"><img src="logoblanc.png" height= "120" width= "436"><button type="button" class="btn" style="border-radius : 2rem; margin-left: 100px;">VENDEUR</button></h1>
					<div><p><br></p></div>
				
					<h1>INSCRIPTION</h1>
					<p><br></p>
					<div align="center">
					<img id="profil" src="compte.png" height='100' width='100'/> <!-- id="profil" -> relié au script en dessous getElementById('profil') -->
					</div>
					<form method="post" enctype="multipart/form-data">
						<table align="center">

							<!--IMAGE DU PROFIL -->
							<input type="hidden" name="MAX_FILE_SIZE" value="30000" />  <!--Apparament taille max de l'image en ko? -->
							<input type="file" name="image" accept="image/gif, image/jpeg, image/png" onchange="loadFile(event)"> 
							<script>
							  var loadFile = function(event) {
							    var output = document.getElementById('profil');
							    output.src = URL.createObjectURL(event.target.files[0]);
							    output.onload = function() {
							      URL.revokeObjectURL(output.src) // free memory
							    }
							  };
							</script>
							<!--IMAGE DU PROFIL -->

							<hr style="height: 30px; color: white; margin-bottom: 10px; margin-top: 20px;">

							<tr align="center">
								<td><input type="text" name="pseudo" placeholder=" Nom d'utilisateur" pattern=".{4,14}" maxlength='14' required></td>
							</tr>
							<tr align="center">
								<td><input type="password" name="motdepasse" placeholder=" Mot de passe" pattern=".{10,30}" title="10 à 30 caractères" maxlength='30' required></td>
							</tr>
							<tr align="center">
								<td><input type="email" name="email" placeholder=" Email" pattern=".{1,30}" title="30 caractères max" maxlength='30' required></td>
							</tr>
						</table>

						<hr style="height: 100px; color: white;  margin-bottom: 20px; margin-top: 10px;">
					
					<div align="center">
					<font color="red"><?php if(isset($erreur)){echo $erreur;}?></font>
					<a href="#"><button type="submit"  name="button" class="btn" style="border-radius: 2rem;">VALIDER</button></a>
					</form>
					</div>
					<div><p><br><br><br><br><br><br></p></div>
				</div>
			</div>
		</div>
	</body>
</html>
