<!-- Conserver ce php -->

<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Recupération des données du formulaires
if (isset($_POST["button"])) {
		$pseudo = htmlspecialchars($_POST["pseudo"]);
		$motdepasse = sha1($_POST["motdepasse"]);
		if ($db_found) {
			$sql = "SELECT utilisateur.IdUtilisateur, IdAcheteur FROM utilisateur join acheteur ON utilisateur.idUtilisateur = acheteur.idUtilisateur WHERE pseudo = '$pseudo' AND motdepasse = '$motdepasse' ";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) != 0) {
				session_start();
				while ($data = mysqli_fetch_assoc($result)){
				$_SESSION['IdUtilisateur'] = $data['IdUtilisateur'];
				$_SESSION['IdAcheteur'] = $data['IdAcheteur'];}

				header("Location: ../Acheteur/accueil.php");
			exit;}

			$sql = "SELECT utilisateur.IdUtilisateur, IdVendeur FROM utilisateur join vendeur ON utilisateur.idUtilisateur = vendeur.idUtilisateur WHERE pseudo = '$pseudo' AND motdepasse = '$motdepasse' ";
			$result = mysqli_query($db_handle, $sql);
			if (mysqli_num_rows($result) != 0) {
				session_start();
				while ($data = mysqli_fetch_assoc($result)){
				$_SESSION['IdUtilisateur'] = $data['IdUtilisateur'];
				$_SESSION['IdVendeur'] = $data['IdVendeur'];}
				$IdVendeur=$_SESSION['IdVendeur'];
				$sql="SELECT COUNT(*) as ventes FROM `item` WHERE IdVendeur=$IdVendeur";
				$result=mysqli_query($db_handle, $sql);
				if(mysqli_fetch_assoc($result)["ventes"]!=0){header("Location: ../Vendeur/mesventes.php");}
				else {header("Location: ../Vendeur/mesventesVIDES.php");}
				exit;}

			$erreur = "Erreur dans le nom d'utilisateur ou le mot de passe";
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
		<h1 class="logo"><img src="logo.png"></h1>
		<div><p><br><br></p></div>
		<div class="container">
			<div class="row">
				
				<div class="col-lg-5 col-md-5 col-sm-12" style="border-right-width: 3px; border-right-color: white;">
					<h1><br>CONNEXION<br></h1>
					<form method='post'>
						<table align="center">
							<tr align="center">
								<td><input type="text" name="pseudo" placeholder=" Nom d'utilisateur"></td>
							</tr>
							<tr align="center">
								<td><input type="password" name="motdepasse" placeholder=" Mot de passe"></td>
							</tr>
						</table>
					
					<p><br></p>
					<font color="red">
						<?php if(isset($erreur)){echo $erreur;}?></font>
					<input type="submit" name="button" id="button" class="btn"style="margin-left: 40%"></a>
				    </form>
					<p><br></p>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-12">
					<hr style="height: 200px; color: white;">
				</div>
				<div class="col-lg-5 col-md-5 col-sm-12">
					<h1><br>INSCRIPTION<br></h1>
					<div align="center"><br><br><a href="inscriptionAcheteur.php"><button type="button" class="btn" id="gauche">ACHETEUR</button>
						<a href="inscriptionVendeur.php"><button type="button" class="btn" id="droite">VENDEUR</button>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>

