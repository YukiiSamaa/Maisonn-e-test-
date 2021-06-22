<?php
// ---------------------------------------------------------------
// MODULE des NEWS : PARAMETRES de CONFIGURATION
// ---------------------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// Création 	: juin 2009 par Jérôme Réaux 		(http://j-reaux.developpez.com)
// Mise à jour 	: novembre 2015 par Jérôme Réaux 	(http://j-reaux.developpez.com)

// ---------------------------------------------------------------
// CHEMINS vers les DOSSIERS
// ---------------------------------------------------------------
// ==> voir le fichier de configuration générale : config/main_config.php

// ---------------------------------------------------------------
// Base de Données : table des NEWS
// ---------------------------------------------------------------
// ==> table des NEWS en Base de Données :
if( !defined('NEWS_TAB_ARTICLES')) 		define('T_NEWS_ARTICLES', 			'NEWS_TAB_ARTICLES'); // indiquez le nom de votre table NEWS en base de données
// ==> Création et Structure de la table : modules/mod_news/news_tableSQL.txt
// (la gestion de langues n'est pas prévue dans cette source)

// -------------------------
// ==> table de CONNEXION à l'ADMIN :
if( !defined('NEWS_ADM_CONNEXION')) 	define('T_NEWS_ADM_CONNEXION', 	'NEWS_ADM_CONNEXION');
// IMPORTANT : CHANGEMENT DES IDENTIFIANT et MOT DE PASSE :
// ==> Par sécurité, la modification devra se faire MANUELLEMENT directement dans la base de données
// ==> Générer un mot de passe hashé : admin/adm-createpwd.php

// ---------------------------------------------------------------
// CONFIGURATION de l'AFFICHAGE DES NEWS
// ---------------------------------------------------------------
// LISTING DES NEWS :
// ==> Taille maxi du RESUME (en nombre de caractères)
if( !defined('NEWS_RESUME_NBRECAR')) 	define('NEWS_RESUME_NBRECAR', 	120);

// ==> Résumé du Contenu (brut ou html)
//if( !defined('NEWS_RESUME_TYPE')) 		define('NEWS_RESUME_TYPE', 		'brut');	// Résumé : texte brut, sans balises html
if( !defined('NEWS_RESUME_TYPE')) 		define('NEWS_RESUME_TYPE', 		'html');	// Résumé : format html, conserve les balises html

// ==> Taille des PHOTOS et PICTOS (en pixels)
if( !defined('NEWS_LARGEUR_PHOTO')) 		define('NEWS_LARGEUR_PHOTO', 	720);		// Largeur d enregistrement de la photo
if( !defined('NEWS_LARGEUR_PICTO')) 		define('NEWS_LARGEUR_PICTO', 	100);		// Largeur d affichage du picto

// -------------------------
// PAGINATION :
// ==> Nombre de Colonnes (1 à 6)	-> style CSS (.newsColonne) : mod_news/css/news_style.css
if( !defined('NEWS_NBRE_COLONNE')) 		define('NEWS_NBRE_COLONNE', 	1);

// ==> Nombre de News à afficher par page
if( !defined('NEWS_NBRE_PARPAGE')) 		define('NEWS_NBRE_PARPAGE', 	2);	// (à définir en fonction du nombre de colonnes : 3 x 4 colonnes, par exemple)

	// ==> Nombre Maxi à afficher : on ne veut prendre en compte que les xxx plus récentes (ex : les 30 dernieres)
if( !defined('NEWS_NBRE_MAXITOTAL')) 	define('NEWS_NBRE_MAXITOTAL', 	30);

// ---------------------------------------------------------------
// PARAMETRES POUR LES PHOTOS / FICHIERS
// ---------------------------------------------------------------
// ==> Choix du dossier de stockage (ces dossiers doivent être déprotégés en ecriture : chmod 777)
if( !defined('NEWS_REP_PHOTOS')) 		define('NEWS_REP_PHOTOS', 		NEWS_UPLOAD.'images/news_photos/');		// PHOTOS
if( !defined('NEWS_REP_FILES')) 			define('NEWS_REP_FILES', 		NEWS_UPLOAD.'files/news_files/');		// FICHIERS
// -------------------------
// UPLOAD : Restrictions sur les fichiers
// taille maxi des fichiers
if( !defined('NEWS_SIZEMAX_PHOTO')) 		define('NEWS_SIZEMAX_PHOTO', 	10000000);	// 10 Mo
if( !defined('NEWS_SIZEMAX_FILE')) 		define('NEWS_SIZEMAX_FILE',		10000000);	// 10 Mo

// EXTENSIONS acceptées
if( !defined('NEWS_EXTENSION_PHOTO')) 	define('NEWS_EXTENSION_PHOTO',	'jpg,jpeg,png,gif');
if( !defined('NEWS_EXTENSION_FILE')) 	define('NEWS_EXTENSION_FILE',	'pdf');

// MIME TYPES acceptés
if( !defined('NEWS_MIMETYPE_PHOTO')) 	define('NEWS_MIMETYPE_PHOTO',	'image/jpeg,image/png,image/gif');
if( !defined('NEWS_MIMETYPE_FILE')) 		define('NEWS_MIMETYPE_FILE',	'application/pdf');

// ---------------------------------------------------------------
// PARAMETRES POUR L EDITEUR WYSIWYG
// ---------------------------------------------------------------
// ==> Choix de l editeur
	if( !defined('NEWS_EDITEUR_WYSIWYG')) 	define('NEWS_EDITEUR_WYSIWYG', 		'CKeditor');		// CKeditor
	//if( !defined('NEWS_EDITEUR_WYSIWYG')) 	define('NEWS_EDITEUR_WYSIWYG', 		'TinyMCE');			// TinyMCE
//	if( !defined('NEWS_EDITEUR_WYSIWYG')) 	define('NEWS_EDITEUR_WYSIWYG', 		''); 				// rien (pour du texte brut)

// -------------------------
// SPECIAL CKeditor: 					-> http://ckeditor.com
// -------------------------
// -> Toolbar personnalisable dans : 	utilitaires/CKeditor/config.js
// -> http://docs.cksource.com/CKEditor_3.x/Developers_Guide/Toolbar
	//if( !defined('NEWS_CKeditor_TOOLBAR')) 	define('NEWS_CKeditor_TOOLBAR', 		'ToolbarArticle');	// Toolbar PERSONALISEE : Contenu Article
if( !defined('NEWS_CKeditor_TOOLBAR')) 	define('NEWS_CKeditor_TOOLBAR', 		'Full');			// Full
//	if( !defined('NEWS_CKeditor_TOOLBAR')) 	define('NEWS_CKeditor_TOOLBAR', 		'Basic');			// Basic
// Remarque :
// Contrairement à FCKeditor, l'Exploreur de Fichier n'est pas intégré et il est... PAYANT (CKFinder -> http://ckfinder.com)
// UNE ALTERNATIVE : KCfinder 			-> http://kcfinder.sunhater.com
// (GRATUIT, open-source) ! (contenu dans cette source !)

// -------------------------
// SPECIAL TinyMCE (3.5.5) : 			-> http://www.tinymce.com
//										-> http://www.tinymce.com/wiki.php/Installation
// 										-> http://www.tinymce.com/wiki.php/Configuration
// -------------------------
// -> Toolbar personnalisable dans : 	utilitaires/TinyMCE/jscripts/tiny_mce/config_perso.js
// Remarque :
// PROBLEME d'affichage UTF-8 dans l'éditeur : je n'ai pas trouvé (ni trop cherché !) la solution...
// ---------------------------------------------------------------
