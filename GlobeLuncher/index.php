<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<title>GlobeLuncher | Accueil</title>
		<link rel="stylesheet" type="text/css" href="css/main_style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="js/library/jquery.js" title="jquery"></script>
		<script type="text/javascript" src="js/index_script.js"></script>
		<script type="text/javascript" src="js/main_script.js"></script>
	</head>
	<body>
		<div id="container">
			<nav>
				<ul>
					<li id="logo"><a href="index.php"><img src="datas/img/global/logo.png"></a></li>
					<li><a href="choixGroupe.php?type=1"><img src="datas/img/global/pizza.png"></a></li>
					<li><a href="choixGroupe.php?type=2"><img src="datas/img/global/burger.png"></a></li>
					<li><a href="choixGroupe.php?type=3"><img src="datas/img/global/tacos.png"></a></a></li>
					<li><a href="choixGroupe.php?type=7"><img src="datas/img/global/nouilles.png"></a></li>
					<li><a href="choixGroupe.php?type=6"><img src="datas/img/global/samoussa.png"></a></li>
					<li><a href="choixGroupe.php?type=5"><img src="datas/img/global/baguette.png"></a></li>
					<li><a href="choixGroupe.php?type=4"><img src="datas/img/global/sushi.png"></a></li>
				</ul>
			</nav>
			<div id="corps">
				<section id="sect_1">
					<div id="slider">
						<img src="datas/img/slider/01.jpg">
						<img src="datas/img/slider/02.jpg">
						<img src="datas/img/slider/03.jpg">
						<img src="datas/img/slider/04.jpg">
						<img src="datas/img/slider/05.jpg">
						<img src="datas/img/slider/06.jpg">
						<img src="datas/img/slider/07.jpg">
						<div id="slide_icon">
							<div class="slider_icon" id="icon_left">
								<img src="datas/img/slider/pic_gauche.png">
							</div>
							<div class="slider_icon"id="icon_right">
								<img src="datas/img/slider/pic_droit.png">
							</div>
						</div>
					</div>
				</section>
				<section>
					
					<article>
					<p>Pizza, burger, chinois ... Pourquoi choisir ?</p>
					<p>Nous commandons pour vous les spécialités venant des 4 coins du mondes auprès de vos restaurants favoris, c'est simple et rapide.</p>
					<p>N'hésitez plus, devenez un <strong>Globluncher</strong> !</p>
					</article>
					<img id="article" src="datas/img/global/plaquette.png">
					<button type="button" id="button-inscription">S'inscrire</button>
				</section>
			</div>
			
			<div id="contain_market">
				<div id="contain_picto_market">
					<img src="datas/img/global/icon_caddie.png">
				</div>
				<div id="text_market">
					<div id="sub_text_market">
						<?php echo(count($_SESSION['panier']));?> articles dans le panier
						<br>
						<a href="seePanier.php">Passez Commande</a>
					</div>
				</div>
			</div>
			
			<footer>
				<div id="reseaux">
					<img src="datas/img/global/reseaux-sociaux.png" class="img-reseau">
				</div>
			</footer>
		</div>
	</body>
</html>