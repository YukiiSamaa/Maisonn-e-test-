	<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// -----------------------------------------------------------
// ADMIN : creation Mot de passe
// -----------------------------------------------------------
// CONFIGURATION GENERALE + de la NEWS
	require(dirname(__DIR__) . '/config/main_config.php');
	require(dirname(__DIR__) . '/'.NEWS_FONCTIONS.'fct_toutes_fonctions_necessaires.php');
	// Configuration des News
	include(dirname(__DIR__) . '/'.NEWS_MOD_NEWS.'news_config.php');
// -----------------------------------------------------------
// Fonctions spéciales : Création/vérification de mot de passe hashé
	include_once(__DIR__ . '/_includes/_fct_speciales.php');
// ------------------------------------------------------
// Mot de passe
	$MDPclair 	= !empty($_POST['MDPclair'])? 	formatage_from_post($_POST['MDPclair']) : '';
	$MDPhash 	= !empty($MDPclair)? 			CreateHashPassword($MDPclair) : '';
// ---------------------------------------------------
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
<?php // META ?>
	<meta charset="utf-8" />
	<meta name="author" content="Jérome Réaux - http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr" />
	<meta name="robots" content="noindex,nofollow" />
<?php // CSS ?>
	<link rel="stylesheet" media="screen" type="text/css" href="./css/adm_theme_style.css" />
	<title>News | Création manuelle d'un mot de passe hashé</title>
</head>

<body>
<div id="mainCentrer">
<h1>Administration</h1>

	<div id="boxIndexIdentificationForm" style="width:500px;">
		<form method="post" action="./adm-createpwd.php">
		<fieldset>
			<h3>Création manuelle<br />d'un mot de passe hashé</h3>
			<p><i>Par sécurité :</i><br />le Mot de passe hashé devra être copié <b>manuellement</b> dans la base de données</p>

			<p>
			<label for="idMDPclair">Mot de passe : </label>
			<input id="idMDPclair" name="MDPclair" type="text" value="<?php echo $MDPclair; ?>" style="width:150px;" />
			</p>

			<p><label>Mdp hashé : </label><?php echo $MDPhash; ?>&nbsp;</p>

			<p style="text-align:center;">
				<button class="btConnexion" name="btConnexion" type="submit" title="Connexion">
				<span>Générer le Mot de passe</span></button>
			</p>
		</fieldset>
		</form>

			<p style="text-align:center;">
				<a class="aRetourSite" href="../index.php"><span>Retour au site</span></a>
			</p>
	</div>

</div>
</body>
</html>