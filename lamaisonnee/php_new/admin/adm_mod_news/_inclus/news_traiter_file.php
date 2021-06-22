<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// ADMIN : ARTICLES : TRAITEMENT du FICHIER
// ---------------------------------------------------
// RECUPERATION DES DONNEES DU FORMULAIRE
// FICHIER joint
	$newsFileAvant 			= ( !empty($_POST['newsFileAvant']) )? 			formatage_from_post($_POST['newsFileAvant']) : '';
	$newsFileDelete 		= ( !empty($_POST['newsFileDelete']) )? 		formatage_from_post($_POST['newsFileDelete']) : '';

	// -----------------
// Gestion des fichiers supprimes
if( $newsFileAvant!='' && $newsFileDelete=='ON')
{
	// Suppression de l'ancien FICHIER
	if( file_exists('../../'.NEWS_REP_FILES.$newsFileAvant)) {
		unlink('../../'.NEWS_REP_FILES.$newsFileAvant);
	}
	// -----------------
	// Suppression dans la base de donnees par UPDATE
	$update_query 			= "UPDATE ".T_NEWS_ARTICLES." ".
							" SET news_file 	= '' ".
							" WHERE news_id 	= :newsId;";
  try {
	$pdo_update 			= $pdo->prepare($update_query);
	$pdo_update->bindValue(':newsId', 		$newsId,		PDO::PARAM_INT);
	$pdo_update->execute();
  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
	// -----------------
}

// ----------------------------------
// VERIFICATION / TRAITEMENT de la photo si uploadee
// ----------------------------------
$msgErreurFile 				= ''; // message d erreur
$traiterFilerOK 			= true; // (par defaut)

// -----------------
if( isset($_FILES['newsFile']) && $_FILES['newsFile']['size'] > 0 )
{
	// -------------------------------------
	// extension du fichier uploadé (en minuscule)
	$file_Extension 		= strtolower(pathinfo($_FILES['newsFile']['name'],PATHINFO_EXTENSION));

	// Type MIME réel du fichier (important : évite les fichiers NON valides, dont l'extension a été renommée)
//	$finfo 					= new finfo(FILEINFO_MIME_TYPE, NULL); // Retourne le type mime
//	$file_MimeType 			= $finfo->file($_FILES['newsFile']['tmp_name']);

	// (alternative, si la CLASS finfo n'est pas supportée)
	$finfo 					= finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à la extension mimetype
	$file_MimeType 			= finfo_file($finfo, $_FILES['newsFile']['tmp_name']);
	finfo_close($finfo);

	// -------------------------------------
	// GESTION DES ERREURS
	// -------------------------------------
	// on vérifie les RESTRICTIONS sur les fichiers
	if( UPLOAD_ERR_OK<>0 && UPLOAD_ERR_FORM_SIZE==2) {
		$msgErreurFile 		.= 'Taille du fichier trop importante ('.NEWS_SIZEMAX_FILE.' octets)<br />';
		$traiterFilerOK 	= false;
	}
	// -----------------
	// on vérifie la TAILLE MAXI
	elseif( $_FILES['newsFile']['size'] > NEWS_SIZEMAX_FILE) {
		$msgErreurFile 		.= 'Taille de fichier supérieure à la taille maxi autorisée ('.NEWS_SIZEMAX_FILE.' octets)<br />';
		$traiterFilerOK 	= false;
	}
	// -----------------
	// on vérifie l'EXTENSION
	elseif( !in_array($file_Extension, explode(',', constant('NEWS_EXTENSION_FILE')))) {
		$msgErreurFile 		.= 'L\'extension ne correspond pas (Extensions acceptées  : <b>'.constant('NEWS_EXTENSION_FILE').'</b>)<br />';
		if( in_array($file_MimeType, explode(',', constant('NEWS_MIMETYPE_FILE')))) {
		  $msgErreurFile 	.= '<b>Attention</b> : Ce fichier est peut-être corrompu !<br />';
		  $msgErreurFile 	.= 'L\'extension ne correspond pas au type MIME !<br />';
		}
		$traiterFilerOK 	= false;
	}
	// -----------------
	// on vérifie le TYPE MIME
	elseif( !in_array($file_MimeType, explode(',', constant('NEWS_MIMETYPE_FILE')))) {
		$msgErreurFile 		.= 'Le type MIME ne correspond pas (Extensions acceptées  : <b>'.constant('NEWS_EXTENSION_FILE').'</b>)<br />';
		if( in_array($file_Extension, explode(',', constant('NEWS_EXTENSION_FILE')))) {
		  $msgErreurFile 	.= '<b>Attention</b> : Ce fichier est peut-être corrompu !<br />';
		  $msgErreurFile 	.= 'L\'extension ne correspond pas au type MIME !<br />';
		}
		$traiterFilerOK 	= false;
	}
	// -----------------
	if( $traiterFilerOK===false) {
		$msgErreurFile 	= '<b>Erreur (Fichier)</b> :<br />'.$msgErreurFile.'Impossible d\'enregistrer le fichier.';
	}
	// -------------------------------------
	// si pas d'erreur : TRAITEMENT
	// -------------------------------------
	if( $traiterFilerOK===true)
	{
		// --------------------
		$file_Upload = '';
		// enregistement du FICHIER sous forme id-nom-fichier.pdf
		// NB : id etant unique (auto-increment), cela rend le nom du fichier unique
		$file_Upload 		= $newsId.'-'.$_FILES['newsFile']['name'];
		$file_Upload 		= formatage_nom_fichier($file_Upload);	// remplacement des caracteres speciaux + tout en minuscules
		// --------------------
		// enregistrement du FICHIER dans le dossier
		$temp = $_FILES['newsFile']['tmp_name'];
		move_uploaded_file($temp, '../../'.NEWS_REP_FILES.$file_Upload);
		// --------------------
		// SUPPRESSION de l ANCIENNE fiche PDF (si necessaire)
		if( $newsFileAvant!='' && $newsFileAvant!=$file_Upload)
		{
			if( file_exists('../../'.NEWS_REP_FILES.$newsFileAvant)) {
				unlink('../../'.NEWS_REP_FILES.$newsFileAvant);
			}
		}
		// -----------------
		// enregistrement du NOM dans la base de donnees par UPDATE
		$update_query 		= "UPDATE ".T_NEWS_ARTICLES." SET ".
							" news_file 			= :file_Upload ".
							" WHERE news_id 		= :newsId;";
	  try {
		$pdo_update 		= $pdo->prepare($update_query);
		$pdo_update->bindValue(':file_Upload', 		$file_Upload,		PDO::PARAM_STR);
		$pdo_update->bindValue(':newsId', 			$newsId,			PDO::PARAM_INT);
		$pdo_update->execute();
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
		// -----------------
	}

} // fin TRAITEMENT FICHIER
// ---------------------------------------------------
