<?php
// ---------------------------------------------------
// TOUTES LES FONCTIONS DE REDIMENSIONNEMENT D'IMAGES
// ---------------------------------------------------

// ---------------------------------------------------
// Fonction de redimensionnement A L'AFFICHAGE
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------
// La FONCTION : fctaffichimage($img_Src, $W_max, $H_max)
// Les paramètres :
// - $img_Src : URL (chemin + NOM) de l'image Source
// - $W_max : LARGEUR maxi finale ----> ou 0 : largeur libre
// - $H_max : HAUTEUR maxi finale ----> ou 0 : hauteur libre
// ---------------------
// Affiche : src="..." width="..." height="..." pour la balise img
// Utilisation :
// &lt;img alt=&quot;&quot; &lt;?php fctaffichimage('repimg/monimage.jpg', 120, 100) ?&gt; /&gt;
// ---------------------------------------------------
function fctaffichimage($img_Src, $W_max, $H_max) {

 if (file_exists($img_Src)) {
   // ---------------------
   // Lit les dimensions de l'image source
   $img_size = getimagesize($img_Src);
   $W_Src = $img_size[0]; // largeur source
   $H_Src = $img_size[1]; // hauteur source
   // ---------------------
   if(!$W_max) { $W_max = 0; }
   if(!$H_max) { $H_max = 0; }
   // ---------------------
   // Teste les dimensions tenant dans la zone
   $W_test = round($W_Src * ($H_max / $H_Src));
   $H_test = round($H_Src * ($W_max / $W_Src));
   // ---------------------
   // si l'image est plus petite que la zone
   if($W_Src<$W_max && $H_Src<$H_max) {
      $W = $W_Src;
      $H = $H_Src;
   // sinon si $W_max et $H_max non definis
   } elseif($W_max==0 && $H_max==0) {
      $W = $W_Src;
      $H = $H_Src;
   // sinon si $W_max libre
   } elseif($W_max==0) {
      $W = $W_test;
      $H = $H_max;
   // sinon si $H_max libre
   } elseif($H_max==0) {
      $W = $W_max;
      $H = $H_test;
   // sinon les dimensions qui tiennent dans la zone
   } elseif($H_test > $H_max) {
      $W = $W_test;
      $H = $H_max;
   } else {
      $W = $W_max;
      $H = $H_test;
   }
   // ---------------------
 } else { // si le fichier image n existe pas
      $W = 0;
      $H = 0;
 }
 // ---------------------------------------------------
 // Affiche : src="..." width="..." height="..." pour la balise img
 echo ' src="'.$img_Src.'" width="'.$W.'" height="'.$H.'"';
 // ---------------------------------------------------
};

