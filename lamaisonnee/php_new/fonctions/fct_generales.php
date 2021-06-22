<?php // FONCTIONS GENERALES
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr

// --------------------------------------------------------------
// FONCTION : Creation d'un alphanumerique aleatoire
// --------------------------------------------------------------
function MakeRandomString($stringLength=8, $noCaps=false)
{
	if ($noCaps) { 	$chars = 'abchefghjkmnpqrstuvwxyz0123456789';
	} else { 		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	}
	$len = strlen( $chars );
	$rndString = '';
	for ( $i = 0; $i < $stringLength; $i++ ) {
		$rndString	.=	$chars[mt_rand( 0, $len - 1 )];
	}
	return $rndString;
};

// --------------------------------------------------------------
// FONCTION : FORMATAGE des données recupérées d'un FORMULAIRE
// --------------------------------------------------------------
function formatage_from_post($chaine)
{
	$chaine			= html_entity_decode(trim($chaine), ENT_QUOTES, 'UTF-8'); 		// convertit les entités HTML spéciales en caractères 
	$chaine 		= htmlspecialchars(stripslashes(trim($chaine)), ENT_NOQUOTES, 'UTF-8');
	$chaine 		= str_replace('&amp;','&',$chaine); // on garde l'&
	return $chaine;
};

// --------------------------------------------------------------
// FONCTION : FORMATAGE des données pour AFFICHAGE sur le site
// --------------------------------------------------------------
function formatage_affichage($chaine)
{
	$chaine 		= htmlspecialchars($chaine, ENT_QUOTES);
	// -------------
	// replacement : caractères "mal décodés" (< et >)
	$NON_array		= array('&amp;lt;','&amp;gt;');
	$OUI_array		= array('&lt;'    ,'&gt;');
	$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
	// -------------
	return $chaine;
};

// --------------------------------------------------------------
//  FONCTION : PROTECTION contre les failles XSS dans le html des TEXTAREA (EDITEUR WYSIWYG)
// --------------------------------------------------------------
function formatage_from_textarea($chaine) 
{
	$chaine			= stripslashes(trim($chaine));
	// convertit les entités HTML spéciales en caractères 
	$chaine			= html_entity_decode($chaine, ENT_QUOTES, 'UTF-8');
	// -------------
	// remplacement : lien vers nouvelle page
	$chaine			= str_replace(array('target=', '_blank'), array('onclick=', 'window.open(this.href); return false;'), $chaine);
	// -------------
	// balises qui seront conservees
	// (ajoutez ou supprimez des balises a votre convenance)
	$allowable_tags  = '<abbr><acronym><a><b><br><blockquote><cite><code><dl><dt><dd>';
	$allowable_tags .= '<em><strong><small><pre><u><ul><ol><li>';
	$allowable_tags .= '<div><i><img><h1><h2><h3><h4><h5><h6><hr><p><span>';						// titres
	$allowable_tags .= '<table><caption><legend><thead><tfoot><tbody><tr><th><td><colgroup><col>';	// tableau
	$allowable_tags .= '<audio><video><object><param><embed>';										// audio/video
	$chaine			= strip_tags($chaine, $allowable_tags);
	// -------------
	return $chaine;
};

// --------------------------------------------------------------
// FONCTION : RE-AFFICHAGE dans le TEXTAREA
// --------------------------------------------------------------
function formatage_to_textarea($chaine) 
{
	$chaine			= stripslashes(trim($chaine));
	$chaine			= html_entity_decode($chaine); 		// convertit les entités HTML spéciales en caractères 
	// -------------
	// replacement : caractères "dans le texte" (< et >, hors balises html)
	$NON_array		= array('&lt;'    ,'&gt;');
	$OUI_array		= array('&amp;lt;','&amp;gt;');
	$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
	// -------------
	return $chaine;
};

