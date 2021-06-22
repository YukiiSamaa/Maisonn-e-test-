<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// ADMIN NEWS : TRAITEMENT des photos
// ---------------------------------------------------
// RECUPERATION DES DONNEES DU FORMULAIRE
// photo
	$newsPhotoLargeur 		= ( !empty($_POST['newsPhotoLargeur']) )? 		formatage_from_post($_POST['newsPhotoLargeur']) : '';
	// -----------------
	// enregistrement de la LARGEUR dans la base de donnees par UPDATE
	$update_query 		= "UPDATE ".T_NEWS_ARTICLES." SET ".
						" news_photo_largeur	= :newsPhotoLargeur ".
						" WHERE news_id 		= :newsId;";
  try {
	$pdo_update 		= $pdo->prepare($update_query);
	$pdo_update->bindValue(':newsPhotoLargeur', $newsPhotoLargeur,	PDO::PARAM_INT);
	$pdo_update->bindValue(':newsId', 			$newsId,			PDO::PARAM_INT);
	$pdo_update->execute();
  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }

	// -----------------
	$newsPhotoAvant 		= ( !empty($_POST['newsPhotoAvant']) )? 		formatage_from_post($_POST['newsPhotoAvant']) : '';
	$newsPhotoDelete 		= ( !empty($_POST['newsPhotoDelete']) )? 		formatage_from_post($_POST['newsPhotoDelete']) : '';

// -----------------
// Gestion des photos supprimees
if( $newsPhotoAvant!='' && $newsPhotoDelete=='ON')
{
	// Suppression de l'ancienne Photo
	if( file_exists('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant)) {
		unlink('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant);
	}
	// -----------------
	// Suppression dans la base de donnees par UPDATE
	$update_query 			= "UPDATE ".T_NEWS_ARTICLES." ".
							" SET news_photo 	= '' ".
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
$msgErreurPhoto 			= ''; 	// message d erreur
$traiterPhotoOK 			= true; // (par defaut)

if( isset($_FILES['newsPhoto']) && $_FILES['newsPhoto']['size'] > 0 )
{
	// -------------------------------------
	// extension du fichier uploadé (en minuscule)
	$file_Extension 		= strtolower(pathinfo($_FILES['newsPhoto']['name'],PATHINFO_EXTENSION));

	// Type MIME réel du fichier (important : évite les fichiers NON valides, dont l'extension a été renommée)
//	$finfo 					= new finfo(FILEINFO_MIME_TYPE, NULL); // Retourne le type mime
//	$file_MimeType 			= $finfo->file($_FILES['newsPhoto']['tmp_name']);

	// (alternative, si la CLASS finfo n'est pas supportée)
	$finfo 					= finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à la extension mimetype
	$file_MimeType 			= finfo_file($finfo, $_FILES['newsPhoto']['tmp_name']);
	finfo_close($finfo);

	// -------------------------------------
	// GESTION DES ERREURS
	// -------------------------------------
	// on vérifie les RESTRICTIONS sur les fichiers
	if( UPLOAD_ERR_OK<>0 && UPLOAD_ERR_FORM_SIZE==2) {
		$msgErreurPhoto 	.= 'Taille de fichier trop important ('.NEWS_SIZEMAX_PHOTO.' octets)<br />';
		$traiterPhotoOK 	= false;
	}
	// -----------------
	// on vérifie la TAILLE MAXI
	elseif( $_FILES['newsPhoto']['size'] > NEWS_SIZEMAX_PHOTO) {
		$msgErreurPhoto 	.= 'Taille de fichier supérieure à la taille maxi autorisée ('.NEWS_SIZEMAX_PHOTO.' octets)<br />';
		$traiterPhotoOK 	= false;
	}
	// -----------------
	// on vérifie l'EXTENSION
	elseif( !in_array($file_Extension, explode(',', constant('NEWS_EXTENSION_PHOTO')))) {
		$msgErreurPhoto 	.= 'L\'extension ne correspond pas (Extensions acceptées  : <b>'.constant('NEWS_EXTENSION_PHOTO').'</b>)<br />';
		if( in_array($file_MimeType, explode(',', constant('NEWS_MIMETYPE_PHOTO')))) {
		  $msgErreurPhoto 	.= '<b>Attention</b> : Ce fichier est peut-être corrompu !<br />';
		  $msgErreurPhoto 	.= 'L\'extension ne correspond pas au type MIME !<br />';
		}
		$traiterPhotoOK 	= false;
	}
	// -----------------
	// on vérifie le TYPE MIME
	elseif( !in_array($file_MimeType, explode(',', constant('NEWS_MIMETYPE_PHOTO')))) {
		$msgErreurPhoto 	.= 'Le type MIME ne correspond pas (Extensions acceptées  : <b>'.constant('NEWS_EXTENSION_PHOTO').'</b>)<br />';
		if( in_array($file_Extension, explode(',', constant('NEWS_EXTENSION_PHOTO')))) {
		  $msgErreurPhoto 	.= '<b>Attention</b> : Ce fichier est peut-être corrompu !<br />';
		  $msgErreurPhoto 	.= 'L\'extension ne correspond pas au type MIME !<br />';
		}
		$traiterPhotoOK 	= false;
	}
	// -----------------
	if( $traiterPhotoOK===false) {
		$msgErreurPhoto 	= '<b>Erreur (Photo)</b> :<br />'.$msgErreurPhoto.'Impossible d\'enregistrer le fichier.';
	}
	// -------------------------------------
	// si pas d'erreur : TRAITEMENT
	// -------------------------------------
	if( $traiterPhotoOK===true)
	{
		// --------------------
		// enregistement de la PHOTO sous forme id_nom-image(.jpg, ...)
		// NB : id etant unique (auto-increment), cela rend le nom de la photo unique
		$file_Upload 		= $newsId.'_'.$_FILES['newsPhoto']['name'];
		$file_Upload 		= formatage_nom_fichier($file_Upload); // remplacement des caracteres speciaux + tout en minuscules
		$file_Upload 		= str_replace('.jpeg','.jpg',$file_Upload); // on remplace aussi .jpeg par .jpg
		// --------------------
		// enregistrement de la photo dans le dossier
		$temp = $_FILES['newsPhoto']['tmp_name'];
		move_uploaded_file($temp, '../../'.NEWS_REP_PHOTOS.$file_Upload);
		// --------------------
		// REDIMENSIONNEMENT et SAUVEGARDE de la PHOTO (si necessaire)
		// ecraser (remplacer) la photo (meme rep, meme nom)
		$redimPHOTOOK 		= fctredimimage(NEWS_LARGEUR_PHOTO,0,'','','../../'.NEWS_REP_PHOTOS,$file_Upload);
		// --------------------
		// SUPPRESSION des ANCIENNES PHOTOS (si necessaire) dans le dossier
		if( $newsPhotoAvant!='' && $newsPhotoAvant!=$file_Upload)
		{
			if( file_exists('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant)) {
				unlink('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant);
			}
		}
		// -----------------
		// enregistrement du NOM dans la base de donnees par UPDATE
		$update_query 		= "UPDATE ".T_NEWS_ARTICLES." SET ".
							" news_photo 			= :file_Upload ".
							" WHERE news_id 		= :newsId;";
	  try {
		$pdo_update 		= $pdo->prepare($update_query);
		$pdo_update->bindValue(':file_Upload', 		$file_Upload,		PDO::PARAM_STR);
		$pdo_update->bindValue(':newsId', 			$newsId,			PDO::PARAM_INT);
		$pdo_update->execute();
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
		// -----------------
	}

} // fin TRAITEMENT PHOTO
// ---------------------------------------------------
