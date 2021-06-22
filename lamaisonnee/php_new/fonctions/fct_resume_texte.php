<?php
// ---------------------------------------------------
// FONCTIONS TRONCATURE DE TEXTE : RESUME BRUT ou HTML
// ---------------------------------------------------
// ---------------------------------------------------
// RESUME BRUT d'un texte (html ou non) : Suppression des balises html éventuelles
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// Création : juin 2009 en collectif : Xunil, jreaux62, s.n.a.f.u., christele_r, Doksuri, Patouche
// http://www.developpez.net/forums/d757484-8/php/langage/contribuez/discussion-reparer-code-html/
// ---------------------------------------------------
// $texte : $texte : le texte initial (avec ou sans des balise html)
// $nbreCar : le nombre de caractères texte à afficher (sans compter les balises html)
// $nbreCar (minimum) : pour ne pas couper un mot, le compte s'arretera à l'espace suivant
// ---------------------------------------------------
function texte_resume_brut( $texte, $nbreCar )
{
	$texte 						= trim(strip_tags($texte)); // suppression des balises HTML
	if( is_numeric($nbreCar) )
	{
		$PointSuspension		= '...'; // points de suspension (ou '' si vous n'en voulez pas)
		// ---------------------
		// COUPE DU TEXTE pour le RÉSUMÉ
		// ajout d'un espace de fin au cas où le texte n'en contiendrait pas...
		$texte					.= ' ';
		$LongueurAvant			= mb_strlen($texte);
		if( $LongueurAvant > $nbreCar ){
			// pour ne pas couper un mot, on va à l'espace suivant
			$texte 				= mb_substr($texte, 0, strpos($texte, ' ', $nbreCar));
			// On ajoute (ou pas) des points de suspension à la fin si le texte brut est plus long que $nbreCar
			if( !empty($PointSuspension) ){
				$texte			.= $PointSuspension;
			}
		}
		// ---------------------
	}
	// On renvoie le résumé du texte correctement formaté.
	return $texte;
};

// ---------------------------------------------------
// RÉSUMÉ BRUT d'un texte (HTML ou non) : en fonction du POURCENTAGE
// + Suppression des balises HTML éventuelles
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// Création : septembre 2013
// ---------------------------------------------------
// $texte : le texte initial (avec ou sans des balises HTML)
// $pourcentCar : le POURCENTAGE de caractères texte à afficher (sans compter les balises HTML)
// Pour ne pas couper un mot, le compte s'arrêtera à l'espace suivant
// ---------------------------------------------------
function texte_resume_brut_pourcent($texte, $pourcentCar)
{
	$texte 				= trim(strip_tags($texte));
	if(is_numeric($pourcentCar) && $pourcentCar>=0 && $pourcentCar<=100)
	{
		$PointSuspension		= '...';
		$texte					.= ' ';
		$LongueurAvant			= mb_strlen($texte);
		$nbreCar				= floor($LongueurAvant*$pourcentCar/100); // nombre de caractères en fonction du pourcentage
		if ($LongueurAvant > $nbreCar) {
			$texte 				= mb_substr($texte, 0, strpos($texte, ' ', $nbreCar));
			if ($PointSuspension!='') {
				$texte	.= $PointSuspension;
			}
		}
	}
	return $texte;
};

