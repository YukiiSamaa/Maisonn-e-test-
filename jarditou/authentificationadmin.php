<?php session_start();?>
<?php
if  (isset ($_SESSION["Log"])){
/*Connexion base jarditou*/
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
$db = connexionBase();// Appel de la fonction de connexion

/*Sauvegarde session */
$admi = $_SESSION["Log"];

/*vérification validité des champs */

$_SESSION["Nom"]=$_POST["Nom"];
$_SESSION["Prenom"]=$_POST["Prenom"];
$_SESSION["Login"]=$_POST["Login"];
$_SESSION["Mail"]=$_POST["Mail"];

$Nomok = $Prenomok = $Loginok = $Mailok = $mtpok = false;


if (preg_match('#[a-z]+#', $_SESSION["Nom"]))
    {$_SESSION["messNom"] = "";
     $Nomok = true;
    }
else  $_SESSION["messNom"] = "Veuillez entrer un nom valide";

if (preg_match('#[a-z]+#', $_SESSION["Prenom"]))
    {$_SESSION["messPrenom"] = "";
     $Prenomok = true;
    }
else  $_SESSION["messPrenom"] = "Veuillez entrer un prénom valide";

if (preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $_SESSION["Mail"]))
    {$_SESSION["messMail"] = "";
    $Mailok = true;
    }
else  $_SESSION["messMail"] = "Veuillez entrer un Mail valide";

if (preg_match('#[a-zA-Z0-9]{6}[a-zA-Z0-9]*#', $_SESSION["Login"]))
    {$_SESSION["messLogin"] = "";
    $Loginok = true;
    }
else  $_SESSION["messLogin"] = "Veuillez entrer un Login d'au moins 6 caractères lettre ou chiffre sans caractère spéciaux";

if (preg_match('#[a-zA-Z0-9]{8}#', $_POST["motdepasse"]))
        {if ($_POST["motdepasse"] != $_POST["motdepasse2"])
            $_SESSION["messmdp"] = "Les mots de passes saisies sont différent";
        else {$_SESSION["messmdp"] ="";
                $mtpok = true;
            }
        }
else {$_SESSION["messmdp"] = "Veuillez entrer un mot de passe de 8 caractères lettre ou chiffre sans caractère spéciaux";}




if (!($Nomok and $Prenomok and $Loginok and $Mailok and $mtpok)){
    header('Location:admin.php');
    exit;
}

/*Vérification existance du mail */

$mail=$_SESSION["Mail"];
$requete2 = "SELECT * FROM users where us_mail=\"$mail\""; //concatenantion d'une chaine de caractère
$result2 = $db->prepare($requete2);
$result2->execute();
$nb_mail=$result2->rowCount();
$result2->closeCursor();

if ($nb_mail != 0) {
        $_SESSION["messMail"] = "Ce Mail existe déjà";
        header('Location:admin.php');
        exit;
}

/*Vérification existance du login */

$log=$_SESSION["Login"];
$requete1 = "SELECT * FROM users where us_log=\"$log\""; //concatenantion d'une chaine de caractère
$result1 = $db->prepare($requete1);
$result1->execute();
$nb_log=$result1->rowCount();
$result1->closeCursor();

if ($nb_log != 0) {
        $_SESSION["messLogin"] = "Ce login existe déjà";
        header('Location:admin.php');
        exit;
}

 /*Insertion nouvel utilisateur*/
    $dateins = date("y-m-d");
    $datecon = NULL;
    $password_hash = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT);
    $status = 1;


    $requete = $db->prepare("INSERT INTO users (us_nom,us_prenom,us_mail,us_log,us_mp,us_d_ins,us_d_dercon,us_status) 
                        values(:us_nom,:us_prenom,:us_mail,:us_log,:us_mp,:us_d_ins,:us_d_dercon,:us_status)");
    $requete->bindValue(':us_nom', $_SESSION["Nom"]);
    $requete->bindValue(':us_prenom', $_SESSION["Prenom"]);
    $requete->bindValue(':us_mail', $_SESSION["Mail"]);
    $requete->bindValue(':us_log', $_SESSION["Login"]);
    $requete->bindValue(':us_mp',  $password_hash);
    $requete->bindValue(':us_d_ins', $dateins);
    $requete->bindValue(':us_d_dercon', $datecon);
    $requete->bindValue(':us_status', $status);


$requete->execute();

//libère la connection au serveur de BDD
$requete->closeCursor();

/*Destruction variable de session*/

$_SESSION["Nom"]="";
$_SESSION["Prenom"]="";
$_SESSION["Login"]="";
$_SESSION["Mail"]="";
$_SESSION["messNom"] = "";
$_SESSION["messPrenom"] = "";
$_SESSION["messMail"] = "";
$_SESSION["messLogin"] = "";
$_SESSION["messmdp"]="";

$_SESSION["enrok"]=1;

unset($_SESSION["Nom"]);
unset($_SESSION["Prenom"]);
unset($_SESSION["Login"]);
unset($_SESSION["Mail"]);
unset($_SESSION["messNom"]);
unset($_SESSION["messPrenom"]);
unset($_SESSION["messMail"]);
unset($_SESSION["messLogin"]);
unset($_SESSION["messmdp"]);

header('Location:admin.php');
exit;
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