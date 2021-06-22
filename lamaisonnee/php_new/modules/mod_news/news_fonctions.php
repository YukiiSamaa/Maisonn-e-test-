<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// FONCTIONS D'AFFICHAGE DES NEWS
// ---------------------------------------------------

// ---------------------------------------------------
// 1a/ FONCTION : FICHE de la News (News seule)
// ---------------------------------------------------
function news_affiche_fiche( $newsId )
{
	if( is_numeric($newsId) && $newsId>0 )
	{
		// -------------------------
		global $pdo; // connexion PDO
		// -------------------------
		// On recupere les infos dans la BD
		require(__DIR__ . '/news_data_fromBD.php');
		// -------------------------
?>
		<article class="newsArticle">
			<div class="cadre">
				<h4><?php echo $newsTitre; ?></h4>
				<span class="newsDate"> le <?php echo date('d/m/Y &#224; I', $newsDate); ?></span>
			</div>

			<div class="newsContenu">
<?php		if(  !empty($newsPhoto) ) { ?>
				<img class="newsPhoto" src="<?php echo ROOT_NEWS.NEWS_REP_PHOTOS.$newsPhoto; ?>" alt="" style="width:<?php echo $newsPhotoLargeur.'%'; ?>;" />
<?php		} ?>

				<?php echo $newsContenu; ?>

<?php		if( !empty($newsFile) ) { ?>
				<a class="newsFile" href="<?php echo ROOT_NEWS.NEWS_REP_FILES.$newsFile; ?>" onclick="javascript:window.open(this.href); return false;">
				<span>Voir le Fichier joint</span></a>
<?php		} ?>
			</div>
		</article>
<?php
	} else {
		echo 'Mauvais identifiant de News';
	}
};

// ---------------------------------------------------
// 1b/ FONCTION : FICHE de la News (LISTE sur plusieurs colonnes)
// Avec picto, résumé du contenu et lien vers la fiche de l'Article
// ---------------------------------------------------
function news_affiche_fiche_resume_colonne( $newsId )
{
	if( is_numeric($newsId) && $newsId>0 )
	{
		// -------------------------
		global $pdo; // connexion PDO
		// -------------------------
		// On recupere les infos dans la BD
		require(__DIR__ . '/news_data_fromBD.php');
		// -------------------------
		// Nombre de colonnes : 1 à 6 (voir le style CSS : .newsColonne)
		$NbreCol	= ( NEWS_NBRE_COLONNE>0 && NEWS_NBRE_COLONNE<7 )? NEWS_NBRE_COLONNE : '';
?>
		<article class="newsArticle newsColonne<?php echo $NbreCol; ?>">
			<div class="cadre">
				<h6><?php echo $newsTitre; ?></h6>
                <span class="newsDate"> le <?php  date_default_timezone_set('Europe/Paris');echo date('d/m/Y H:i', $newsDate); ?></span>
			</div>

			<div class="newsContenu">
<?php		if( $newsPhoto != '') { ?>
				<a href="<?php echo NEWS_PATH_FICHE; ?>?newsId=<?php echo $newsId; ?>">
				<img class="newsArticlePhoto" src="<?php echo ROOT_NEWS.NEWS_REP_PHOTOS.$newsPhoto; ?>" style="width:<?php echo $newsPhotoLargeur.'%'; ?>;" alt="" title="<?php echo $newsTitre; ?>" />
				</a>
<?php		} ?>

<?php 			// Résumé du Contenu
				if( NEWS_RESUME_TYPE=='brut'){
					echo texte_resume_brut($newsContenu, NEWS_RESUME_NBRECAR); 
				} elseif( NEWS_RESUME_TYPE=='html'){
					echo texte_resume_html($newsContenu, NEWS_RESUME_NBRECAR); 
				} else {
					echo $newsContenu; 
				}
?>
				<a class="newsSuite" href="<?php echo NEWS_PATH_FICHE; ?>?newsId=<?php echo $newsId; ?>"><span>lire la suite</span></a>

<?php		if( $newsFile != '') { ?>
				<a class="newsFile" href="<?php echo ROOT_NEWS.NEWS_REP_FILES.$newsFile; ?>" onclick="javascript:window.open(this.href); return false;">
				<span>Voir le Fichier joint</span></a>
<?php		} ?>
			</div>
		</article>
<?php
	} else {
		echo 'Mauvais identifiant de News';
	}
};

