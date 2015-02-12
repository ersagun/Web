<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<title>GlobeLuncher | Panier</title>
		<link rel="stylesheet" type="text/css" href="css/main_style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="js/library/jquery.js" title="jquery"></script>
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
				<?php
					include_once('php/config.php');
					$pdo = new PDO('mysql:host='.$host_bdd.';dbname='.$base_bdd, $login_bdd,$mdp_bdd) or die ('shit happened');
					foreach ($_SESSION['panier'] as $ligne_panier) {
						$qte = $ligne_panier['qte'];
						$idP = $ligne_panier['idp'];
						$req_produit = "SELECT * FROM plat WHERE idP = '$idP'";
						$result_produit = $pdo->query($req_produit) or die('shit happened');
						$produit = $result_produit->fetch();
						$prix_total = intval($produit['prix'])*$qte;
						echo('
						<div class="ctn_rest">
							<div><img class="img_plat" src="'.mb_convert_encoding($produit['url_img'],"UTF-8").'"></div>
							<div class="descript_plat">'.mb_convert_encoding($produit['presentation'],"UTF-8").'</div>
							<div class="quantite">Quantité : '.$qte.'</div>
							<div class="prix_plat">'.mb_convert_encoding($prix_total,"UTF-8").' €</div>
						</div>
						');
					}
				?>
				<button>Passer Commande</button>
			</div>
		</div>
	</body>
</html>