// ---------------------------------------------------
// Fonction de REDIMENSIONNEMENT physique "PROPORTIONNEL" et Enregistrement
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------
// retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
// ---------------------
// La FONCTION : fctredimimage ($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
// Les paramètres :
// - $W_max : LARGEUR maxi finale --> ou 0
// - $H_max : HAUTEUR maxi finale --> ou 0
// - $rep_Dst : repertoire de l'image de Destination (déprotégé) --> ou '' (même répertoire)
// - $img_Dst : NOM de l'image de Destination --> ou '' (même nom que l'image Source)
// - $rep_Src : repertoire de l'image Source (déprotégé)
// - $img_Src : NOM de l'image Source
// ---------------------
// 3 options :
// A- si $W_max!=0 et $H_max!=0 : a LARGEUR maxi ET HAUTEUR maxi fixes
// B- si $H_max!=0 et $W_max==0 : image finale a HAUTEUR maxi fixe (largeur auto)
// C- si $W_max==0 et $H_max!=0 : image finale a LARGEUR maxi fixe (hauteur auto)
// Si l'image Source est plus petite que les dimensions indiquées : PAS de redimensionnement.
// ---------------------
// $rep_Dst : il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod)
// - si $rep_Dst = ''   : $rep_Dst = $rep_Src (même répertoire que l'image Source)
// - si $img_Dst = '' : $img_Dst = $img_Src (même nom que l'image Source)
// - si $rep_Dst='' ET $img_Dst='' : on ecrase (remplace) l'image source !
// ---------------------
// NB : $img_Dst et $img_Src doivent avoir la meme extension (meme type mime) !
// Extensions acceptées (traitees ici) : .jpg , .jpeg , .png
// Pour Ajouter d autres extensions : voir la bibliotheque GD ou ImageMagick
// (GD) NE fonctionne PAS avec les GIF ANIMES ou a fond transparent !
// ---------------------
// UTILISATION (exemple) :
// $redimOK = fctredimimage(120,80,'reppicto/','monpicto.jpg','repimage/','monimage.jpg');
// if ($redimOK==true) { echo 'Redimensionnement OK !';  }
// ---------------------------------------------------
function fctredimimage($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
 $condition = 0;
 // Si certains paramètres ont pour valeur '' :
 if ($rep_Dst=='') { $rep_Dst = $rep_Src; } // (même répertoire)
 if ($img_Dst=='') { $img_Dst = $img_Src; } // (même nom)
 // ---------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src) && ($W_max!=0 || $H_max!=0)) { 
   // ----------------------
   // extensions acceptées : 
	$extension_Allowed = 'jpg,jpeg,png';	// (sans espaces)
   // extension fichier Source
	$extension_Src = strtolower(pathinfo($img_Src,PATHINFO_EXTENSION));
   // ----------------------
   // extension OK ? on continue ...
   if(in_array($extension_Src, explode(',', $extension_Allowed))) {
     // ------------------------
      // récupération des dimensions de l'image Src
      $img_size = getimagesize($rep_Src.$img_Src);
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // ------------------------------------------------
      // condition de redimensionnement et dimensions de l'image finale
      // ------------------------------------------------
      // A- LARGEUR ET HAUTEUR maxi fixes
      if ($W_max!=0 && $H_max!=0) {
         $ratiox = $W_Src / $W_max; // ratio en largeur
         $ratioy = $H_Src / $H_max; // ratio en hauteur
         $ratio = max($ratiox,$ratioy); // le plus grand
         $W = $W_Src/$ratio;
         $H = $H_Src/$ratio;   
         $condition = ($W_Src > $W) || ($H_Src > $H); // 1 si vrai (true)
      }
      // ------------------------
      // B- HAUTEUR maxi fixe
      if ($W_max==0 && $H_max!=0) {
         $H = $H_max;
         $W = $H * ($W_Src / $H_Src);
         $condition = ($H_Src > $H_max); // 1 si vrai (true)
      }
      // ------------------------
      // C- LARGEUR maxi fixe
      if ($W_max!=0 && $H_max==0) {
         $W = $W_max;
         $H = $W * ($H_Src / $W_Src);         
         $condition = ($W_Src > $W_max); // 1 si vrai (true)
      }
      // ------------------------------------------------
      // REDIMENSIONNEMENT si la condition est vraie
      // ------------------------------------------------
      // - Si l'image Source est plus petite que les dimensions indiquées :
      // Par defaut : PAS de redimensionnement.
      // - Mais on peut "forcer" le redimensionnement en ajoutant ici :
      // $condition = 1; (risque de perte de qualité)
      if ($condition==1) {
         // ---------------------
         // creation de la ressource-image "Src" en fonction de l extension
         switch($extension_Src) {
         case 'jpg':
         case 'jpeg':
           $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
           break;
         case 'png':
           $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
           break;
         }
         // ---------------------
         // creation d une ressource-image "Dst" aux dimensions finales
         // fond noir (par defaut)
         switch($extension_Src) {
         case 'jpg':
         case 'jpeg':
           $Ress_Dst = imagecreatetruecolor($W,$H);
           break;
         case 'png':
           $Ress_Dst = imagecreatetruecolor($W,$H);
           // fond transparent (pour les png avec transparence)
           imagesavealpha($Ress_Dst, true);
           $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
           imagefill($Ress_Dst, 0, 0, $trans_color);
           break;
         }
         // ------------------------------------------------
         // REDIMENSIONNEMENT (copie, redimensionne, re-echantillonne)
         imagecopyresampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src); 
         // ------------------------------------------------
         // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
         switch ($extension_Src) { 
         case 'jpg':
         case 'jpeg':
           imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         case 'png':
           imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         }
         // ------------------------
         // liberation des ressources-image
         imagedestroy ($Ress_Src);
         imagedestroy ($Ress_Dst);
         // ------------------------
     }
   }
 }
 // ---------------------------------------------------
 // retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
 if ($condition==1 && file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
 // ---------------------------------------------------
};

