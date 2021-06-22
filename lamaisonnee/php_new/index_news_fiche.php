<?php if( session_id()=='' ){ session_start(); }
header('Content-type:text/html; charset=UTF-8');	// encodage UTF-8
//error_reporting(E_ALL); 	// en TEST !!
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
<?php // META ?>
	<meta charset="utf-8" />
	<meta name="robots" content="index, follow" />
	<meta name="author" content="Jérome Réaux - http://j-reaux.developpez.com" />
<?php // CSS ?>
	<link rel="stylesheet" media="screen" type="text/css" href="./template/css/theme_style.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="./modules/mod_news/css/news_style.css" />
<title>News | Fiche de l'Article</title>
</head>

<body>
<div id="mainCentrer">

	<div id="newsArticleListing">
<?php 
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// FICHE de la News -> indiquez le chemin correct
	include(__DIR__.'/modules/mod_news/news_fiche.php');
// ---------------------------------------------------
?>
	</div> 

	<div class="LienRetourListe">
		<a href="<?php echo (isset($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER'] : './index.php'; ?>"><span>Retour à la Liste des Articles</span></a>
	</div> 

</div>
</body>
</html>