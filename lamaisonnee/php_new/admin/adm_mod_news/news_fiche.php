<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// protection ADMIN - Connexion - CONFIGURATION
	include_once(dirname(__DIR__) . '/_includes/html0.php');
// ---------------------------------------------------
// NEWS - FICHE DETAILLEE
// ---------------------------------------------------
// On recupere l URL de la page d'origine
	$nomPageOrigine = (isset($_SERVER["HTTP_REFERER"]))? $_SERVER["HTTP_REFERER"] : '';
// -----------------
if(  !empty($_POST['newsId']) )
{
	// On recupere l id
	$newsId 				= intval($_POST['newsId']);
} else {
	// sinon retour a la liste
	header('location: ./news_liste.php');
	exit;
}
// -----------------
// On recupere les infos dans la BD
	require(dirname(dirname(__DIR__)) . '/'.NEWS_MOD_NEWS.'news_data_fromBD.php');
// -----------------
?>
<?php	include_once(dirname(__DIR__) . '/_includes/html1.php'); ?>
<title>News | Fiche de l'Article</title>
<?php	include_once(dirname(__DIR__) . '/_includes/html2.php'); ?>
<h1>Administration des Articles</h1>

<div id="containerTop">

	<h2>Prévisualisation de l'Article</h2>

	<div id="boxBoutonTopLeft">
		<a class="aLienRetour" href="./news_liste.php"><span>Retour à la Liste</span></a>
	</div> 
</div>

<div class="adm_mainContenu">

	<div class="adm_mainForm">
	<div class="adm_mainForm_Left">

	 <h4>Prévisualisation</h4>

<?php 	news_affiche_fiche($newsId); ?>
	</div>

	<div class="adm_mainForm_Right">

		<h4>Publication</h4>

		<p><!-- publier ? (oui-non) -->
			<label><acronym title="Afficher l'Article sur le site ?">Article Publié</acronym> : </label>
			<?php	switch ($newsPublier) {
			case 0:	// non 		?><span class="icoCheckNon" title="Non"></span>
			<?php	break;
			case 1:	// oui		?><span class="icoCheckOui" title="Oui"></span>
			<?php	break;
			} ?>
		</p>

		<div id="boxValidation">
		<!-- Modifier -->
		<form method="post" name="formAjouter" action="./news_formuler<?php echo NEWS_EDITEUR_WYSIWYG; ?>.php">
		<fieldset>
			<input type="hidden" name="traiter" value="Modifier" />
			<input type="hidden" name="newsId" value="<?php echo $newsId; ?>" />
			<button class="btCorriger" name="btAjouter" type="submit" title="Corriger l'Article ?">
			<span>Corriger ?</span></button>
		</fieldset>
		</form>
		</div> 

	</div>
	</div>

</div>
<?php	include_once(dirname(__DIR__) . '/_includes/html3.php'); ?>