// ---------------------------------------------------
// fonction de REDIMENSIONNEMENT physique "NON-PROPORTIONNEL" et Enregistrement
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------
// retourne : 1 (vrai) si le redimensionnement et l'enregistrement ont bien eu lieu, sinon rien (false)
// ---------------------// La FONCTION : fctdeformimage ($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
// Les paramètres :
// - $W_fin : LARGEUR finale --> ou 0
// - $H_fin : HAUTEUR finale --> ou 0
// - $rep_Dst : repertoire de l'image de Destination (déprotégé) --> ou '' (même répertoire)
// - $img_Dst : NOM de l'image de Destination --> ou '' (même nom que l'image Source)
// - $rep_Src : repertoire de l'image Source (déprotégé)
// - $img_Src : NOM de l'image Source
// ------------------------
// 3 options :
// A- si $W_fin != 0 et $H_fin != 0 : image finale a LARGEUR ET HAUTEUR fixes
// B- si $H_fin != 0 et $W_fin == 0 : image finale a HAUTEUR fixe (largeur auto)
// C- si $W_fin == 0 et $H_fin != 0 : image finale a LARGEUR fixe (hauteur auto)
// Dans TOUS les cas : redimensionnement non-proportionnel
// ------------------------
// $rep_Dst : il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod)
// - si $rep_Dst = ''   : $rep_Dst = $rep_Src (même répertoire que l'image Source)
// - si $img_Dst = '' : $img_Dst = $img_Src (même nom que l'image Source)
// - si $rep_Dst='' ET $img_Dst='' : on ecrase (remplace) l'image source !
// ------------------------
// NB : $img_Dst et $img_Src doivent avoir la meme extension (meme type mime) !
// Extensions acceptées (traitees ici) : .jpg , .jpeg , .png
// Pour ajouter d autres extensions : voir la bibliotheque GD ou ImageMagick
// (GD) NE fonctionne PAS avec les GIF ANIMES ou a fond transparent !
// ------------------------
// UTILISATION (exemple) :
// $deformOK = fctredimimage(120,80,'reppicto/','monpicto.jpg','repimage/','monimage.jpg');
// if ($deformOK == 1) { echo 'Redimensionnement OK !';  }
// ---------------------------------------------------
function fctdeformimage($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
   // Si certains paramètres ont pour valeur '' :
   if ($rep_Dst == '') { $rep_Dst = $rep_Src; } // (même répertoire)
   if ($img_Dst == '') { $img_Dst = $img_Src; } // (même nom)
 // ------------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src) && ($W_fin!=0 || $H_fin!=0)) { 
   // ------------------------
   // extensions acceptées : 
	$extension_Allowed = 'jpg,jpeg,png';	// (sans espaces)
   // extension fichier Source
	$extension_Src = strtolower(pathinfo($img_Src,PATHINFO_EXTENSION));
   // ------------------------
   // extension OK ? on continue ...
   if(in_array($extension_Src, explode(',', $extension_Allowed))) {
      // ------------------------
      // récupération des dimensions de l'image Src
      $img_size = getimagesize($rep_Src.$img_Src);
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // ------------------------
      // condition de redimensionnement et dimensions de l'image finale
      // Dans TOUS les cas : redimensionnement non-proportionnel
      // ------------------------
      // A- LARGEUR ET HAUTEUR fixes
      if ($W_fin != 0 && $H_fin != 0) {
         $W = $W_Src;
         $H = $H_Src;
      }
      // ------------------------
      // B- HAUTEUR fixe
      if ($W_fin == 0 && $H_fin != 0) {
         $W = $W_Src;
         $H = $H_fin;
      }
      // ------------------------
      // C- LARGEUR fixe
      if ($W_fin != 0 && $H_fin == 0) {
         $W = $W_fin;
         $H = $H_Src;
      }
      // ------------------------------------------------
      // REDIMENSIONNEMENT
      // ------------------------------------------------
      // creation de la ressource-image "Src" en fonction de l extension
      switch($extension) {
      case 'jpg':
      case 'jpeg':
        $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
        break;
      case 'png':
        $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
        break;
      }
      // ------------------------
      // creation d une ressource-image "Dst" aux dimensions finales
      // fond noir (par defaut)
      switch($extension) {
      case 'jpg':
      case 'jpeg':
        $Ress_Dst = imagecreatetruecolor($W,$H);
        break;
      case 'png':
        $Ress_Dst = imagecreatetruecolor($W,$H);
        // fond transparent (pour les png avec transparence)
        imagesavealpha($Ress_Dst, true);
        $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
        imagefill($Ress_Dst, 0, 0, $trans_color);
        break;
      }
      // ------------------------------------------------
      // REDIMENSIONNEMENT (copie, redimensionne, re-echantillonne)
      imagecopyresampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src); 
      // ------------------------------------------------
      // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
      switch ($extension) { 
      case 'jpg':
      case 'jpeg':
        imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
        break;
      case 'png':
        imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
        break;
      }
      // ------------------------
      // liberation des ressources-image
      imagedestroy ($Ress_Src);
      imagedestroy ($Ress_Dst);
      // ------------------------
   }
 }
 // ---------------------------------------------------
 // retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
 if (file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
 // ---------------------------------------------------
};

