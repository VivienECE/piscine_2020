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
		$nom = htmlspecialchars($_POST["nom"]);
		$prenom = htmlspecialchars($_POST["prenom"]);
		$adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
		$email = htmlspecialchars($_POST["email"]);
		$ville = htmlspecialchars($_POST["ville"]);
		$codepostal = htmlspecialchars($_POST["codepostal"]);
		$pays = htmlspecialchars($_POST["pays"]);
		$telephone = htmlspecialchars($_POST["telephone"]);
		$typedecarte = htmlspecialchars($_POST["typedecarte"]);
		$numerocarte = htmlspecialchars($_POST["numerocarte"]);
		$nomcarte= htmlspecialchars($_POST["nomcarte"]);
		$MM = htmlspecialchars($_POST["MM"]);$YY = htmlspecialchars($_POST["YY"]);
		$expirationcarte = $MM.'/'.$YY;
		$codedesecurite = htmlspecialchars($_POST["codedesecurite"]);

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
			
			//Si aucun doublon, ajout dans la BDD utilisateur et acheteur
			if (!$doublon) {
				$sql= "INSERT INTO utilisateur (`Email`, `Pseudo`, `MotDePasse`) VALUES ('$email','$pseudo','$motdepasse')";
				$result = mysqli_query($db_handle, $sql);
				$sql= "SELECT IdUtilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
				$result = mysqli_query($db_handle, $sql);
				$idutilisateur= mysqli_fetch_assoc($result)['IdUtilisateur'];
				$sql= "INSERT INTO `acheteur`(`IdUtilisateur`, `Nom`, `Prenom`, `Adresse`, `CodePostal`, `Pays`, `Telephone`, `TypeDeCarte`, `NumeroCarte`, `NomCarte`, `ExpirationCarte`, `CodedeSecurite`) VALUES ('$idutilisateur','$nom','$prenom','$adresse','$codepostal','$pays','$telephone','$typedecarte','$numerocarte','$nomcarte','$expirationcarte','$codedesecurite')";
			    echo $sql;
				$result =mysqli_query($db_handle, $sql);
				//OPTIONNEL 
				echo "Vous êtes enregistré." . "<br>" ;	
				//OPTIONNEL	
			}
		}
		else {echo "Database not found";}
	}
//fermer la connexion
mysqli_close($db_handle);?>

<!-- Conserver ce php -->

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
				<div class="col-lg-8 col-md-8 col-sm-12" style=" background-color: #C4BDE3;">
					<h1 class="logo"><img src="logoblanc.png" height= "120" width= "436"><button type="button" class="btn" style="border-radius : 2rem; margin-left: 100px;">ACHETEUR</button></h1>
					<div><p><br></p></div>
				
					<h1>INSCRIPTION</h1>
					<p><br></p>
					<div align="center">
					<img src="compte.png" height="100" width="100">
					</div>
					<form>
						<table align="center">
							<tr align="center">
								<td><input type="text" name="pseudo" placeholder=" Nom d'utilisateur" pattern=".{4,14}" maxlength='14' required></td>
							</tr>
							<tr align="center">
								<td><input type="pass" name="motdepasse" placeholder=" Mot de passe"pattern=".{10,30}" title="10 à 30 caractères" maxlength='30' required></td>
							</tr>
						</table>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-2 col-md-2"></div>
				<div class="col-lg-4 col-md-4 col-sm-12" style=" background-color: #C4BDE3;">
					<div><p><br></p></div>
					<form>
						<table align="center">
							<tr align="center">
								<td><input type="text" id="nomPrenom" placeholder=" Nom et Prénom"></td>
							</tr>
							<tr align="center">
								<td><input type="text" id="adresse1" placeholder=" Adresse Ligne 1"></td>
							</tr>
							<tr align="center">
								<td><input type="text" id="adresse2" placeholder=" Adresse Ligne 2"></td>
							</tr>
							<tr align="center">
								<td><input type="text" id="ville" placeholder=" Ville"></td>
							</tr>
							<tr align="center">
								<td><input type="number" id="codePostal" placeholder=" Code Postal"></td>
							</tr>
							<tr align="center">
								<td><input type="text" id="pays" placeholder=" Pays"></td>
							</tr>
							<tr align="center">
								<td><input type="phone" id="number" placeholder=" Numéro de téléphone"></td>
							</tr>
						</table>
					</form>	
				</div>

				<div class="col-lg-4 col-md-4 col-sm-12" style=" background-color: #C4BDE3;">
					<div><p><br></p></div>
					<p id="carte" align="center"><img src="visa.png">          <img src="MC.png">          <img src="AE.png">          <img src="paypal.png"></p>
					<form>
						<table align="center">
							<tr align="center">
								<td><input type="text" id="numCarte" placeholder=" Numéro de carte"></td>
							</tr>
							<tr align="center">
								<td><input type="text" id="nomCarte" placeholder=" Nom Propriétaire"></td>
							</tr>
							<tr align="center">
								<td>Date d'expiration :</td>
								<td><input type="date" id="dateCatre"></td>
							</tr>
							<tr align="center">
								<td>Code secret à 3 chiffres :</td>
								<td><input type="number" id="cvv"></td>
							</tr>
						</table>
					</form>	
				</div>
						
			</div>

			<div class="row">
				<div class="col-lg-2 col-md-2"></div>
				<div class="col-lg-8 col-md-8 col-sm-12" style=" background-color: #C4BDE3;">
						<div align="center">
							<p><br><br></p>
							<p><input type="checkbox" name="clause">  J'accepte la clause client.</p>
							<a href="#"><button type="submit" class="btn" style="border-radius: 2rem;">VALIDER</button></a>
						</div>
					<div><p><br><br><br></p></div>
				</div>
			</div>
		</div>
	</body>
</html>