<?php

/** This file is part of KCFinder project
  *
  * @desc Base configuration file
  * @package KCFinder
  * @version 2.51
  * @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  * @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  * @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  * @link http://kcfinder.sunhater.com
  */

// IMPORTANT!!! Do not remove uncommented settings in this file even if
// you are using session configuration.
// See http://kcfinder.sunhater.com/install for setting descriptions

$_CONFIG = array(

    'disabled' 				=> false,	// true
    'denyZipDownload' 		=> false,
    'denyUpdateCheck' 		=> false,
    'denyExtensionRename' 	=> false,

    'theme' 				=> "oxygen",

//    'uploadURL' 			=> "upload",
    'uploadURL' 			=> "../../upload",	// PERSO !
    'uploadDir' 			=> "",

    'dirPerms' 				=> 0755,
    'filePerms' 			=> 0644,

    'access' 	=> array(

        'files' 	=> array(
            'upload' 		=> true,
            'delete' 		=> true,
            'copy' 			=> true,
            'move' 			=> true,
            'rename' 		=> true
        ),

        'dirs' 		=> array(
            'create' 		=> true,
            'delete' 		=> true,
            'rename' 		=> true
        )
    ),

    'deniedExts' 			=> "exe com msi bat php phps phtml php3 php4 php5 cgi pl",

    'types' 		=> array(

        // CKEditor & FCKEditor types
        'files'   			=>  "pdf xls doc docx",
        'flash'   			=>  "swf flv avi mpg mpeg",
        'images'  			=>  "*img",

        // TinyMCE types
        'file'    			=>  "pdf xls doc docx",
    //    'media'   		=>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'media'   			=>  "swf flv avi mpg mpeg",
        'image'   			=>  "*img",
    ),

    'filenameChangeChars' => array(
        ' ' 				=> "-",
        '\'' 				=> "-",
        ':' 				=> "-",
        ',' 				=> "-",
        ';' 				=> "-",
        '?' 				=> "",
        '!' 				=> "",
        '"' 				=> "",
        'à' 				=> "a",
        'â' 				=> "a",
        'ä' 				=> "a",
        'é' 				=> "e",
        'è' 				=> "e",
        'ê' 				=> "e",
        'ë' 				=> "e",
        'ï' 				=> "i",
        'î' 				=> "i",
        'ô' 				=> "o",
        'û' 				=> "u",
        'ù' 				=> "u"
    ),

    'dirnameChangeChars' => array(
        ' ' 				=> "-",
        '\'' 				=> "-",
        ':' 				=> "-",
        ',' 				=> "-",
        ';' 				=> "-",
        '?' 				=> "",
        '!' 				=> "",
        '"' 				=> "",
        'à' 				=> "a",
        'â' 				=> "a",
        'ä' 				=> "a",
        'é' 				=> "e",
        'è' 				=> "e",
        'ê' 				=> "e",
        'ë' 				=> "e",
        'ï' 				=> "i",
        'î' 				=> "i",
        'ô' 				=> "o",
        'û' 				=> "u",
        'ù' 				=> "u"
    ),

    'mime_magic' 			=> "",

    'maxImageWidth' 		=> 960,
    'maxImageHeight' 		=> 960,

    'thumbWidth' 			=> 150,
    'thumbHeight' 			=> 150,

    'thumbsDir' 			=> ".thumbs",	// PERSO !

    'jpegQuality' 			=> 90,

    'cookieDomain' 			=> "",
    'cookiePath' 			=> "",
    'cookiePrefix' 			=> 'KCFINDER_',

    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
    '_check4htaccess' 		=> true,
    //'_tinyMCEPath' 		=> "/tiny_mce",

    '_sessionVar' 			=> &$_SESSION['KCFINDER'],
    //'_sessionLifetime' 	=> 30,
    //'_sessionDir' 		=> "/full/directory/path",

    //'_sessionDomain' 		=> ".mysite.com",
    //'_sessionPath' 		=> "/my/path",
);
?>