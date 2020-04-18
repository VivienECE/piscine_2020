<!DOCTYPE html>
<html>
<head>
	<title>ECEbay catégories</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="acheteur.css">
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
			        <li><a class="nav-link" href="accueil.php">ACCUEIL</a></li>
			        <li class="ici"><a class="nav-link" href="categories.php">CATEGORIES</a></li>
			        <li><a class="nav-link" href="panier.php"><img src="images/panier.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="favoris.php"><img src="images/favoris.png" width="20" height="20"></a></li>
			        <li><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><h2>TYPES D'OBJET</h2><br><br></p></div>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12" id="barre">
				<a href="tresors.php"><button type="button" class="btn">FERAILLES ET TRESORS</button>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12">
				<a href="musee.php"><button type="button" class="btn ">MUSEE</button>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 ">
				<a href="accessoires.php"><button type="button" class="btn">ACCESSOIRES VIP</button>
			</div>
		</div>

		<div><p><br><br><br><h2>TYPES DE VENTE</h2><br><br></p></div>

		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<a href="enchere.php"><button type="button" class="btn ">VENTES AUX ENCHERES</button>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12">
				<a href="meilleureoffre.php"><button type="button" class="btn">MEILLEURES OFFRES</button>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12">
				<a href="achatimmediat.php"><button type="button" class="btn">VENTES IMMEDIATES</button>
			</div>
		</div>
	</div>

	<div><p><br><br><br><br></p></div>

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