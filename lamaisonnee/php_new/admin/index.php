<?php	session_start();
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// ADMIN NEWS : IDENTIFICATION
// ---------------------------------------------------
// CONFIGURATION GENERALE + de la NEWS
	require(dirname(__DIR__) . '/config/main_config.php');
	require(dirname(__DIR__) . '/'.NEWS_FONCTIONS.'fct_toutes_fonctions_necessaires.php');
	// Configuration des News
	include(dirname(__DIR__) . '/'.NEWS_MOD_NEWS.'news_config.php');
// -----------------------------
// Protection de page index ADMIN
	
	include_once(__DIR__ . '/_includes/_protect_index_AVEC_BDD.php');
// ------------------------------------------------------
// sinon affichage du formulaire d'identification
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
<?php // META ?>
	<meta charset="utf-8" />
	<meta name="author" content="Jérome Réaux - http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr" />
	<meta name="robots" content="noindex,nofollow" /><?php // SPECIAL ADMIN ! ?>
<?php // CSS ?>
	<link rel="stylesheet" media="screen" type="text/css" href="./css/adm_theme_style.css" />
	<title>News | Administration des Articles</title>
</head>

<body>
<div id="mainCentrer">

	<h1>Administration des Articles</h1>

	<div id="boxIndexIdentificationForm">
		<form method="post" action="./index.php">
		<fieldset>
			<h3>Identifiez-vous</h3>

<?php	if( !empty($auth_msgerreur) ) { ?>
			<p class="boxMsgErreur"><?php echo $auth_msgerreur; ?></p>
<?php	} ?>
			<p>
				<label for="idlogin">Identifiant : </label>
				<input id="idlogin" name="login" size="20" />
			</p>

			<p>
				<label for="idpass">Mot de passe : </label>
				<input id="idpass" name="pass" type="password" size="20" />
			</p>
			<p style="text-align:center;">
				<button class="btConnexion" name="btConnexion" type="submit" title="Connexion"><span>Connexion</span></button>
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