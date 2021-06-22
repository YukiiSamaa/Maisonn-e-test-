<?php @session_start();
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// --------------------------------------------------------------
// Deconnection de la partie "Administration"
// --------------------------------------------------------------
// on vide/detruit les variables de session
$_SESSION['Admin']['Valid']		= false;
// ------------------------------
// Redirection vers la page d'identification
   header('Location: ../index.php');
   exit;
// ------------------------------
