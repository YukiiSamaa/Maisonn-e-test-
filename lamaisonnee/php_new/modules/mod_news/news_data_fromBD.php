<?php 
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------
if( is_numeric($newsId) && $newsId>0 )
{
	// ---------------------
	// Récupération des champs dans la BD
	$news_fiche_query 		= "SELECT * FROM ".T_NEWS_ARTICLES." ".
							" WHERE news_id = :newsId;";
  try {
	$pdo_select 			= $pdo->prepare($news_fiche_query);
	$pdo_select->bindValue(	':newsId', 		$newsId,		PDO::PARAM_INT);
	$pdo_select->execute();
	$news_fiche_nombre 		= $pdo_select->rowCount();
	$news_fiche_row			= $pdo_select->fetch();
  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
	// ---------------------
	$newsId 				= intval($news_fiche_row['news_id']);
	$newsTitre 				= formatage_affichage($news_fiche_row['news_titre']);
	$newsContenu 			= formatage_from_textarea($news_fiche_row['news_contenu']);	// textarea
	$newsDate 				= formatage_affichage($news_fiche_row['news_date']); // TIMESTAMP
	$newsPublier 			= intval($news_fiche_row['news_publier']);
	// ---------------------
	// Photo
	$newsPhoto 				= formatage_affichage($news_fiche_row['news_photo']);
	$newsPhotoAvant			= $newsPhoto;
	$newsPhotoLargeur		= intval($news_fiche_row['news_photo_largeur']);
	// ---------------------
	// Fichier joint
	$newsFile 				= formatage_affichage($news_fiche_row['news_file']);
	$newsFileAvant			= $newsFile;
// ---------------------------------------------------
} else {
	// ---------------------
	// Initialisation de l'Article (Ajouter)
	$newsId 				= 0;
	$newsTitre 				= '';
	$newsContenu 			= '';
	$newsDate 				= time();	// TIMESTAMP (date du jour par défaut)
	$newsPublier 			= 1;		// Publier : Oui par défaut
	// ---------------------
	// Photo
	$newsPhoto 				= '';
	$newsPhotoAvant			= '';
	$newsPhotoLargeur		= 25;		// 25% par défaut
	// ---------------------
	// Fichier joint
	$newsFile 				= '';
	$newsFileAvant			= '';
	// ---------------------
}
// ---------------------------------------------------
