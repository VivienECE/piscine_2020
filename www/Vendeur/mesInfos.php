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
				 	<li class="ici"><a class="nav-link" href="moncompte.php">MON COMPTE</a></li>
			        <li><a class="nav-link" href="mesventes.php">MES VENTES</a></li>
			     </ul>
			</div>
	</nav>

	<div><p><br><br><br></p></div>

	<div><p><h1>Mes informations</h1><br></p></div>

	<div class="containerINFOS">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-7" style="background-color: #EFF8FF; border-radius: 3rem; box-shadow: rgba(0,0,0,0.4) 2px 2px;">
				<div><p><br></p></div>
				<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5">
					<img src="images/compte.png" width="200" height="200"><br><br>
				</div>
				<div class="col-lg-7 col-md-7 col-sm-7">
					<p id="nom"><br>Jean-Pierre SEGADO</p>
					<p id="nb">5 articles en vente</p>
					<p id="email">jp.segado@edu.ece.fr</p>
				</div></div>
			</div>
			<div align="center" class="col-lg-5 col-md-5 col-sm-5">
				<div><p><br><br><br></p></div>
				<a href="modifier.php"><button type="submit" class="btn">MODIFIER</button></a>
			</div>
		</div>
	</div>

	<div><br></div>

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