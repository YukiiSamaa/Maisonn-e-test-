<?php session_start();
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// --------------------------------------------------------------
// Protection des pages de la partie "administration"
// --------------------------------------------------------------
// si non identifie
if (!isset($_SESSION['Admin']['Valid']) || $_SESSION['Admin']['Valid']!=true)
{
   // redirection vers le formulaire d identification
   header('location: '.__DIR__ . '/index.php');
   exit;
}

// ------------------------------
// si identifie, on continue ...
// ------------------------------
