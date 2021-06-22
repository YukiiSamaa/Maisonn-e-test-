<?php // © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr ?>
<div class="adm_mainContenu">

<?php	if( $MsgValidOK!='') { ?>
			<div class="boxMsgOk"><?php echo $MsgValidOK; ?></div>
<?php	} ?>
<?php	if( $MsgErreurChamps!='' || $msgErreurPhoto!='' || $msgErreurFile!='') { ?>
			<?php echo ($MsgErreurChamps!='')? 	'<div class="boxMsgErreur">'.$MsgErreurChamps.'</div>' : ''; ?>
			<?php echo ($msgErreurPhoto!='')? 	'<div class="boxMsgErreur">'.$msgErreurPhoto.'</div>' : ''; ?>
			<?php echo ($msgErreurFile!='')? 	'<div class="boxMsgErreur">'.$msgErreurFile.'</div>' : ''; ?>
<?php	} ?>

<?php
// --------------------------------------------------
// re-affichage
if( in_array($traiter,array('Ajouter','Modifier')))
{
	// -----------------
	// On recupere les infos dans la BD
	require(dirname(dirname(dirname(__DIR__))) . '/modules/mod_news/news_data_fromBD.php');
	// -----------------
?>
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
<?php
}
// -------------------------
elseif( $traiter == 'Supprimer') { ?>

<?php } ?>

</div>