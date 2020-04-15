<!-- Conserver ce php -->

<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$doublon = false;

//Recupération des données du formulaires
if (isset($_POST["button"])) {
		$pseudo = htmlspecialchars($_POST["pseudo"]);
		$motdepasse = sha1($_POST["motdepasse"]);
	
		if ($db_found) {

			//Verification doublon table utilisateur
			$sql = "SELECT pseudo FROM utilisateur WHERE pseudo = '$pseudo'";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) != 0) {
			$erreur = "Nom d'utilisateur déja utilisé.";
			$doublon = true;
			}
			
			//Si aucun doublon, ajout dans la BDD utilisateur et acheteur
			if (!$doublon) {
				$sql= "INSERT INTO utilisateur (`Pseudo`, `MotDePasse`) VALUES ('$pseudo','$motdepasse')";
				$result = mysqli_query($db_handle, $sql);
				$sql= "SELECT IdUtilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
				$result = mysqli_query($db_handle, $sql);
				$idutilisateur= mysqli_fetch_assoc($result)['IdUtilisateur'];
				$sql= "INSERT INTO `vendeur`(`IdUtilisateur`) VALUES ('$idutilisateur')";
			    echo $sql;
				$result =mysqli_query($db_handle, $sql);
				header("Location: Vendeur/accueil.php");
  				  exit;
				//OPTIONNEL 
				echo "Vous êtes enregistré." . "<br>" ;	
				//OPTIONNEL	
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
					<img src="compte.png" height="100" width="100">
					</div>
					<form method="post">
						<table align="center">
							<tr align="center">
								<td><input type="text" name="pseudo" placeholder=" Nom d'utilisateur" pattern=".{4,14}" maxlength='14' required></td>
							</tr>
							<tr align="center">
								<td><input type="password" name="motdepasse" placeholder=" Mot de passe" pattern=".{10,30}" title="10 à 30 caractères" maxlength='30' required></td>
							</tr>
						</table>
					
					<div align="center">
					<p><br><br></p>
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