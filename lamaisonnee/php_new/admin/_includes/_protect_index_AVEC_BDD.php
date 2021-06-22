<?php
// © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
// -----------------------------------------------------------
// Connection a la partie "Administration"
// ----------------------------------
// Fonction spéciale de Vérification du Mot de passe hashé
	include_once(__DIR__ . '/_fct_speciales.php');
// -----------------------------------------------------------
// Paramètres Connexion ADMINISTRATION
$_SESSION['Admin']				= array();
$_SESSION['Admin']['Valid']		= false;
$_SESSION['Admin']['Statut']	= '';
$_SESSION['Admin']['Pseudo']	= '';
$auth_msgerreur 				= '';
// -------------------------
// on récupère les données
	$login 					= !empty($_POST['login'])? 	formatage_from_post($_POST['login']) : '';
	$pass 					= !empty($_POST['pass'])? 	formatage_from_post($_POST['pass']) : '';
// -------------------------
// si le visiteur (administrateur ?) a validé le formulaire
if( !empty($login) && !empty($pass) )
{
	// --------------
	// Recherche en Base de données : LoginRecu
	$auth_query 	= " SELECT CNX.log_admin, CNX.pwd_admin, CNX.id_statut, CNX.nom_admin, CNX.prenom_admin ".
					" FROM ".T_NEWS_ADM_CONNEXION." AS CNX ".
					" WHERE CNX.log_admin = :LoginRecu ".
					" AND CNX.id_statut > 1 ; ";
  try {
	$pdo_select 	= $pdo->prepare($auth_query);
	$pdo_select->bindValue(':LoginRecu', 	$login,	PDO::PARAM_STR);
	$pdo_select->execute();
	$auth_nombre 	= $pdo_select->rowCount();
	$auth_row		= $pdo_select->fetch();
  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
	// --------------
	// si on trouve bien un login dans la BD
	if ($auth_nombre==1) 
	{
		// on verifie la validite du mot de passe
		$testpwd 	= VerifyHashPassword( $pass, $auth_row['pwd_admin'] );
		if ($testpwd==true)
		{
			// IDENTIFICATION OK
			$_SESSION['Admin']['Valid'] 	= true;						// VALIDATION (-> true)
			$_SESSION['Admin']['Statut'] 	= $auth_row['id_statut'];	// STATUT (niveau d'acces)
			// Pseudo (Nom-Prenom, ou login)
		  if( empty($auth_row['nom_admin']) && empty($auth_row['prenom_admin']) ) 
		  {
			$_SESSION['Admin']['Pseudo'] 	= $auth_row['log_admin'];
		  } else {
			$_SESSION['Admin']['Pseudo'] 	= $auth_row['prenom_admin'].' '.$auth_row['nom_admin'];
		  }
		} else {
			// mauvais pwd
			unset($_SESSION['Admin']);
			$auth_msgerreur 	= 'Identifiant ou Mot deplpl passe incorrect';
		}
	// --------------
	} else {
			// mauvais login
			unset($_SESSION['Admin']);
			$auth_msgerreur 	= 'Identifiant ou Mot de passe incorrect';
	}
}
// ---------------------------------------------------------------
// Accès autorisé si identifié :
if ( !empty($_SESSION['Admin']['Valid']) && !empty($_SESSION['Admin']['Pseudo']) )
{  
   // Redirection vers la page d administration des News
   header('location: ./adm_mod_news/news_liste.php');
}
// ---------------------------------------------------------------
// sinon affichage du formulaire d'identification
