<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
session_start();
$IdAcheteur=$_SESSION['IdAcheteur'];
$IdUtilisateur= $_SESSION['IdUtilisateur'];
$msg="";

//Lorsque l'on appuie sur enregistré, récupère les infos si elles sont renseigné.
//Ajouter les modifs sql dans chaque if...
if (isset($_POST["modification"])) { 
		if(isset($_POST["newpseudo"])){$newpseudo = htmlspecialchars($_POST["newpseudo"]);}
		if(isset($_POST["newmotdepasse"])){$newmotdepasse = sha1($_POST["newmotdepasse"]);}
		if(isset($_POST["oldmotdepasse"])){$oldmotdepasse = sha1($_POST["oldmotdepasse"]);}
		if(isset($_POST["newnom"])){$newnom = htmlspecialchars($_POST["newnom"]);
			$sql="UPDATE `acheteur` SET `Nom` = '$newnom' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newnom)>1){$result = mysqli_query($db_handle, $sql);}}

		if(isset($_POST["newprenom"])){$newprenom = htmlspecialchars($_POST["newprenom"]);
			$sql="UPDATE `acheteur` SET `Prenom` = '$newprenom' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newprenom)>1){$result = mysqli_query($db_handle, $sql);}}

		if(isset($_POST["newadresse"])){$newadresse = htmlspecialchars($_POST["newadresse"]);
			$sql="UPDATE `acheteur` SET `Adresse` = '$newadresse' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newadresse)>1){$result = mysqli_query($db_handle, $sql);}}

		if(isset($_POST["newcodepostal"])){$newcodepostal = htmlspecialchars($_POST["newcodepostal"]);
			$sql="UPDATE `acheteur` SET `CodePostal` = '$newcodepostal' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newcodepostal)>1){$result = mysqli_query($db_handle, $sql);}}

		if(isset($_POST["newpays"])){$newpays = htmlspecialchars($_POST["newpays"]);
			$sql="UPDATE `acheteur` SET `Pays` = '$newpays' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newpays)>1){$result = mysqli_query($db_handle, $sql);}}

		if(isset($_POST["newtelephone"])){$newtelephone = htmlspecialchars($_POST["newtelephone"]);
			$sql="UPDATE `acheteur` SET `Telephone` = '$newtelephone' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newtelephone)>3){$result = mysqli_query($db_handle, $sql);}}

		//$typedecarte = htmlspecialchars($_POST["typedecarte"]);
		if(isset($_POST["newnumerocarte"])){
			$newnumerocarte = htmlspecialchars($_POST["newnumerocarte"]);
			$newnumerocarte = str_replace(' ', '', $newnumerocarte);
			if(strlen($newnumerocarte)>10){
			$sql="UPDATE `acheteur` SET `NumeroCarte` = '$newnumerocarte' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			$result = mysqli_query($db_handle, $sql);}}

		if(isset($_POST["newnomcarte"])){$newnomcarte= htmlspecialchars($_POST["newnomcarte"]);
			$sql="UPDATE `acheteur` SET `CodedeSecurite` = '$newnomcarte' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newnomcarte)>1){$result = mysqli_query($db_handle, $sql);}}

		if(isset($_POST["newcodedesecurite"])){
			$newcodedesecurite = htmlspecialchars($_POST["newcodedesecurite"]);
			$sql="UPDATE `acheteur` SET `CodedeSecurite` = '$newcodedesecurite' WHERE `acheteur`.`IdAcheteur` = IdAcheteur";
			if(strlen($newcodedesecurite)>2){$result = mysqli_query($db_handle, $sql);}}
		if(isset($_POST["newexpirationcarte"])){$newexpirationcarte = htmlspecialchars($_POST["newexpirationcarte"]);}
		//$MM = htmlspecialchars($_POST["MM"]);$YY = htmlspecialchars($_POST["YY"]);
		//$expirationcarte = $MM.'/'.$YY;
}

$sql= "SELECT pseudo, motdepasse
FROM utilisateur WHERE IdUtilisateur=$IdUtilisateur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Pseudo = $data['pseudo'];
}

$sql= "SELECT Nom, Prenom, Adresse, CodePostal, Pays,Telephone,TypeDeCarte, NumeroCarte, NomCarte, ExpirationCarte, CodedeSecurite, ImageProfil
FROM acheteur WHERE IdAcheteur=$IdAcheteur";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
$Nom = $data['Nom'];
$Prenom = $data['Prenom'];
$ImageProfil = $data['ImageProfil'];
$Adresse = $data['Adresse'];
$Pays = $data['Pays'];
$Telephone = $data['Telephone'];
$NumeroCarte = $data['NumeroCarte'];
$TypeDeCarte = $data['TypeDeCarte'];
$CodePostal = $data['CodePostal'];
$NomCarte = $data['NomCarte'];
$ExpirationCarte = $data['ExpirationCarte'];
$CodedeSecurite = $data['CodedeSecurite'];}

// Display the decrypted string 
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
	<link rel="stylesheet" type="text/css" href="acheteur.css">
	<script type="text/javascript">$(document).ready(function(){$('.header').height($(window).height());});
	function Event(evt, div) {
	  // Declare all variables
	  var i, tabcontent, tablinks;

	  // Get all elements with class="tabcontent" and hide them
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }

	  // Get all elements with class="tablinks" and remove the class "active"
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }

	  // Show the current tab, and add an "active" class to the link that opened the tab
	  document.getElementById(div).style.display = "block";
	  evt.currentTarget.className += " active";
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
			        <li><a class="nav-link" href="accueil.php">ACCUEIL</a></li>
			        <li><a class="nav-link" class="tablinks" onclick="Event(event, 'categories')" >CATEGORIES</a></li>
			        <li><a class="nav-link" href="panier.php"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li class="ici"><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>


	<div class="containerINFOS">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-0"></div>
			<div   id="categories" class="col-lg-5 col-md-5 col-sm-12">
				<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5">
			  		<br><h5>TYPE DE VENTE</h5>
			  		<ul id="prix">
			  			<li><a href="enchere.php">Enchères</a></li>
			  			<li><a href="achatimmediat.php">Achat immédiat</a></li>
			  			<li><a href="meilleureoffre.php">Meilleure Offre</a></li>
			  		</ul>
			  	</div>
			  	<div class="col-lg-1 col-md-1 col-sm-1"><hr id="V" style="height: 50px;"></div>
			  	<div class="col-lg-6 col-md-6 col-sm-6">
			  		<br><h5>TYPE D'ARTICLE</h5>
			  		<ul id="prix">
			  			<li><a href="tresors.php">Féraille et trésors</a></li>
			  			<li><a href="musee.php">Musée</a></li>
			  			<li><a href="accessoires.php">Accessoire VIP</a></li>
			  		</ul>
			  	</div>
			  </div>
			</div>
		</div>

		<div><p><br><br><br><h1>Mes informations</h1><br></p></div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12" align="center">
				<img id = "profil" src=<?php echo "'$ImageProfil'";?> height="100" width="100">
				<form method=post>
					<table align="center">
						<tr align="center">
							<td><!--IMAGE DU PROFIL -->
								<input type="hidden" name="MAX_FILE_SIZE" value="30000" />  <!--Apparament taille max de l'image en ko? -->
								<input style="border-radius: 2rem;" type="file" name="newimage" accept="image/gif, image/jpeg, image/png" onchange="loadFile(event)"> 
								<script>
								  var loadFile = function(event) {
								    var output = document.getElementById('profil');
								    output.src = URL.createObjectURL(event.target.files[0]);
								    output.onload = function() {
								      URL.revokeObjectURL(output.src) // free memory
								    }
								  };
								</script>
								<!--IMAGE DU PROFIL --></td>
						</tr>
						<tr align="center">
							<td><input type="text" id="nomUtilisateur" name="newpseudo" placeholder= <?php echo "'$Pseudo'";?>></td>
						</tr>
						<tr align="center">
							<td><input type="password" id="mdp" name="oldmotdepasse" placeholder=" Mot de passe actuel "></td>
						</tr>
						<tr align="center">
							<td><input type="password" id="mdp" name="newmotdepasse" placeholder=" Nouveau mot de passe "></td>
						</tr>
					</table>
			</div>
		</div>

			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12"></div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<div><p><br></p></div>
						<table align="center">
							<tr align="center">
								<td><input type="text" minlength="1" id="prenom" name="newprenom" placeholder= <?php echo "'$Prenom'";?>></td>
							</tr>
							<tr align="center">
								<td><input type="text" minlength="1" id="nom" name="newnom" placeholder=<?php echo "'$Nom'";?>></td>
							</tr>
							<tr align="center">
								<td><input type="text" minlength="1" id="adresse1" name="newadresse" placeholder=<?php echo "'$Adresse'";?>></td>
							</tr>
							<tr align="center">
								<td><input type="text" minlength="1" id="adresse2" placeholder=<?php echo "";?>></td>
							</tr>
							<tr align="center">
								<td><input type="number" minlength="1" id="codePostal" name="newcodepostal" placeholder=<?php echo "'$CodePostal'";?>></td>
							</tr>
							<tr align="center">
								<td><input type="text" minlength="1" id="pays" name="newpays" placeholder=<?php echo "'$Pays'";?>></td>
							</tr>
							<tr align="center">
								<td><input type="phone" minlength="1" id="number" name="newtelephone" placeholder=<?php echo "'$Telephone'";?>></td>
							</tr>
						</table>
					
				</div>

				<div class="col-md-1 col-md-1 col-sm-0">
					<hr id="V" style="height: 300px;">
				</div>

				<div class="col-lg-4 col-md-4 col-sm-12">
					<div><p><br></p></div>
					<p id="carte" align="center"><img src="images/visa.png"><img src="images/MC.png"><img src="images/AE.png"><img src="images/paypal.png"></p>
						<table align="center">
							<tr align="center">
								<td><input type="text" id="numCarte" pattern="[0-9\s]{13,19}" minlength="13" maxlength="19" name="newnumerocarte" placeholder=<?php echo str_repeat('*', strlen($NumeroCarte) - 4) . substr($NumeroCarte, -4);?>></td>
							</tr>
							<tr align="center">
								<td><input type="text" id="nomCarte" name="newnomcarte" placeholder=<?php echo "'$NomCarte'";?>></td>
							</tr>
							<tr align="center">
								<td style="color: grey;">Date d'expiration :  <input type="text" pattern="{2}/{2}[0-9]" name="newexpirationcarte" maxlength="5" id="dateCatre" placeholder=<?php echo "'$ExpirationCarte'";?>></td>
							</tr>
							<tr align="center">
								<td style="color: grey;">Code secret à 3 chiffres :  <input type="number" style="width: 60px;" id="CVV" name="newcodedesecurite" placeholder="CVV"></td>
							</tr>
						</table>	
				</div>
			</div>

			<div class="row">
				<div class="col-lg-2 col-md-2"></div>
				<div class="col-lg-8 col-md-8 col-sm-12">
						<div align="center">
							<p><br><br></p>
							<a href="#"><button type="submit" class="btn" name="modification" style="color: white; font-size: 16px; font-weight: bold; background-color: #B6B6BA; border-radius: 2rem;">ENREGISTRER
							</form>	
						    </button></a>
						</div>
					<div><p><br><br><br></p></div>
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