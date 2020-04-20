<!DOCTYPE html>
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
	}
	</script>
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

		<div><p><br><br><h1>Service client</h1><br></p></div>
	<div class="row">
		<div class="col-md-3 col-md-3 col-sm-12">
			<div class="row">
				<div class="col-md-5 col-md-5 col-sm-5">
					<img align="center" src="images/compte.png" height="80" width="80">
				</div>
				<div class="col-md-7 col-md-7 col-sm-7" style="font-weight: bold; font-size: 14px; color: #C4BDE3">
					<p><br><?php echo "$Prenom $Nom" ?></p>
				</div>
			</div>
			<div class="row">
				<div class="menuBIS">
			 		<a href="mesInfos.php">Mes informations</a>
						<a href="modesPaiement.php">Mes modes de paiement</a>
						<a href="mesoffres.php">Mes propositions d'offre</a>
						<a href="mesCommandes.php">Mes commandes</a>
						<a href="aide.php">Aide</a>
						<a href="deconnexion.php">Déconnexion</a>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-md-2 col-sm-12"></div>
		<div class="col-md-7 col-md-7 col-sm-12">
			<p><h2>Vous rencontrez un problème ?<br>Contactez-nous !</h2><br><br><br><br></p>
			<div class="row">
				<div class="col-md-1 col-md-1 col-sm-1">
					<img align="center" src="images/tel.png" height="50" width="50">
				</div>
				<div class="col-md-4 col-md-4 col-sm-4">
					<p style="font-size: 20px; font-weight: bold;">0800 000 689 740</p>
				</div>

				<div class="col-md-1 col-md-1 col-sm-1"><p></p></div>

				<div class="col-md-1 col-md-1 col-sm-1">
					<img align="center" src="images/mail.png" height="50" width="50">
				</div>
				<div class="col-md-4 col-md-4 col-sm-4">
					<a href="serviceclient@ecebay.com"><p style="font-size: 20px; font-weight: bold;">  serviceclient@ecebay.com</p></a>
				</div>
			</div>

			<div id="aide" class="row" align="center">
				<p>
					<br><br><br><br><br>
					<a href="#"><img src="images/twitter.png"></a> 
					<a href="#"><img src="images/lin.png"></a>
					<a href="#"><img src="images/fb.png"></a>
					<a href="#"><img class="img-circle" src="images/insta.png"></a>
				</p>
			</div>
		</div>
	</div></div>

	<div><p><br><br></p></div>

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