// ---------------------------------------------------
// Fonction de REDIMENSIONNEMENT physique "CROP CENTRE" et Enregistrement
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------
// retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
// ---------------------
// La FONCTION : fctcropimage ($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
// Les paramètres :
// - $W_fin : LARGEUR finale --> ou 0
// - $H_fin : HAUTEUR finale --> ou 0
// - $rep_Dst : repertoire de l'image de Destination (déprotégé) --> ou ''
// - $img_Dst : NOM de l'image de Destination --> ou ''
// - $rep_Src : repertoire de l'image Source (déprotégé)
// - $img_Src : NOM de l'image Source
// ---------------------
// 4 options :
// A- si $W_fin!=0 et $H_fin!=0 : crop aux dimensions indiquées
// B- si $W_fin==0 et $H_fin!=0 : crop en HAUTEUR (meme largeur que la source)
// C- si $W_fin!=0 et $H_fin==0 : crop en LARGEUR (meme hauteur que la source)
// D- si $W_fin==0 et $H_fin==0 : (special) crop "carre" a la plus petite dimension de l'image source
// ---------------------
// $rep_Dst : il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod)
// - si $rep_Dst = '' --> $rep_Dst = $rep_Src (même répertoire que le repertoire Source)
// - si $img_Dst = '' --> $img_Dst = $img_Src (même nom que l'image Source)
// - si $rep_Dst = '' ET $img_Dst = '' --> on ecrase (remplace) l'image source ($img_Src) !
// ---------------------
// NB : $img_Dst et $img_Src doivent avoir la meme extension (meme type mime) !
// Extensions acceptées (traitees ici) : .jpg , .jpeg , .png
// Pour Ajouter d autres extensions : voir la bibliotheque GD ou ImageMagick
// (GD) NE fonctionne PAS avec les GIF ANIMES ou a fond transparent !
// ---------------------
// UTILISATION (exemple) :
// $cropOK = fctcropimage(120,80,'reppicto/','monpicto.jpg','repimage/','monimage.jpg');
// if ($cropOK==true) { echo 'Crop centré OK !';  }
// ---------------------
function fctcropimage($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
 // ---------------------
 $condition = 0;
 // Si certains paramètres ont pour valeur '' :
   if ($rep_Dst=='') { $rep_Dst = $rep_Src; } // (même répertoire)
   if ($img_Dst=='') { $img_Dst = $img_Src; } // (même nom)
 // ---------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src)) { 
   // ----------------------
   // extensions acceptées : 
	$extension_Allowed = 'jpg,jpeg,png';	// (sans espaces)
   // extension fichier Source
	$extension_Src = strtolower(pathinfo($img_Src,PATHINFO_EXTENSION));
   // ----------------------
   // extension OK ? on continue ...
   if(in_array($extension_Src, explode(',', $extension_Allowed))) {
      // ------------------------
      // récupération des dimensions de l'image Source
      $img_size = getimagesize($rep_Src.$img_Src);
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // ------------------------------------------------
      // condition de crop et dimensions de l'image finale
      // ------------------------------------------------
      // A- crop aux dimensions indiquées
      if ($W_fin!=0 && $H_fin!=0) {
         $W = $W_fin;
         $H = $H_fin;
      }      // ------------------------
      // B- crop en HAUTEUR (meme largeur que la source)
      if ($W_fin==0 && $H_fin!=0) {
         $H = $H_fin;
         $W = $W_Src;
      }
      // ------------------------
      // C- crop en LARGEUR (meme hauteur que la source)
      if ($W_fin!=0 && $H_fin==0) {
         $W = $W_fin;
         $H = $H_Src;         
      }
      // D- crop "carre" a la plus petite dimension de l'image source
      if ($W_fin==0 && $H_fin==0) {
        if ($W_Src >= $H_Src) {
         $W = $H_Src;
         $H = $H_Src;
        } else {
         $W = $W_Src;
         $H = $W_Src;
        }   
      }
      // ------------------------
      // creation de la ressource-image "Src" en fonction de l extension
      switch($extension_Src) {
      case 'jpg':
      case 'jpeg':
         $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
         break;
      case 'png':
         $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
         break;
      }
      // ---------------------
      // creation d une ressource-image "Dst" aux dimensions finales
      // fond noir (par defaut)
      switch($extension_Src) {
      case 'jpg':
      case 'jpeg':
         $Ress_Dst = imagecreatetruecolor($W,$H);
         // fond blanc
         $blanc = imagecolorallocate ($Ress_Dst, 255, 255, 255);
         imagefill ($Ress_Dst, 0, 0, $blanc);
         break;
      case 'png':
         $Ress_Dst = imagecreatetruecolor($W,$H);
         // fond transparent (pour les png avec transparence)
         imagesavealpha($Ress_Dst, true);
         $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
         imagefill($Ress_Dst, 0, 0, $trans_color);
         break;
      }
      // ------------------------
      // CENTRAGE du crop
      // coordonnees du point d origine Scr : $X_Src, $Y_Src
      // coordonnees du point d origine Dst : $X_Dst, $Y_Dst
      // dimensions de la portion copiee : $W_copy, $H_copy
      // ------------------------
      // CENTRAGE en largeur
      if ($W_fin==0) {
         if ($H_fin==0 && $W_Src < $H_Src) {
            $X_Src = 0;
            $X_Dst = 0;
            $W_copy = $W_Src;
         } else {
            $X_Src = 0;
            $X_Dst = ($W - $W_Src) /2;
            $W_copy = $W_Src;
         }
      } else {
         if ($W_Src > $W) {
            $X_Src = ($W_Src - $W) /2;
            $X_Dst = 0;
            $W_copy = $W;
         } else {
            $X_Src = 0;
            $X_Dst = ($W - $W_Src) /2;
            $W_copy = $W_Src;
         }
      }
      // ------------------------
      // CENTRAGE en hauteur
      if ($H_fin==0) {
         if ($W_fin==0 && $H_Src < $W_Src) {
            $Y_Src = 0;
            $Y_Dst = 0;
            $H_copy = $H_Src;
         } else {
            $Y_Src = 0;
            $Y_Dst = ($H - $H_Src) /2;
            $H_copy = $H_Src;
         }
      } else {
         if ($H_Src > $H) {
            $Y_Src = ($H_Src - $H) /2;
            $Y_Dst = 0;
            $H_copy = $H;
         } else {
            $Y_Src = 0;
            $Y_Dst = ($H - $H_Src) /2;
            $H_copy = $H_Src;
         }
      }
      // ------------------------------------------------
      // CROP par copie de la portion d image selectionnee
		imagecopyresampled($Ress_Dst,$Ress_Src,$X_Dst,$Y_Dst,$X_Src,$Y_Src,$W_copy,$H_copy,$W_copy,$H_copy);
      // ------------------------------------------------
      // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
      switch ($extension_Src) { 
      case 'jpg':
      case 'jpeg':
         imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
         break;
      case 'png':
         imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
         break;
      }
      // ---------------------
      // liberation des ressources-image
      imagedestroy ($Ress_Src);
      imagedestroy ($Ress_Dst);
      // ---------------------
      $condition = 1;
   }
 }
 // ---------------------------------------------------
 // retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
 if ($condition==1 && file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
 // ---------------------------------------------------
};

