<?php

echo "<h1>Affichage des informations saisie dans le formulaire</h1><br>";

$nomOk = $prenomOk = $sexeOk = $dateOk =  $cpOk = $adrOk = $mailOk =  $questOk = $villeok = $sujetok = false;

// NOM
if (!(empty($_POST["Nom"]))){
    echo "<h4>Nom saisie : ".$_POST['Nom']."</h4>";
    if (preg_match('#[A-Z]{1}[a-z]*#', $_POST["Nom"]))
        {$nomOk = true;}
    }
else{
    echo "<h4>Nom saisie : Aucun</h4>";
} 
//Prenom
if (!(empty($_POST["Prenom"]))){
    echo "<h4>Prénom saisie : ".$_POST['Prenom']."</h4>";
    if (preg_match('#[A-Z]{1}[a-z]*#', $_POST["Prenom"]))
        {$prenomOk = true;}
    }
else{
    echo "<h4>Prénom saisie : Aucun</h4>";
} 

//Sexe
if(isset($_POST['sexe']) and ($_POST['sexe']) == 'F'){
    echo "<h4>Sexe : Féminin</h4>";
    $sexeOk = true;
    }
else if (isset($_POST['sexe']) and ($_POST['sexe']) == 'M') {
    echo "<h4>Sexe : Masculin</h4>";
    $sexeOk = true;
    }
else {
    echo "<h4>Sexe : Non renseigné</h4>";
}  

//Date de naisance
if (!(empty($_POST["date"]))){
    echo "<h4>Date de naissance : ".$_POST['date']."</h4>";
    if (preg_match('#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#', $_POST["date"]))
        {$dateOk = true;}
    }
else{
    echo "<h4>Date de naissance : Aucune</h4>";
} 

//Code postal
if (!(empty($_POST["CodePostal"]))){
    echo "<h4>Code Postal : ".$_POST['CodePostal']."</h4>";
    if (preg_match('#[0-9]{5}#', $_POST["CodePostal"]))
        {$cpOk = true;}
    }
else{
    echo "<h4>Code Postal : Aucun";
} 

//Adresse
if (!(empty($_POST["Adresse"]))){
    echo "<h4>Adresse : ".$_POST['Adresse']."</h4>";
    if (preg_match('#[1-9]+ .*#', $_POST["Adresse"]))
        {$adrOk = true;}
    }
else{
    echo "<h4>Adresse : Aucune";
} 

//Ville
if (!(empty($_POST["Ville"]))){
    echo "<h4>Ville : ".$_POST['Ville']."</h4>";
    if (preg_match('#[A-Z]{1}[a-z]*#', $_POST["Ville"]))
        {$adrOk = true;}
    }
else{
    echo "<h4>Ville : Aucune";
} 

//Mail
if (!(empty($_POST["courriel"]))){
    echo "<h4>Email : ".$_POST['courriel']."</h4>";
    if (preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $_POST["courriel"]))
        {$mailOk = true;}
    }
else{
    echo "<h4>Email : Aucun";
}

//Sujet
if (!(empty($_POST["Sujet"]))){
    if (($_POST['Sujet']) == "1") {echo "<h4>Sujet : "."Mes Commandes"."</h4>";}
    if (($_POST['Sujet']) == "2") {echo "<h4>Sujet : "."Question sur un produit"."</h4>";}
    if (($_POST['Sujet']) == "3") {echo "<h4>Sujet : "."Réclamations"."</h4>";}
    if (($_POST['Sujet']) == "4") {echo "<h4>Sujet : "."Autres"."</h4>";}
    $sujetok = true;
    }
else{
    echo "<h4>Sujet : Aucun";
} 

//Commentaire
if (!(empty($_POST["question"]))){
    echo "<h4>Commentaire : ".$_POST['question']."</h4>";
    if (preg_match('#.+#', $_POST["question"]))
    {$questOk = true;}
    }
else{
    echo "<h4>Commentaire : Aucun";
} 


if ($nomOk == true and $prenomOk == true and $sexeOk == true and $dateOk == true and $cpOk == true and $adrOk == true and $mailOk == true and 
    $questOk == true and $sujetok == true)
 {echo ' <script> window.alert("Demande enregistré"); </script>';
    header("Location: formulaire.php");}




 


?>