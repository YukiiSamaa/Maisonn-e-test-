<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// NEWS : TRAITEMENT des donnees (newsTitre, newsContenu)
// ---------------------------------------------------
if(  !empty($_POST['traiter']) && in_array($_POST['traiter'], array('Ajouter','Modifier','Supprimer')) )
{
	$traiter = $_POST['traiter'];
} else {
	// sinon retour a la liste
	header('location: ./news_liste.php');
	exit;
}
// --------------------
// initialisation
	$MsgValidAjouter 		= 'L\'Article a été ajouté.';
	$MsgValidModifier 		= 'L\'Article a été modifié.';
	$MsgValidSupprimer 		= 'L\'Article a été supprimé.';

// -------------------------
if( in_array($traiter, array('Ajouter','Modifier')) )
{
	// -----------------------------------------
	// 1- RECUPERATION DES DONNEES DU FORMULAIRE
	// -----------------------------------------
	$newsId 				= ( !empty($_POST['newsId']) )?				intval($_POST['newsId']) : 0;
	$newsTitre 				= ( !empty($_POST['newsTitre']) )?			formatage_from_post($_POST['newsTitre']) : '';
	$newsContenu 			= ( !empty($_POST['newsContenu']) )?		formatage_from_textarea($_POST['newsContenu']) : ''; 	// textarea
	$newsPublier 			= ( !empty($_POST['newsPublier']) )?		intval($_POST['newsPublier']) : 0; 		// (0=non - 1=oui)
	$newsDate 				= ( !empty($_POST['newsDate']) )?			intval($_POST['newsDate']) : time(); 	// date du jour par défaut

	// -----------------------------------------
	// 2- GESTION des ERREURS
	// -----------------------------------------
	// Expression régulière pour vérifier qu'aucun en-tête n'est inséré dans les champs
	$regex_head = '/[\n\r]/';
	// pas de header dans les champs text */
	if( preg_match($regex_head, $newsTitre)) {
		$MsgErreurChamps 	.= 'Entêtes interdites dans les champs du formulaire !<br />';
		$validNews 			= 2;
	}
	// ---------------------
	// champs obligatoires :
	$champ_obligatoire = array();
	// Titre
	if(  empty($newsTitre) ) {			$validNews = 2;		$champ_obligatoire[] = 'Titre'; }
	// Contenu : dé-commentez pour rendre le contenu obligatoire ! (à faire AUSSI dans le fichier js de validation)
//	if(  empty($newsContenu) ) {		$validNews = 2;		$champ_obligatoire[] = 'Contenu'; }
	if( $validNews==2 && count($champ_obligatoire)>0) {
		$MsgErreurChamps 	.= 'Remplissez tous les champs obligatoires :<br /><b>'.implode('</b>, <b>',$champ_obligatoire).'</b><br />';
	}
	// ---------------------
	if( $validNews!=2) {
		$validNews 			= 1;
		// -----------------
	}

	// -----------------------------------------
	// 3- ENREGISTREMENT
	// -----------------------------------------
	// Ajouter
	if( $validNews==1 && $traiter=='Ajouter')
	{
		// INSERT : nouvelle entree dans la table
		// on met la date du jour (timestamp) : time()
		$insert_query 		= "INSERT INTO ".T_NEWS_ARTICLES.
							" (".
							" news_titre, ".
							" news_contenu, ".
							" news_publier, ".
							" news_date ". // (pas de virgule)
							") VALUES (".
							" :newsTitre, ".
							" :newsContenu, ".
							" :newsPublier, ".
							" :newsDate". // (pas de virgule)
							");";
	  try {
		$pdo_insert 		= $pdo->prepare($insert_query);
		$pdo_insert->bindValue(':newsTitre', 		$newsTitre,				PDO::PARAM_STR);
		$pdo_insert->bindValue(':newsContenu', 		$newsContenu,			PDO::PARAM_STR);
		$pdo_insert->bindValue(':newsPublier', 		$newsPublier,			PDO::PARAM_INT);
		$pdo_insert->bindValue(':newsDate', 		$newsDate,				PDO::PARAM_STR);
		$pdo_insert->execute();
		// -----------------
		$MsgValidOK 		= $MsgValidAjouter;
		$traiter 			= 'Modifier';	// Ajouter -> Modifier
		// -----------------
		// recuperation de newsId en selectionnant LA DERNIERE fiche cree
		$newsId 			= $pdo->lastInsertId('news_id');
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
	} // fin Ajouter

	// -----------------------------------------
	// Modifier
	elseif( $validNews==1 && $traiter=='Modifier')
	{
		// on ne change pas la date
		// UPDATE de la fiche :
		$update_query 		= "UPDATE ".T_NEWS_ARTICLES." SET ".
							" news_titre 			= :newsTitre, ".
							" news_contenu 			= :newsContenu, ".
							" news_publier 			= :newsPublier, ".
							" news_date 			= :newsDate ". // (pas de virgule)
							" WHERE news_id 		= :newsId;";
	  try {
		$pdo_update 		= $pdo->prepare($update_query);
		$pdo_update->bindValue(':newsTitre', 		$newsTitre,				PDO::PARAM_STR);
		$pdo_update->bindValue(':newsContenu', 		$newsContenu,			PDO::PARAM_STR);
		$pdo_update->bindValue(':newsPublier', 		$newsPublier,			PDO::PARAM_INT);
		$pdo_update->bindValue(':newsDate', 		$newsDate,				PDO::PARAM_STR);
		$pdo_update->bindValue(':newsId', 			$newsId,				PDO::PARAM_INT);
		$pdo_update->execute();
		// -----------------
		$MsgValidOK 		= $MsgValidModifier;
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
	} // fin Modifier

	// -----------------------------------------
	// Ajouter ou Modifier
	// -----------------------------------------
	if( $validNews==1 && in_array($traiter, array('Ajouter', 'Modifier')))
	{
		// ----------------------
		// traitement Photo ?
		include(__DIR__ . '/news_traiter_photo.php');
		// ----------------------
		// traitement Fichier ?
		include(__DIR__ . '/news_traiter_file.php');
	} // fin Ajouter/Modifier
}
// -------------------------
// Traitement : Supprimer
// -------------------------
elseif( $traiter == 'Supprimer')
{
	$newsId 				= ( isset($_POST['newsId']) )?				intval($_POST['newsId']) : 0;
	$newsPhotoAvant 		= ( isset($_POST['newsPhotoAvant']) )? 		formatage_from_post($_POST['newsPhotoAvant']) : '';
	$newsFileAvant 			= ( isset($_POST['newsFileAvant']) )? 		formatage_from_post($_POST['newsFileAvant']) : '';
	// ----------------------
	// Suppression de la Fiche dans la BD
	$delete_query 			= "DELETE FROM ".T_NEWS_ARTICLES." ".
							" WHERE news_id = :newsId;";
 	  try {
		$pdo_delete 		= $pdo->prepare($delete_query);
		$pdo_delete->bindValue(':newsId', 		$newsId,		PDO::PARAM_INT);
		$pdo_delete->execute();
		// -----------------
		$MsgValidOK 		= $MsgValidSupprimer;
		$validNews			= 1;
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
	// ----------------------
	// Suppression de la Photo du dossier
	if( $newsPhotoAvant!='' && file_exists('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant)) {
		unlink('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant);
	}
	// ----------------------
	// Suppression du Fichier du dossier
	if( $newsFileAvant!='' && file_exists('../../'.NEWS_REP_FILES.$newsFileAvant)) {
		unlink('../../'.NEWS_REP_FILES.$newsFileAvant);
	}
	// ----------------------
}
// -------------------------
unset($_POST);
