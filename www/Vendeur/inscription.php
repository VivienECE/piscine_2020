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
				$sql= "INSERT INTO `vendeur`(`IdUtilisateur`, `Nom`, `Prenom`, `Adresse`, `CodePostal`, `Pays`, `Telephone`, `TypeDeCarte`, `NumeroCarte`, `NomCarte`, `ExpirationCarte`, `CodedeSecurite`) VALUES ('$idutilisateur','$nom','$prenom','$adresse','$codepostal','$pays','$telephone','$typedecarte','$numerocarte','$nomcarte','$expirationcarte','$codedesecurite')";
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
<!-- Conserver tout les <input..> -->
<html>
	<head>
		<title>ECEebay</title>
		<meta charset="utf-8">

	</head>
	<body>
		<h2>Inscription</h2>
		<form method="post">  <!-- Conserver <form ...> -->
			<table>
				<tr>
					<td>Nom d'utilisateur:</td>
					<td><input type="text" name="pseudo" pattern=".{4,14}" maxlength='14' required></td>
				</tr>
				<tr>
					<td>Mot de passe:</td>
					<td><input type="password" name="motdepasse" pattern=".{10,30}" title="10 à 30 caractères" maxlength='30' required></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="email" name="email" maxlength='50' required></td>
				</tr>
				<tr>
					<td>Nom:</td>
					<td><input type="text" name="nom" maxlength='20' required></td>
				</tr>
				<tr>
					<td>Prénom:</td>
					<td><input type="text" name="prenom" maxlength='20' required></td>
				</tr>
				<tr>
					<td>Adresse:</td>
					<td><input type="text" name="adresse" required></td>
				</tr>
				<tr>
					<td>Ville:</td>
					<td><input type="text" name="ville" maxlength='20' required> </td>
				</tr>
				<tr>
					<td>Code Postal:</td>
					<td><input type="text" name="codepostal" pattern="[0-9]{3,10}" maxlength='10' required></td>
				</tr>
				<tr>
					<td>Pays:</td>
					<td><input type="text" name="pays" maxlength='20' required> </td>
				</tr>
				<tr>
					<td>Telephone:</td>
					<td><input type="tel" name="telephone" pattern="[0-9\s]{4,20}" maxlength='20' required></td>
				</tr>
				<tr>
					<td>Type de Carte:</td>
					<td><select name='typedecarte' required>
						    <option value=''>Selectionner</option>
						    <option value='visa'>Visa</option>
						    <option value='mastercard'>Master Card</option>
						    <option value='americanexpress'>American Express</option>
						    <option value='paypal'>Paypal</option>
						</select> </td></td>
				</tr>
				<tr>
					<td>Numéro:</td>
					<td><input type="tel" name="numerocarte" inputmode="numeric" pattern="[0-9\s]{13,19}" maxlength="19" required></td>
				</tr>
				<tr>
					<td>Nom propriétaire:</td>
					<td><input type="text" name="nomcarte" maxlength='20' required></td>
				</tr>
				<tr>
					<td>Date d'expiration:</td>
					<td><select name='MM' required>
						    <option value=''>Mois</option>
						    <option value='01'>January</option>
						    <option value='02'>February</option>
						    <option value='03'>March</option>
						    <option value='04'>April</option>
						    <option value='05'>May</option>
						    <option value='06'>June</option>
						    <option value='07'>July</option>
						    <option value='08'>August</option>
						    <option value='09'>September</option>
						    <option value='10'>October</option>
						    <option value='11'>November</option>
						    <option value='12'>December</option>
						</select> 
						<select name='YY' required>
						    <option value=''>Année</option>
						    <option value='20'>2020</option>
						    <option value='21'>2021</option>
						    <option value='22'>2022</option>
						    <option value='23'>2023</option>
						</select> </td>
				</tr>
				<tr>
					<td>Code de sécurité:</td>
					<td><input  type="text" placeholder="CVV" maxlength='3' pattern="[0-9]{3}" title="Code de sécurité invalide" name="codedesecurite" required></td>
				</tr>
				<tr>
					<td colspan="2" align="center"> <input type="submit" name="button" value="S'inscrire"></td>
				</tr>
			</table>
		</form>
		<font color="red"><?php if(isset($erreur)){echo $erreur;}?></font> <!-- Conserver le message d'erreur ex:Nom d'utilisateur déja enregistré-->
	</body>
</html>