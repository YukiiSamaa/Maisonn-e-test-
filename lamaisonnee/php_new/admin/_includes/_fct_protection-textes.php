<?php
// ***************************************************************
// Protection contre les failles XSS dans le HTML des textarea
// ***************************************************************
// avec strip_tags : suppression de toutes les balises, sauf celle mentionnees
function strip_tags_textarea($text) 
{
	// balises qui seront conservees
	$allowable_tags =  '<abbr><acronym><a><b><br><blockquote><cite><code><dl><dt><dd>';
	$allowable_tags .= '<div><i><img><h1><h2><h3><h4><h5><h6><hr><p><span>';
	$allowable_tags .= '<em><strong><small><pre><u><ul><ol><li>';
	$allowable_tags .= '<table><caption><legend><thead><tfoot><tbody><tr><th><td><colgroup><col>';
	return strip_tags($text, $allowable_tags);
}
// ------------------------------
?>