<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// Configuration principale
	require_once(dirname(dirname(__DIR__)) . '/config/main_config.php');
// Fonctions nécessaires + Connexion à la BdD PDO
	require_once(dirname(dirname(__DIR__)) . '/'.NEWS_FONCTIONS.'fct_toutes_fonctions_necessaires.php');
// Configuration des News
	require_once(__DIR__ . '/news_config.php');
	require_once(__DIR__ . '/news_fonctions.php');
// ---------------------------------------------------
// NEWS - FICHE DETAILLEE
// ---------------------------------------------------
if(  !empty($_GET['newsId']) ){
	$newsId 				= intval($_GET['newsId']);
} else { // sinon retour
	header('location: ./index.php');
	exit;
}
// ---------------------------------------------------
// On recupere les infos dans la BD
	require(dirname(dirname(__DIR__)) . '/'.NEWS_MOD_NEWS.'news_data_fromBD.php');
// Affichage de la FICHE de la NEWS
 	news_affiche_fiche($newsId);
// ---------------------------------------------------
