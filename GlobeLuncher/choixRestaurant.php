<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<title>GlobeLuncher | Carte</title>
		<link rel="stylesheet" type="text/css" href="css/main_style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="js/library/jquery.js" title="jquery"></script>
		<script type="text/javascript" src="js/main_script.js"></script>
		<?php
			include_once('php/config.php');
			$pdo = new PDO('mysql:host='.$host_bdd.';dbname='.$base_bdd, $login_bdd,$mdp_bdd) or die ('shit happened');
			$type = $_GET['codres'];

			$req_plat = "SELECT * FROM plat WHERE idR = '$type'";
			$result_plat = $pdo->query($req_plat) or die ('Shit happened');

			$req_restaurant = "SELECT * FROM restaurant WHERE idR= '$type'";
			$result_restaurant = $pdo->query($req_restaurant);
			$restaurant = $result_restaurant->fetch();
		?>
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
				<h1><?php echo($restaurant['nom']);?></h1>
				<?php
					if($result_plat->rowcount() != 0){
						foreach ($result_plat as $plat) {
							echo('
							<div class="ctn_rest">
								<div class="name_plat">'.mb_convert_encoding($plat['nom'],"UTF-8").'</div>
								<img class="img_plat" src="'.mb_convert_encoding($plat['url_img'],"UTF-8").'">
								<div class="descript_plat">'.mb_convert_encoding($plat['presentation'],"UTF-8").'</div>
								<div class="prix_plat">'.mb_convert_encoding($plat['prix'],"UTF-8").'</div>
								<button onclick="javascript:window.location=\'choixProduit.php?codplat='.$plat['idP'].'\'">Ajouter à mon panier</button>
							</div>
							');
						}
					} else {
						echo('Pas de carte trouvée... :\'(');
					}
				?>
			</div>
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
	</body>
</html>