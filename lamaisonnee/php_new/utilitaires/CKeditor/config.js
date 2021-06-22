/*CKEDITOR config*/
// -----------------------------------------------------------
// CONFIGURATION PERSONNELLE
// -----------------------------------------------------------
CKEDITOR.editorConfig = function( config )
{
	// -----------------------
	// Define changes to default configuration here. For example:
	// config.language 						= 'fr';
	// config.uiColor 						= '#AADC6E';
	// config.width 						= '80%';
	// config.height 						= '100'; // px
	config.basicEntities 				= false; // évite les &nbsp; inutiles
	config.allowedContent 				= true;	// accepte l'ajout d'attribut (class, style...) inline
	// config.entities_greek 				= false; 
	// config.entities_latin 				= false; 
	// config.entities_additional 			= '';
	// config.fillEmptyBlocks 				= false;
	// -----------------------
    // allow i tags to be empty (for font awesome)
    config.protectedSource.push(/<i[^>]*><\/i>/g);
    CKEDITOR.dtd.$removeEmpty['i'] = false;
	// -----------------------
	/* KCEditor (GRATUIT !) : explorateur de fichiers */
	config.filebrowserBrowseUrl 		= '../../utilitaires/KCfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl 	= '../../utilitaires/KCfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl 	= '../../utilitaires/KCfinder/browse.php?type=flash';
	config.filebrowserUploadUrl 		= '../../utilitaires/KCfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl 	= '../../utilitaires/KCfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl 	= '../../utilitaires/KCfinder/upload.php?type=flash';
	// -----------------------
	/* TOOLBAR (intégré) */
	//	config.toolbar = 'Full';
	//	config.toolbar = 'Basic';
	// -----------------------
	/* TOOLBAR PERSONNALISEE - SIMPLE */
	config.toolbar 						= 'ToolbarSimple';
	config.toolbar_ToolbarSimple 		=
	[
	{ name: 'basicstyles', 	items : [ 'Bold','Italic','Underline','Strike' ] },
	{ name: 'paragraph', 	items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
	{ name: 'links', 		items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'editing', 		items : [ '-','SpellChecker', 'Scayt' ] },
	{ name: 'colors', 		items : [ 'TextColor','BGColor' ] },
	{ name: 'styles', 		items : [ 'Format' ] },
	{ name: 'clipboard', 	items : [ 'PasteText','PasteFromWord' ] },
	{ name: 'insert', 		items : [ 'HorizontalRule' ] },
	{ name: 'document', 	items : [ 'Source' ] }
	];
	// -----------------------
	/* TOOLBAR PERSONNALISEE - MINI */
	config.toolbar 						= 'ToolbarMini';
	config.toolbar_ToolbarMini 			=
	[
	{ name: 'basicstyles', 	items : [ 'Bold','Italic' ] },
	{ name: 'styles', 		items : [ 'Format' ] },
	{ name: 'links', 		items : [ 'Link','Unlink' ] },
	{ name: 'paragraph', 	items : [ 'BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
	{ name: 'document', 	items : [ 'Source' ] }
	];
	// -----------------------
	/* TOOLBAR PERSONNALISEE - ARTICLE */
	config.toolbar 						= 'ToolbarArticle';
	config.toolbar_ToolbarArticle 		=
	[
	{ name: 'basicstyles', 	items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph', 	items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
	{ name: 'links', 		items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'editing', 		items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
	{ name: 'colors', 		items : [ 'TextColor','BGColor' ] },
	{ name: 'styles', 		items : [ 'Format' ] },
	{ name: 'clipboard', 	items : [ 'PasteText','PasteFromWord' ] },
	{ name: 'insert', 		items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar' ] },
	{ name: 'document', 	items : [ 'Source', 'ShowBlocks','Preview' ] }
	];
	// -----------------------
};
// -----------------------------------------------------------