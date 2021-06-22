<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// protection ADMIN - Connexion - CONFIGURATION
	include_once(dirname(__DIR__) . '/_includes/html0.php');
// ---------------------------------------------------
// ADMIN NEWS : LISTING
// ---------------------------------------------------
// requete : toutes les News
	$news_query 			= "SELECT * FROM ".T_NEWS_ARTICLES." ".
							" ORDER BY news_date DESC;";
  try {
	$pdo_select 			= $pdo->prepare($news_query);
	$pdo_select->execute();
	$news_nombre 			= $pdo_select->rowCount();
	$news_rowAll			= $pdo_select->fetchAll();
  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
// -------------------------
?>
<?php	include_once(dirname(__DIR__) . '/_includes/html1.php'); ?>
<title>News | Listing des Articles</title>
<?php	include_once(dirname(__DIR__) . '/_includes/html2.php'); ?>
<h1>Administration des Articles</h1>

<div id="containerTop">
<?php	include_once(dirname(__DIR__) . '/_includes/adm_deconnexion_form.php'); ?>

	<h2>Liste des Articles</h2>

	<!-- Ajouter -->
	<form id="boxBoutonTopRight" method="post" name="formAjouter" action="./news_formuler<?php echo NEWS_EDITEUR_WYSIWYG; ?>.php">
		<input type="hidden" name="traiter" value="Ajouter" />
		<button class="btAjouter" name="btAjouter" type="submit" title="Ajouter un Nouvel Article">
		<span>Ajouter un Article</span></button>
	</form>
</div>

<div id="newsArticleListing">

	<h4><?php echo $news_nombre; ?> Article<?php if( $news_nombre>1) { echo 's'; } ?></h4>
	<table>
	<thead>
	<tr>
		<th width="4%">Suppr.</th>
		<th width="4%">id</th>
		<th width="10%">Date</th>
		<th>Titre de l'Article</th>
		<th width="5%">Photo</th>
		<th width="5%">Pdf</th>
		<th width="4%">Publier</th>
		<th width="4%">Voir</th>
		<th width="4%">Modif.</th>
	</tr>
	</thead>
	<tbody>
<?php
// -------------------------
if( $news_nombre>0) {
	// boucle pour lister
	foreach ($news_rowAll as $news_row)
	{
		// -------------------------
		$newsId 			= intval($news_row['news_id']);
		// On recupere les infos dans la BD
		require(dirname(dirname(__DIR__)) . '/'.NEWS_MOD_NEWS.'news_data_fromBD.php');
		// -------------------------
?>
	<tr>
		<td><!-- Supprimer -->
			<form method="post" name="formSupprimer" action="./news_formuler<?php echo NEWS_EDITEUR_WYSIWYG; ?>.php">
				<input type="hidden" name="traiter" value="Supprimer" />
				<input type="hidden" name="newsId" value="<?php echo $newsId; ?>" />
				<button name="btSupprimer" type="submit" title="Supprimer l'Article">
				<img src="<?php echo REP_ADM_ICONES; ?>Supprimer.png" alt="Supprimer l'Article" /></button>
			</form>
		</td>

		<!-- newsId -->
		<td><?php echo $newsId; ?></td>

		<!-- date -->
		<td><?php echo date('d/m/Y', $newsDate); ?></td>

		<td style="text-align:left;"><h4><?php echo $newsTitre; ?></h4></td>

		<td><!-- Photo -->
<?php	if( $newsPhoto!='') { ?>
			<img src="<?php echo ROOT_NEWS.NEWS_REP_PHOTOS.$newsPhoto; ?>" style="height:30px;" alt="<?php echo $newsPhoto; ?>" title="<?php echo $newsPhoto; ?>" />
<?php	} else { ?>
			<img src="<?php echo REP_ADM_ICONES; ?>ico_checkNon.png" alt="pas de photo" title="pas de photo" />
<?php	} ?>
		</td>

		<td><!-- Fiche PDF -->
<?php		if( $newsFile != '') { ?>
			<a href="<?php echo ROOT_NEWS.NEWS_REP_FILES.$newsFile; ?>" onclick="javascript:window.open(this.href); return false;">
			<img src="<?php echo REP_ADM_ICONES; ?>PDF.png" alt="<?php echo $newsFile; ?>" title="<?php echo $newsFile; ?>" /></a> 
<?php		} else { ?>
			<img src="<?php echo REP_ADM_ICONES; ?>PDFnon.png" alt="pas de fiche PDF" title="pas de fichier" />
<?php		} ?>
		</td>

		<td><!-- Publier Article : oui / non / toujours -->
			<?php	switch ($newsPublier) {
			case 0:	// non 		?><span class="icoCheckNon" title="Non"></span>
			<?php	break;
			case 1:	// oui		?><span class="icoCheckOui" title="Oui"></span>
			<?php	break;
			} ?>
		</td>

		<td><!-- Voir -->
			<form method="post" name="formvoirFiche" action="./news_fiche.php">
				<input type="hidden" name="newsId" value="<?php echo $newsId; ?>" />
				<button name="btVoir" type="submit" title="Voir l'Article">
				<img src="<?php echo REP_ADM_ICONES; ?>VoirFiche.png" alt="Voir l'Article" /></button>
			</form>
		</td>

		<td><!-- Modifier -->
			<form method="post" name="formModifier" action="./news_formuler<?php echo NEWS_EDITEUR_WYSIWYG; ?>.php">
				<input type="hidden" name="traiter" value="Modifier" />
				<input type="hidden" name="newsId" value="<?php echo $newsId; ?>" />
				<button name="btModifier" type="submit" title="Modifier l'Article">
				<img src="<?php echo REP_ADM_ICONES; ?>Modifier.png" alt="Modifier l'Article" /></button>
			</form>
		</td>
	</tr>
<?php
	} // Fin foreach
} else { // pas de news
?>
	<tr><td colspan="8">Pas d'Article.</td></tr>
<?php
}
?>
	</tbody>
	</table>
</div>
<?php	include_once(dirname(__DIR__) . '/_includes/html3.php'); ?>