// ---------------------------------------------------
// RÉSUMÉ d'un texte HTML : en fonction du NOMBRE de CARACTERES
// + Réparation des balises HTML
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// Création : juin 2009 en collectif : Xunil, jreaux62, s.n.a.f.u., FoxLeRenard, Doksuri, Patouche
// http://www.developpez.net/forums/d757484-8/php/langage/contribuez/discussion-reparer-code-html/
// ---------------------------------------------------
// $texte : le texte formaté (avec des balises HTML)
// $nbreCar : le nombre de caractères texte à afficher (sans compter les balises HTML)
// $nbreCar (minimum) : pour ne pas couper un mot, le compte s'arrêtera à l'espace suivant
// ---------------------------------------------------
function texte_resume_html( $texte, $nbreCar )
{
	if( is_numeric($nbreCar) )
	{
		$PointSuspension		= '...'; // points de suspension (ou '' si vous ne voulez pas de points de suspension)
		// ---------------------
		// longueur du texte brut, sans HTML (avant traitement)
		$LongueurAvantSansHtml	= mb_strlen(trim(strip_tags($texte)));
		// ---------------------
		// MASQUE de l'expression régulière
		// ---------------------
		$MasqueHtmlSplit		= '#</?([a-zA-Z1-6]+)(?: +[a-zA-Z]+="[^"]*")*( ?/)?>#';
		$MasqueHtmlMatch		= '#<(?:/([a-zA-Z1-6]+)|([a-zA-Z1-6]+)(?: +[a-zA-Z]+="[^"]*")*( ?/)?)>#';
		// ---------------------
		// Explication du masque : recherche de TOUTES les balises HTML
		// ---------------
		// détail : </?([a-zA-Z1-6]+)
		// recherche de chaines commençant par un < 
		// suivi optionnellement d'un / (==> balises "fermantes")
		// suivi de (caractères alphabétiques (insensibles à la casse) ou numériques (1 à 6)) au moins une fois
		// Suivi optionnellement (0, 1 fois ou plus) par un ou plusieurs attributs et leur valeur :
		// ---------------
		// détail : (?: +[a-zA-Z]+="[^"]*")*
		// caractère espace une fois ou plus [space]+
		// suivi d'au moins un caractère alphabétique [a-zA-Z]+
		// suivi d'un =
		// suivi d'une paire de guillemets contenant optionnellement (0, 1 fois ou plus) tout caractère autre que guillemet "[^"]*"
		// ---------------
		// détail : ( ?/)?
		// caractère espace optionnel [space]?
		// suivi optionnellement d'un slash / (==> balises "orphelines")
		// NB : un :? suivant une parenthèse ouvrante signifie que l'on ne capture pas la parenthèse

		// ---------------------
		// RECHERCHE DU TEXTE DU RÉSUMÉ
		// ---------------------
		// ajout d'un espace de fin au cas où le texte n'en contiendrait pas...
		$texte					.= ' ';
		// ---------------------
		// Capture de tous les bouts de texte (en dehors des balises HTML)
		$BoutsTexte				= preg_split($MasqueHtmlSplit, $texte, -1,  PREG_SPLIT_OFFSET_CAPTURE | PREG_SPLIT_NO_EMPTY);
		// ---------------------
		// Explication preg_split : voir http://fr.php.net/manual/fr/function.preg-split.php
		// => on obtient un tableau (array) :
		// $BoutsTexte[xx][0] : le bout de texte
		// $BoutsTexte[xx][1] : sa position (dans la chaine)
		// ---------------------
		// Nombre d'éléments du tableau
		$NombreBouts			= count($BoutsTexte);

		// ---------------------
		// CALCUL de la POSITION de la coupe
		// ---------------------
		// Si seulement un seul élément dans l'array, c'est que le texte ne contient pas de balises :
		// on renvoie directement le texte tronqué
		if( $NombreBouts == 1 )
		{
			$texte				.= ' ';
			$LongueurAvant		= mb_strlen($texte);
			$texte 				= mb_substr($texte, 0, strpos($texte, ' ', $LongueurAvant > $nbreCar ? $nbreCar : $LongueurAvant));
			if( !empty($PointSuspension) && $LongueurAvant > $nbreCar ){
				$texte			.= $PointSuspension;
			}
		} else {
			// ---------------------
			// Variable contenant la longueur des bouts de texte
			$longueur				= 0;
			// ---------------------
			// (position du dernier élément du tableau $chaines)
			$indexDernierBout		= $NombreBouts - 1;
			// ---------------------
			// Position par défaut de la césure au cas où la longueur du texte serait inférieure au nombre de caractères à sélectionner
			// La position de la césure est égale à sa position [1] + la longueur du bout de texte [0] - 1 (dernier caractère)
			$position				= $BoutsTexte[$indexDernierBout][1] + mb_strlen($BoutsTexte[$indexDernierBout][0]) - 1;
			// ---------------------
			$indexBout				= $indexDernierBout;
			$rechercheEspace		= true;
			// ---------------------
			// Boucle parcourant l'array et ayant pour fonction d'incrémenter au fur et à mesure la longueur des morceaux de texte, 
			// et de calculer la position de césure de l'extrait dans le texte
			foreach( $BoutsTexte as $index => $bout )
			{
				$longueur += mb_strlen($bout[0]);
				// Si la longueur désirée de l'extrait à obtenir est atteinte
				if( $longueur >= $nbreCar )
				{
					 // On calcule la position de césure du texte (position de chaîne + sa longueur -1 )
					 $position_fin_bout = $bout[1] + mb_strlen($bout[0]) - 1;
					 // calcul de la position de césure
					 $position = $position_fin_bout - ($longueur - $nbreCar);
					 // On regarde si un espace est présent après la position dans le bout de texte
					 if( ($positionEspace = strpos($bout[0], ' ', $position - $bout[1])) !== false  )
					 {
							// Un espace est détecté dans le bout de texte APRÈS la position
							$position	= $bout[1] + $positionEspace;
							$rechercheEspace = false;
					 }
					 // Si on ne se trouve pas sur le dernier élément
					 if( $index != $indexDernierBout )
							$indexBout	= $index + 1;
					 break;
				}
			}
			// ---------------------
			// Donc il n'y avait pas d'espace dans le bout de texte où la position de césure sert de référence
			if( $rechercheEspace === true )
			{
				// Recherche d'un espace dans les bouts de texte suivants
				for( $i=$indexBout; $i<=$indexDernierBout; $i++ )
				{
					 $position = $BoutsTexte[$i][1];
					 if( ($positionEspace = strpos($BoutsTexte[$i][0], ' ')) !== false )
					 {
							$position += $positionEspace;
							break;
					 }
				}
			}
			// ---------------------
			// COUPE DU TEXTE pour le RÉSUMÉ
			// ---------------------
			// On effectue la césure sur le texte suivant la position calculée
			$texte					= mb_substr($texte, 0, $position);

			// ---------------------
			// RECHERCHE DES BALISES HTML
			// ---------------------
			// Récupération de toutes les balises du texte et de leur position (PREG_OFFSET_CAPTURE)
			preg_match_all($MasqueHtmlMatch, $texte, $retour, PREG_OFFSET_CAPTURE);
			// ---------------------
			// Explication preg_match_all : voir http://fr.php.net/manual/fr/function.preg-match-all.php
			// $retour[0][xx][0] contient la balise HTML entière
			// $retour[0][xx][1] contient la position de la balise HTML entière
			// $retour[1][xx][0] contient le nom de la balise HTML fermante $rechercheEspace
			// $retour[2][xx][0] contient le nom de la balise HTML ouvrante
			// $retour[3][xx][0] contient le slash de fermeture de balise unique (cette variable n'existe pas si la balise n'est pas unique)
			// ---------------------
			// Array destiné à enregistrer les noms de balises ouvrantes
			$BoutsTag				= array();
			// ---------------------
			foreach( $retour[0] as $index => $tag )
			{
				// Si on se trouve sur une balise unique, on passe au tour suivant
				if( isset($retour[3][$index][0]) )
				{
					 continue;
				}
				// Si le caractère slash n'est pas détecté en seconde position dans la balise entière, on est sur une balise ouvrante
				if( $retour[0][$index][0][1] != '/' )
				{
					 // On empile l'élément en début de l'array
					 array_unshift($BoutsTag, $retour[2][$index][0]);
				}
				// Donc balise fermante
				else
				{
					 // suppression du premier élément de l'array
					 array_shift($BoutsTag);
				}
			}
			// ---------------------
			// RÉPARATION des balises HTML
			// ---------------------
			// Il reste des tags à fermer ?
			// balises ouvertes, mais non fermées : on ajoute les balises fermantes à la fin du texte
			if( !empty($BoutsTag) )
			{
				foreach( $BoutsTag as $tag )
				{
					 $texte		.= '</'.$tag.'>';
				}
			}
			// ---------------------
			// On ajoute (ou pas) des points de suspension à la fin si le texte brut est plus long que $nbreCar
			if( !empty($PointSuspension) && $LongueurAvantSansHtml > $nbreCar ){
				// si les points de suspension sont après une(des) balise(s) fermante(s), 
				// on les "remonte" jusqu'à l'intérieur de la balise non-vide la plus proche (ici jusqu'à 5 niveaux de balises).
				// Explication du masque : ((</[^>]*>[\n\t\r ]*)?
				// </[^>]*>			: toute balise fermante
				// [\n\t\r ]*		: passage(s) à la ligne/tabulation(s)/espace(s)
				$texte				.= 'ReplacePointSuspension';
				$pattern			= '#((</[^>]*>[\n\t\r ]*)?(</[^>]*>[\n\t\r ]*)?(</[^>]*>[\n\t\r ]*)?(</[^>]*>[\n\t\r ]*)?(</[^>]*>)[\n\t\r ]*ReplacePointSuspension)#i';
				$texte				= preg_replace($pattern, $PointSuspension.'${2}${3}${4}${5}${6}', $texte);
			}
		}
	}
	// ---------------------
	// On renvoie le résumé du texte correctement formaté.
	return $texte;
};

// ---------------------------------------------------
// RÉSUMÉ d'un texte HTML : en fonction du POURCENTAGE de CARACTERES
// + Réparation des balises HTML
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// Création : septembre 2013
// ---------------------------------------------------
// $texte : le texte initial (avec ou sans des balises HTML)
// $pourcentCar : le POURCENTAGE de caractères texte à afficher (sans compter les balises HTML)
// Pour ne pas couper un mot, le compte s'arrêtera à l'espace suivant
// ---------------------------------------------------
function texte_resume_html_pourcent($texte, $pourcentCar)
{
	if(is_numeric($pourcentCar) && $pourcentCar>=0 && $pourcentCar<=100){
		$LongueurAvantSansHtml	= mb_strlen(trim(strip_tags($texte)));
		$nbreCar				= floor($LongueurAvantSansHtml*$pourcentCar/100); // nombre de caractères en fonction du pourcentage
		$texte					= texte_resume_html($texte, $nbreCar);
	}
	return $texte;
};
// ---------------------------------------------------
