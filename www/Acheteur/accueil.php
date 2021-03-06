<!-- Conserver ce php -->

<?php
//identifier votre BDD
$database = "ecebay";
//connectez-vous dans votre BDD
//Rappel: votre serveur = localhost |votre login = root |votre password = <rien>
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$debug = false;
// Display the decrypted string 
session_start();
if($debug){echo "ID:".$_SESSION['IdAcheteur'];}
$EnchereIdItem=array(); $EncherePrix=array(); $EnchereDate=array(); $EnchereNom=array();$EnchereImage=array();$EnchereCategorie=array();

$sql= "SELECT item.IdItem,PrixFinal,DateFin FROM enchere join item ON item.IdItem = enchere.IdItem WHERE item.Statut='En cours!'";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($EnchereIdItem,$data['IdItem']);
array_push($EncherePrix,"Faites une offre");
array_push($EnchereDate,$data['DateFin']);}

for($i = 0;$i < sizeof($EnchereIdItem);$i++)
{
	$sql= "SELECT Nom,Image,Categorie FROM item where IdItem=".$EnchereIdItem[$i];
	$result = mysqli_query($db_handle, $sql);
	while ($data = mysqli_fetch_assoc($result)){
		array_push($EnchereNom,$data['Nom']);
		array_push($EnchereImage,$data['Image']);
		array_push($EnchereCategorie,$data['Categorie']);}
}

//IMMEDIAT
$ImmediatIdItem=array(); $ImmediatPrix=array(); $ImmediatDate=array(); $ImmediatNom=array();$ImmediatImage=array();$ImmediatCategorie=array();

$sql= "SELECT item.IdItem,PrixFinal,DateFin FROM achatimmediat join item ON item.IdItem = achatimmediat.IdItem WHERE item.Statut='En cours!'";
	if($debug){echo "<br>".$sql."<br>";}
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($ImmediatIdItem,$data['IdItem']);
array_push($ImmediatPrix,$data['PrixFinal']." €");
array_push($ImmediatDate,$data['DateFin']);}

for($i = 0;$i < sizeof($ImmediatIdItem);$i++)
{
	$sql= "SELECT Nom,Image,Categorie FROM item WHERE IdItem=".$ImmediatIdItem[$i];
	if($debug){echo "<br>".$sql."<br>";}
	$result = mysqli_query($db_handle, $sql);
	while ($data = mysqli_fetch_assoc($result)){
		array_push($ImmediatNom,$data['Nom']);
		array_push($ImmediatImage,$data['Image']);
		array_push($ImmediatCategorie,$data['Categorie']);}
}

//OFFRE
$OffreIdItem=array(); $OffrePrix=array(); $OffreDate=array(); $OffreNom=array();$OffreImage=array();$OffreCategorie=array();

$sql= "SELECT item.IdItem,PrixFinal,DateFin FROM meilleureoffre join item ON item.IdItem = meilleureoffre.IdItem WHERE item.Statut='En cours!'";
$result = mysqli_query($db_handle, $sql);
while ($data = mysqli_fetch_assoc($result)){
array_push($OffreIdItem,$data['IdItem']);
array_push($OffrePrix,"Faites une offre");
array_push($OffreDate,"Faites une offre");}

for($i = 0;$i < sizeof($OffreIdItem);$i++)
{
	$sql= "SELECT Nom,Image,Categorie FROM item where IdItem=".$OffreIdItem[$i];
	$result = mysqli_query($db_handle, $sql);
	while ($data = mysqli_fetch_assoc($result)){
		array_push($OffreNom,$data['Nom']);
		array_push($OffreImage,$data['Image']);
		array_push($OffreCategorie,$data['Categorie']);}
}

