<?php
if  (isset ($_POST["Log"])){


/*Connexion base jarditou*/
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
$db = connexionBase();// Appel de la fonction de connexion

/*Démarrage session*/
session_start();

$_SESSION["Log"]=$_POST["Log"];
$_SESSION["messlog1"]="";
$_SESSION["messlog2"]="";
$_SESSION["messlog3"]="";

if ($_POST["Log"] == ""){
    $_SESSION["messlog3"]="Authentifié vous";
    header('Location:index.php');
    exit; 
}



$log = $_POST["Log"];
$requete = "SELECT * FROM users where us_log=\"$log\""; //concatenantion d'une chaine de caractère
$result = $db->prepare($requete);
$result->execute();
$nb_log=$result->rowCount();

$result = $db->query($requete);
// Renvoi de l'enregistrement sous forme d'un objet
$utilisateur = $result->fetch(PDO::FETCH_OBJ);
$mtphash = $utilisateur->us_mp;

if ($nb_log == 0){
    $_SESSION["messlog2"]="Vous n'êtes pas connu de Jarditou";
    header('Location:index.php');
    exit;
}


if ($nb_log == 1){
    if (password_verify($_POST["motdepasse3"], $mtphash)){
        include 'compteurjarditou.php'; 
        $dateconnexion = date("y-m-d");
        $requete1 = $db->prepare("UPDATE users SET us_d_dercon = :us_con WHERE us_log=:us_log");
        $requete1->bindValue(':us_con', $dateconnexion);
        $requete1->bindValue(':us_log', $log);
        $requete1->execute();

        $_SESSION["messlog1"]="";
        $_SESSION["messlog2"]="";
        $_SESSION["messlog3"]="";
        unset($_SESSION["messlog1"]);
        unset($_SESSION["messlog2"]);
        unset($_SESSION["messlog3"]);

        header('Location:accueil.php');
        exit;
    }
    else {
        $_SESSION["messlog1"]="Mot de passe incorrect";
        header('Location:index.php');
        exit;
    }
}

}

else  {?>
    
    <!DOCTYPE html>
    <html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
    <!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
    <head>
        <!--meta permet de fourni des indications différentes du contenu de la page web -->
        <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
        <title>Document Contact</title>
        <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container"> <!--container global de la page-->
            <div class="row">
                <div class="col-12">
                    <img src="public/images/promotion.jpg"  class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
                </div>
            </div>
        <?php
            echo "<h1 class='d-flex justify-content-center'>"."Vous n'êtes pas autorisé à acceder sur cette pas"."</h1>";
            echo "<h3 class='d-flex justify-content-center'>"."Veuillez vous inscrire ou vous autentifier"."</h3>";
            echo "<br>";
            echo "<br>";
        ?>
            <a  class="btn btn-success d-flex justify-content-center" href="index.php">Inscription/Connexion</a>
        </div>      
        
        <!--fichiers Javascript nécessaires à Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>
        </html>
        
       <?php } ?>
