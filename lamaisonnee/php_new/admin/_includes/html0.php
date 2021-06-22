<?php	
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// -----------------------------
// ADMIN FONCTIONS
	require(__DIR__ . '/_protect_page.php');
	require(dirname(dirname(__DIR__)) . '/config/main_config.php');
	require_once(dirname(dirname(__DIR__)) . '/'.NEWS_FONCTIONS.'fct_toutes_fonctions_necessaires.php');
// -----------------------------
// Configuration des News
	require(dirname(dirname(__DIR__)) . '/'.NEWS_MOD_NEWS.'news_config.php');
	require_once(dirname(dirname(__DIR__)) . '/'.NEWS_MOD_NEWS.'news_fonctions.php');
// -----------------------------
// DOSSIER des ICONES (administration)
if(!defined('REP_ADM_ICONES')) 				define('REP_ADM_ICONES', 		'../icones/');
// -----------------------------
