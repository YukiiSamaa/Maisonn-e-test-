<?php session_start();?>
<?php
if  (isset ($_SESSION["Log"])){

/*Démarrage session*/
session_start();

/*vérification validité des champs */

$_SESSION["Nom"]=$_POST["Nom"];
$_SESSION["Prenom"]=$_POST["Prenom"];
$_SESSION["Date"]=$_POST["date"];
$_SESSION["CodePostal"]=$_POST["CodePostal"];
$_SESSION["Adresse"]=$_POST["Adresse"];
$_SESSION["Ville"]=$_POST["Ville"];
$_SESSION["Courriel"]=$_POST["courriel"];
$_SESSION["Sujet"]=$_POST["Sujet"];
$_SESSION["question"]=$_POST["question"];

$Nomok = $Prenomok = $Sexeok = $Dateok = $Cpok = $adrok = $Villeok = $courrielok = $Sujetok = $questionok =  false;

if (preg_match('#[a-zA-Z]+#', $_SESSION["Nom"]))
    {$_SESSION["messNom"] = "";
     $Nomok = true;
    }
else  $_SESSION["messNom"] = "Veuillez entrer un nom valide";


if (preg_match('#[a-zA-Z]+#', $_SESSION["Prenom"]))
    {$_SESSION["messPrenom"] = "";
     $Prenomok = true;
    }
else  $_SESSION["messPrenom"] = "Veuillez entrer un prénom valide";

if (isset($_POST['sexe']) and ($_POST['sexe'] == 'M')){
    $_SESSION["messSexe"] = "";
    $_SESSION["Sexe"] = $_POST['sexe'];
    $Sexeok = true;
}
else { 
    if (isset($_POST['sexe']) and ($_POST['sexe'] == 'F')){
        $_SESSION["messSexe"] = "";
        $_SESSION["Sexe"] = $_POST['sexe'];
        $Sexeok = true;
    }
    else {
        $_SESSION["messSexe"] = "Veuillez renseigner votre sexe";
    }
}


if (preg_match('#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#', $_SESSION["Date"]))
    {$_SESSION["messDate"] = "";
    $Dateok = true;
    }
else  $_SESSION["messDate"] = "Veuillez entrer une date de naissance valide";


if (preg_match('#[0-9]{5}#', $_SESSION["CodePostal"]))
    {$_SESSION["messCp"] = "";
     $Cpok = true;
    }
else  $_SESSION["messCp"] = "Veuillez entrer un code postal valide";


if (preg_match('#[1-9]+ .+#', $_SESSION["Adresse"]))
    {$_SESSION["messAdr"] = "";
    $adrok = true;
    }
else  $_SESSION["messAdr"] = "Veuillez entrer une adresse valide";


if (preg_match('#[a-zA-Z]{1}[a-z]*#', $_SESSION["Ville"]))
    {$_SESSION["messVille"] = "";
    $Villeok = true;
    }
else  $_SESSION["messVille"] = "Veuillez entrer une ville valide";


if (preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $_SESSION["Courriel"]))
    {$_SESSION["messMail"] = "";
    $courrielok = true;
    }
else  $_SESSION["messMail"] = "Veuillez entrer un email valide";



if ($_SESSION['Sujet'] == 0){
    $_SESSION["messSujet"] = "Veuiller sélectionner un sujet";
}
if ($_SESSION['Sujet'] == 1){
    $_SESSION["messSujet"] = "";
    $Sujetok = true;
}
if ($_SESSION['Sujet'] == 2){
    $_SESSION["messSujet"] = "";
    $Sujetok = true;
}
if ($_SESSION['Sujet'] == 3){
    $_SESSION["messSujet"] = "";
    $Sujetok = true;
}
if ($_SESSION['Sujet'] == 4){
    $_SESSION["messSujet"] = "";
    $Sujetok = true;
}



if (preg_match('#.+#', $_SESSION["question"]))
    {$_SESSION["messQuest"] = "";
    $questionok  = true;
    }
else  $_SESSION["messQuest"] = "Veuillez saisir une question";




if (!($Nomok and $Prenomok and $Sexeok and $Dateok and $Cpok and $adrok and $Villeok and $courrielok and $Sujetok and $questionok )){
    header('Location:contact.php');
    exit;
}
else {
    $_SESSION["enrcontactok"]= "ok";
    $_SESSION["Nom"]="";
    $_SESSION["Prenom"]="";
    $_SESSION["Sexe"]="";
    $_SESSION["Date"]="";
    $_SESSION["CodePostal"]="";
    $_SESSION["Adresse"]="";
    $_SESSION["Ville"]="";
    $_SESSION["Courriel"]="";
    $_SESSION["Sujet"]="";
    $_SESSION["question"]="";
    $_SESSION["messNom"]="";
    $_SESSION["messPrenom"]="";
    $_SESSION["messSexe"]="";
    $_SESSION["messDate"]="";
    $_SESSION["messCp"]="";
    $_SESSION["messAdr"]="";
    $_SESSION["messVille"]="";
    $_SESSION["messMail"]="";
    $_SESSION["messSujet"]="";
    $_SESSION["messQuest"]="";
   

    unset($_SESSION["Nom"]);
    unset($_SESSION["Prenom"]);
    unset($_SESSION["Sexe"]);
    unset($_SESSION["Date"]);
    unset($_SESSION["CodePostal"]);
    unset($_SESSION["Adresse"]);
    unset($_SESSION["Ville"]);
    unset($_SESSION["Courriel"]);
    unset($_SESSION["Sujet"]);
    unset($_SESSION["question"]);
    unset($_SESSION["messNom"]);
    unset($_SESSION["messPrenom"]);
    unset($_SESSION["messSexe"]);
    unset($_SESSION["messDate"]);
    unset($_SESSION["messCp"]);
    unset($_SESSION["messAdr"]);
    unset($_SESSION["messVille"]);
    unset($_SESSION["messMail"]);
    unset($_SESSION["messSujet"]);
    unset($_SESSION["messQuest"]);
   
    
    header('Location:contact.php');
    exit;
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