// --------------------------------------------------------------
// FONCTION : FORMATAGE de chaine sans accents
// --------------------------------------------------------------
function formatage_sans_accent($chaine)
{
	$chaine			= utf8_decode($chaine); 			// convertit une chaîne UTF-8 en ISO-8859-1
	$chaine			= html_entity_decode($chaine); 		// convertit les entités HTML spéciales en caractères 
	$chaine 		= trim($chaine);
	// -------------
	// remplacement : caractères accentués et espace
	$NON_array 		= array(
	'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ă', 'Ą',
	'Ç', 'Ć', 'Č', 'Œ',
	'Ď', 'Đ',
	'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ă', 'ą',
	'ç', 'ć', 'č', 'œ',
	'ď', 'đ',
	'È', 'É', 'Ê', 'Ë', 'Ę', 'Ě',
	'Ğ',
	'Ì', 'Í', 'Î', 'Ï', 'İ',
	'Ĺ', 'Ľ', 'Ł',
	'è', 'é', 'ê', 'ë', 'ę', 'ě',
	'ğ',
	'ì', 'í', 'î', 'ï', 'ı',
	'ĺ', 'ľ', 'ł',
	'Ñ', 'Ń', 'Ň',
	'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ő',
	'Ŕ', 'Ř',
	'Ś', 'Ş', 'Š',
	'ñ', 'ń', 'ň',
	'ò', 'ó', 'ô', 'ö', 'ø', 'ő',
	'ŕ', 'ř',
	'ś', 'ş', 'š',
	'Ţ', 'Ť',
	'Ù', 'Ú', 'Û', 'Ų', 'Ü', 'Ů', 'Ű',
	'Ý', 'ß',
	'Ź', 'Ż', 'Ž',
	'ţ', 'ť',
	'ù', 'ú', 'û', 'ų', 'ü', 'ů', 'ű',
	'ý', 'ÿ',
	'ź', 'ż', 'ž',
	'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р',
	'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'р',
	'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
	'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
	);
				 
	$OUI_array = array(
	'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'A', 'A',
	'C', 'C', 'C', 'CE',
	'D', 'D',
	'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'a', 'a',
	'c', 'c', 'c', 'ce',
	'd', 'd',
	'E', 'E', 'E', 'E', 'E', 'E',
	'G',
	'I', 'I', 'I', 'I', 'I',
	'L', 'L', 'L',
	'e', 'e', 'e', 'e', 'e', 'e',
	'g',
	'i', 'i', 'i', 'i', 'i',
	'l', 'l', 'l',
	'N', 'N', 'N',
	'O', 'O', 'O', 'O', 'O', 'O', 'O',
	'R', 'R',
	'S', 'S', 'S',
	'n', 'n', 'n',
	'o', 'o', 'o', 'o', 'o', 'o',
	'r', 'r',
	's', 's', 's',
	'T', 'T',
	'U', 'U', 'U', 'U', 'U', 'U', 'U',
	'Y', 'Y',
	'Z', 'Z', 'Z',
	't', 't',
	'u', 'u', 'u', 'u', 'u', 'u', 'u',
	'y', 'y',
	'z', 'z', 'z',
	'A', 'B', 'B', 'r', 'A', 'E', 'E', 'X', '3', 'N', 'N', 'K', 'N', 'M', 'H', 'O', 'N', 'P',
	'a', 'b', 'b', 'r', 'a', 'e', 'e', 'x', '3', 'n', 'n', 'k', 'n', 'm', 'h', 'o', 'p',
	'C', 'T', 'Y', 'O', 'X', 'U', 'u', 'W', 'W', 'b', 'b', 'b', 'E', 'O', 'R',
	'c', 't', 'y', 'o', 'x', 'u', 'u', 'w', 'w', 'b', 'b', 'b', 'e', 'o', 'r'
	);
		 
	$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
	// -------------
	return utf8_encode($chaine); // convertit une chaîne ISO-8859-1 en UTF-8
}

// --------------------------------------------------------------
// FONCTION : FORMATAGE du nom des FichierS (photos/videos/...) pour enregistrement dans DOSSIER
// --------------------------------------------------------------
function formatage_nom_fichier($chaine)
{
	$chaine			= utf8_decode($chaine); 			// convertit une chaîne UTF-8 en ISO-8859-1
	$chaine			= html_entity_decode($chaine); 		// convertit les entités HTML spéciales en caractères 
	$chaine 		= strtolower(stripslashes(trim($chaine)));
	$chaine			= strip_tags($chaine);				// suppression de toutes les balises éventuelles
	$chaine 		= trim($chaine);
	$chaine 		= trim($chaine,'.-+"\'?!,:;#*');	// suppression des ponctuations en bout de chaine
	// -------------
	// remplacement : caractères accentués et espace
	$chaine 		= formatage_sans_accent($chaine);
	// -------------
	// expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre par un tiret "-"
	$chaine 		= preg_replace('/([^.a-zA-Z0-9]+)/i', '-', $chaine);
	// -------------
	$NON_array		= array('&amp;', '&quot;', '&amp;quot;', '&lt;', '&gt;');
	$OUI_array		= array('&',    '',    '',    '',    '');
	$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
	// -------------
	$NON_array		= array(',', ':', '!', '?', '"', '\'', '&amp;', '  ');
	$OUI_array		= array('',  '',  '',  '',  '',  '',   '',      ' ');
	$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
	// -------------
	// remplacement : nettoyage final
	$NON_array		= array('----','---','--',' ','*');
	$OUI_array		= array('-',   '-',  '-', '', '');
	$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
	// -------------
	// Fichier :
	// raccourcir le nom si trop long (nom 50 caracères maxi + extension 5 caracères maxi)
	$chaine 		= (strlen($chaine)>50)? substr(pathinfo($chaine,PATHINFO_FILENAME), 0, 50).'.'.substr(pathinfo($chaine,PATHINFO_EXTENSION), 0, 5) : $chaine;
	// -------------
	$chaine 		= trim($chaine, '.-');
	$chaine 		= utf8_encode($chaine); // convertit une chaîne ISO-8859-1 en UTF-8
	return $chaine;
};

// --------------------------------------------------------------
// FONCTION : creation de LIEN WEB
// --------------------------------------------------------------
function fctsitewebURL($siteweb)
{
	$sitewebURL = $siteweb;
	if($siteweb!='') {
		if(strpos($siteweb, 'http://') === false) {
			$sitewebURL = 'http://'.$siteweb;
		}
	}
	return $sitewebURL;
};
// --------------------------
function fctsitewebLIEN($siteweb)
{
	$sitewebLIEN = $siteweb;
	if($siteweb!='') {
		$sitewebLIEN = '<a href="'.fctsitewebURL($siteweb).'" target="_blank" class="siteweb">'.$siteweb.'</a>';
	}
	return $sitewebLIEN;
};
// --------------------------
function fctsitewebIMG($siteweb)
{
	$sitewebIMG = '';
	if($siteweb!='') {
		$sitewebIMG = '<a href="'.fctsitewebURL($siteweb).'" target="_blank">';
	}
	return $sitewebIMG;
};

// --------------------------------------------------------------
// FONCTION : creation de LIEN EMAIL
// --------------------------------------------------------------
function fctemailLIEN($email)
{
	$emailLIEN = $email;
	if($email!='' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailLIEN = '<a href="mailto:'.$email.'" class="email">'.$email.'</a>';
	}
	return $emailLIEN;
};

// --------------------------------------------------------------