// ---------------------------------------------------
// 2/ FONCTION : LISTING des NEWS (avec résumé du contenu)
// ---------------------------------------------------
function news_affiche_liste_colonne( $numPage )
{
	if( is_numeric($numPage) && $numPage>0)
	{
		// -------------------------
		global $pdo; // connexion PDO
		// -------------------------
		// requete : toutes les News (CONFIG : Nombre Maxi à afficher -> NEWS_NBRE_MAXITOTAL)
		$news_total_query 		= "SELECT * FROM ".T_NEWS_ARTICLES." ".
								" WHERE news_publier = 1 ".		// uniquement les news publiées
								" ORDER BY news_date DESC ".
								" LIMIT 0, :newsNbreMaxiTotal ".
								";";
	  try {
		$pdo_select 			= $pdo->prepare($news_total_query);
		$pdo_select->bindValue(':newsNbreMaxiTotal', 	NEWS_NBRE_MAXITOTAL,		PDO::PARAM_INT);
		$pdo_select->execute();
		$news_total_nombre 		= $pdo_select->rowCount();
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
		// -------------------------
		// PAGINATION
		// On calcule le nombre de pages
		$nbreTotalPages 		= ceil($news_total_nombre / NEWS_NBRE_PARPAGE);
		// On calcule le numero du premier message qu'on prend pour le LIMIT de MySQL
		$numDebut 				= ($numPage - 1) * NEWS_NBRE_PARPAGE;
		// -------------------------
		// News à afficher sur la page
		$news_query 			= "SELECT * FROM ".T_NEWS_ARTICLES." ".
								" WHERE news_publier = 1 ".		// uniquement les news publiées
								" ORDER BY news_date DESC ".
								" LIMIT :numDebut,:newsNbreParPage ".
								";";
	  try {
		$pdo_select 			= $pdo->prepare($news_query);
		$pdo_select->bindValue(':numDebut', 		$numDebut,			PDO::PARAM_INT);
		$pdo_select->bindValue(':newsNbreParPage', 	NEWS_NBRE_PARPAGE,	PDO::PARAM_INT);
		$pdo_select->execute();
		$news_nombre 			= $pdo_select->rowCount();
		$news_rowAll			= $pdo_select->fetchAll();
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
		// -------------------------
		// Affichage de la PAGINATION
		news_pagination_pages($numPage, $nbreTotalPages); 
?>
		<div id="newsArticleListing">
<?php	// -------------------------
		// Affichage des News
		if( $news_nombre>0) {
			foreach ($news_rowAll as $news_row)
			{
				// -------------------------
				$newsId 			= intval($news_row['news_id']);
				// On recupere les infos dans la BD
				require(__DIR__ . '/news_data_fromBD.php');
				// -------------------------
				// Affichage de la news
				news_affiche_fiche_resume_colonne($newsId);
			}
		}
?>
		</div>
<?php
		// -------------------------
		// Affichage de la PAGINATION
		news_pagination_pages($numPage, $nbreTotalPages);
	}
};

// --------------------------------------------------------------
// FONCTION : PAGINATION (listing des News)
// --------------------------------------------------------------
function news_pagination_pages( $numPage, $nbreTotalPages )
{
	// -------------
	$numLimit		= 5; 	// Limite : nombre de pages avant/après la page courante
	$sep			= '';	// Séparateur '', '-', '|', '/' : entre les numéros de pages
	// -------------
	// au cas où l URL comporte déjà des arguments (?...&...)
	$args 			= preg_replace('#(pg=[0-9]+&?)#', '', $_SERVER['QUERY_STRING']);
	$args 			= (!empty($args))?	'&'.$args : '';
	// -------------
	// PAGINATION
	if( $nbreTotalPages > 1) 
	{
?>
		<div class="newsPagination">
<?php	echo $sep;
	  for ($i=1; $i<=$nbreTotalPages; $i++)
	  {
		// 1ère page
		if( $i==1 && $numPage>($numLimit+1)) 
		{
			echo ' <a href="?pg='.$i.$args.'" title="Page '.$i.'">'.$i.'</a> '.$sep.'...'.$sep;
		}
		// page courante + $numLimit pages avant et après
		if( ($numPage-1-$numLimit)<$i && $i<($numPage+1+$numLimit))
		{
		  if( $i==$numPage) { // page courante
			echo ' <b>Page '.$i.'</b> '.$sep;
		  } else {
			echo ' <a href="?pg='.$i.$args.'" title="Page '.$i.'">'.$i.'</a> '.$sep;
		  }
		}
		// dernière page
		if( $i==$nbreTotalPages && $numPage<($nbreTotalPages-$numLimit)) 
		{ 
			echo '...'.$sep.' <a href="?pg='.$i.$args.'" title="Page '.$i.'">'.$i.'</a>';
		}
	  }
?>
		</div>
<?php	} 	// (fin if nbreTotalPages)
};

// --------------------------------------------------------------