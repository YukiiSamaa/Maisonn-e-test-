<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// --------------------------------------------------------------
//			FONCTIONS SPECIALES ADMINISTRATION
// --------------------------------------------------------------

// --------------------------------------------------------------
// FONCTION : Hashage du mot de passe
// --------------------------------------------------------------
function CreateHashPassword( $password )
{
	return password_hash( $password, PASSWORD_BCRYPT ); // génère 60 caractères
};

// --------------------------------------------------------------
// FONCTION : Verification du mot de passe
// --------------------------------------------------------------
function VerifyHashPassword( $password, $hash )
{
	return password_verify ( $password, $hash );
};

// --------------------------------------------------------------