//CONTENU HTML DE CHAQUE CAROUSEL
function display_item($Nom,$Image,$Prix,$i) 
{
	//if($i=0){echo  "<div class='carousel-inner' align='center'>";}
	if ($i == 0){echo  "<div class='carousel-inner' align='center'>";} //SLIDE ACTIVE
	if ($i == 0){
		echo  "
	       <div class='carousel-item active'>
		      <img src='$Image' >
		      <p id='titre'> $Nom </p>
			  <p id='prix'> $Prix <br><br></p>
		   </div>";
	}
	else //AUTRES SLIDES
	{
		echo  "<div class='carousel-item'>
		      		<img src='$Image' >
		      		<p id='titre'> $Nom </p>
			  		<p id='prix'> $Prix € <br><br></p>
		    	</div>";
	}
}

function carousel_define($carouselName,$i)
{
	if ($i == 0){echo  "<li data-target='$carouselName' data-slide-to='0' class='active'></li>";} //SLIDE ACTIVE
	else{  echo"<li data-target='$carouselName' data-slide-to='$i'></li>";}
  
}

//fermer la connexion
mysqli_close($db_handle);?>

<!DOCTYPE html>
<html>
<head>
	<title>ECEbay accueil</title>
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

		<div><p><br><br><br></p></div>
		<div class="row">
			<!-- ENCHERE -->
			<div class="col-lg-3 col-md-3 col-sm-12">
				<a href="enchere.php"><h3 class="feature-title">Ventes aux enchères<br><br><br></h3></a>
				<div id="myCarousel1" class="carousel slide" data-ride="carousel" >
				  <ul class="carousel-indicators">
				    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
				  	  <?php for($i = 0;$i < sizeof($EnchereNom);$i++){carousel_define("#myCarousel1",$i);}?>
				  </ul>

				  <!-- Wrapper for slides -->
				<?php for($i=0;$i<sizeof($EnchereNom);++$i){display_item($EnchereNom[$i],$EnchereImage[$i],$EncherePrix[$i],$i);}?>
					</div>
				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel1" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span>
				  <a class="carousel-control-next" href="#myCarousel1" data-slide="next">
				    <span class="carousel-control-next-icon"></span>
				  </a>
				</div>
			</div>

			<div class="col-lg-1 col-md-1 col-sm-0">
				<br><hr id="V" style="height: 330px;">
			</div>

			<!-- IMMEDIAT -->
			<div class="col-lg-4 col-md-4 col-sm-12">
				<a href="achatimmediat.php"><h3 class="feature-title">Ventes immédiates<br><br><br><br></h3></a>
				<div id="myCarousel2" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				    <?php for($i = 0;$i < sizeof($ImmediatNom);$i++){carousel_define("#myCarousel2",$i);}?>
				  </ul>

				  <!-- Wrapper for slides -->
				  	<?php for($i=0;$i<sizeof($ImmediatNom);$i++){display_item($ImmediatNom[$i],$ImmediatImage[$i],$ImmediatPrix[$i],$i);}?>
				  		</div>
				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span>
				  <a class="carousel-control-next" href="#myCarousel2" data-slide="next">
				    <span class="carousel-control-next-icon"></span>
				  </a>
				</div>
			</div>

			<div class="col-lg-1 col-md-1 col-sm-0">
				<br><hr id="V" style="height: 330px;">
			</div>

			<!-- OFFRES -->
			<div class="col-lg-3 col-md-3 col-sm-12">
				<a href="meilleureoffre.php"><h3 class="feature-title">Meilleures offres<br><br><br><br></h3></a>
				<div id="myCarousel3" class="carousel slide" data-ride="carousel">
				  <ul class="carousel-indicators">
				   <?php for($i = 0;$i < sizeof($OffreNom);$i++){carousel_define("#myCarousel2",$i);}?>
				  </ul>

				  <!-- Wrapper for slides -->
				  	<?php for($i=0;$i<sizeof($OffreNom);$i++){display_item($OffreNom[$i],$OffreImage[$i],$OffrePrix[$i],$i);}?>
				  		</div>
				  <!-- Left and right controls -->
				  <a class="carousel-control-prev" href="#myCarousel3" data-slide="prev">
				    <span class="carousel-control-prev-icon"></span>
				  <a class="carousel-control-next" href="#myCarousel3" data-slide="next">
				    <span class="carousel-control-next-icon"></span>
				  </a>
				</div>
			</div>
	</div>

	<div><p><br><br><br></p></div></div>

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