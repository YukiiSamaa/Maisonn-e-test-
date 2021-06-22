	tinyMCE.init({

		// Encodage des caractères
		entity_encoding : "raw",

		/* TOOLBAR PERSONNALISEE */
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "forecolor,backcolor,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,link,unlink",
		theme_advanced_buttons2 : "hr,emotions,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,tablecontrols",
		// (options masquees : version simplifiee)
		// theme_advanced_buttons3 : ",visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,undo,redo,styleselect",
		// theme_advanced_buttons4 : "removeformat,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		// content_css : "../../utilitaires/TinyMCE/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "../../utilitaires/TinyMCE/lists/template_list.js",
		external_link_list_url : "../../utilitaires/TinyMCE/lists/link_list.js",
		external_image_list_url : "../../utilitaires/TinyMCE/lists/image_list.js",
		media_external_list_url : "../../utilitaires/TinyMCE/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "",
			staffid : ""
		}
	});