// ---------------------------------------------------
// Fonction d'AJOUT DE TEXTE à une image et Enregistrement
// ---------------------------------------------------
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------
// retourne : true si l'ajout de texte a bien été ajouté, sinon false
// ---------------------
// La FONCTION : fcttexteimage ($chaine, $rep_Dst, $img_Dst, $rep_Src, $img_Src, $position)
// Les paramètres :
// - $chaine : TEXTE a Ajouter
// - $rep_Dst : repertoire de l'image de Destination (déprotégé) --> ou '' (même répertoire)
// - $img_Dst : NOM de l'image de Destination --> ou '' (même nom que l'image Source)
// - $rep_Src : repertoire de l'image Source (déprotégé)
// - $img_Src : NOM de l'image Source
// - $position : position du texte sur l'image
// ---------------------
// ATTENTION : si le texte est TROP long, il risque d'être tronqué !
// ---------------------
// Position du texte sur l'image (valeurs possibles) :
// $position = 'HG' --> en Haut a Gauche (valeur par defaut)
// $position = 'HD' --> en Haut a Droite
// $position = 'HC' --> en Haut au Centre
// $position = 'BG' --> en Bas a Gauche
// $position = 'BD' --> en Bas a Droite
// $position = 'BC' --> en Bas au Centre
// ---------------------
// $rep_Dst : il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod)
// - si $rep_Dst = ''   : $rep_Dst = $rep_Src (même répertoire que l'image Source)
// - si $img_Dst = '' : $img_Dst = $img_Src (même nom que l'image Source)
// - si $rep_Dst='' ET $img_Dst='' : on ecrase (remplace) l'image source !
// ---------------------
// NB : $img_Dst et $img_Src doivent avoir la meme extension (meme type mime) !
// Extensions acceptées (traitees ici) : .jpg , .jpeg , .png
// Pour Ajouter d autres extensions : voir la bibliotheque GD ou ImageMagick
// (GD) NE fonctionne PAS avec les GIF ANIMES ou a fond transparent !
// ---------------------
// UTILISATION (exemple copyright, ou legende de l'image) :
// $texteOK = fcttexteimage('copyright : MOI','reppicto/','monpicto.jpg','repimage/','monimage.jpg','BG');
// if ($texteOK==true) { echo 'Ajout du texte OK !';  }
// ---------------------
function fcttexteimage($chaine, $rep_Dst, $img_Dst, $rep_Src, $img_Src, $position) {
 // ---------------------
   $condition = 0;
   $position = strtoupper($position); // on met en majuscule (par defaut)
 // Si certains paramètres ont pour valeur '' :
   if ($rep_Dst=='') { $rep_Dst = $rep_Src; } // (même répertoire)
   if ($img_Dst=='') { $img_Dst = $img_Src; } // (même nom)
   if ($position=='') { $position = 'BG'; } // en Bas A Gauche (valeur par defaut)
 // ---------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src) && $chaine!='') { 
   // ----------------------
   // extensions acceptées : 
	$extension_Allowed = 'jpg,jpeg,png';	// (sans espaces)
   // extension fichier Source
	$extension_Src = strtolower(pathinfo($img_Src,PATHINFO_EXTENSION));
   // ----------------------
   // extension OK ? on continue ...
   if(in_array($extension_Src, explode(',', $extension_Allowed))) {
      // ---------------------
      // récupération des dimensions de l'image Src
      $img_size = getimagesize($rep_Src.$img_Src);
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // ---------------------
      // creation de la ressource-image "Dst" en fonction de l extension
      // (a partir de l'image source)
      switch($extension_Src) {
      case 'jpg':
      case 'jpeg':
        $Ress_Dst = imagecreatefromjpeg($rep_Src.$img_Src);
        break;
      case 'png':
        $Ress_Dst = imagecreatefrompng($rep_Src.$img_Src);
        break;
      }
      // ------------------------------------------------
      // creation de l'image TEXTE
      // ------------------------------------------------
      // dimension de l'image "Txt" en fonction :
      // - de la longueur du texte a afficher
      // - des dimensions des caracteres (7x15 pixels par caractère)
      // ATTENTION : si le texte est TROP long, il risque d'être tronqué !
      $W = strlen($chaine) * 7;
      if ($W > $W_Src) { $W = $W_Src; }
      $H = 15; // 15 pixels de haut (par defaut)
      // ---------------------
      // creation de la ressource-image "Txt" (en fonction de l extension)
      switch($extension_Src) {
      case 'jpg':
      case 'jpeg':
      case 'png':
        $Ress_Txt = imagecreatetruecolor($W,$H);
        // Couleur du Fond : blanc
        $blanc = imagecolorallocate ($Ress_Txt, 255, 255, 255);
        imagefill ($Ress_Txt, 0, 0, $blanc);
        // Couleur du Texte : noir
        $textcolor = imagecolorallocate($Ress_Txt, 0, 0, 0);
        // Ecriture du TEXTE
        imagestring($Ress_Txt, 3, 0, 0, $chaine, $textcolor);
        break;
      }
      // ------------------------------------------------
      // positionnement du TEXTE sur l'image
      // ------------------------------------------------
      if ($position=='HG') {
         $X_Dest = 0;
         $Y_Dest = 0;
      }
      if ($position=='HD') {
         $X_Dest = $W_Src - $W;
         $Y_Dest = 0;
      }
      if ($position=='HC') {
         $X_Dest = ($W_Src - $W)/2;
         $Y_Dest = 0;
      }
      if ($position=='BG') {
         $X_Dest = 0;
         $Y_Dest = $H_Src - $H;
      }
      if ($position=='BD') {
         $X_Dest = $W_Src - $W;
         $Y_Dest = $H_Src - $H;
      }
      if ($position=='BC') {
         $X_Dest = ($W_Src - $W)/2;
         $Y_Dest = $H_Src - $H;
      }
      // ------------------------------------------------
      // copie par fusion de l'image "Txt" sur l'image "Dst"
      // (avec transparence de 50%)
      imagecopymerge ($Ress_Dst, $Ress_Txt, $X_Dest, $Y_Dest, 0, 0, $W, $H, 50);
      // ------------------------------------------------
      // ENREGISTREMENT dans le repertoire (en fonction de l extension)
      switch ($extension_Src) { 
      case 'jpg':
      case 'jpeg':
        imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
        break;
      case 'png':
        imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
        break;
      }
      // ---------------------
      // liberation des ressources-image
      imagedestroy ($Ress_Txt);
      imagedestroy ($Ress_Dst);
      // ---------------------
      $condition = 1;
   }
 }
 // ---------------------------------------------------
 // retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
 if ($condition==1 && file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
 // ---------------------------------------------------
};
