<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------------------
// CONFIGURATION GENERALE
// ---------------------------------------------------------------
// Dossiers
if(!defined('NEWS_FONCTIONS')) 		define('NEWS_FONCTIONS', 	'fonctions/');
if(!defined('NEWS_MODULES')) 		define('NEWS_MODULES', 		'modules/');
if(!defined('NEWS_ADMIN')) 			define('NEWS_ADMIN', 		'admin/');
if(!defined('NEWS_UPLOAD')) 		define('NEWS_UPLOAD', 		'/upload/');

// ---------------------------------------------------------------
// FICHE de la News 			=> INDIQUEZ LE CHEMIN CORRECT !
if(!defined('NEWS_PATH_FICHE')) 	define('NEWS_PATH_FICHE', 	'https://association-lamaisonnée-corbie.fr/php_new/vu_article.php');	// demo
//if(!defined('NEWS_PATH_FICHE')) 	define('NEWS_PATH_FICHE', 	'http://www.nom-du-site.com/votre-news-fiche.php');  // EN PRODUCTION : chemin absolu du fichier contenant la FICHE de la news

// ---------------------------------------------------------------
// CONFIGURATION : MODULE des NEWS
// ---------------------------------------------------------------

// CHEMINS vers les DOSSIERS 	=> INDIQUEZ LE CHEMIN CORRECT !

//if(!defined('ROOT_NEWS')) 		define('ROOT_NEWS', 		'http://localhost/DVP-TUTOS/PHP-GESTION-NEWS-v5-PDO-Procedural/'); // TEST EN LOCAL !
if(!defined('ROOT_NEWS')) 			define('ROOT_NEWS', 		'https://association-lamaisonnée-corbie.fr/php_new/'); // EN PRODUCTION : chemin absolu vers le dossier des news

// Remarque : ROOT_NEWS ne sert que pour les images et les liens des NEWS

// DOSSIER des ICONES (site)
if(!defined('NEWS_IMG_ICONES')) 	define('NEWS_IMG_ICONES', 	ROOT_NEWS.'template/img/icones/');
// ---------------------------------------------------------------
// PATH du module de News (depuis le ROOT_NEWS)
if(!defined('NEWS_MOD_NEWS')) 		define('NEWS_MOD_NEWS', 	NEWS_MODULES.'mod_news/');
// PATH du module de News ADMIN (depuis le ROOT_NEWS)
if(!defined('NEWS_MOD_ADM')) 		define('NEWS_MOD_ADM', 		NEWS_ADMIN.'adm_mod_news/');

// ---------------------------------------------------------------
