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
// On récupère (via l'URL) le numéro de la page à afficher
	$newsNumPage	= (isset($_GET['pg']))? intval($_GET['pg']) : 1; // page 1 par défaut
// Affichage d un RESUME des News :  Petite photo + titre + date + résumé du contenu + lien [suite]
	news_affiche_liste_colonne( $newsNumPage );
// ---------------------------------------------------
