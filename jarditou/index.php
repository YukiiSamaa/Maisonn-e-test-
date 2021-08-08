<?php session_start();?>
<?php
    if (isset ($_SESSION["enrok"])){
        echo' <script> alert("Inscription réussi. Un mail vous a été envoyé."); </script>';
    }
    if (isset ($_SESSION["envrei"])){
        echo' <script> alert("Un mail vous a été envoyé pour réinitialiser vôtre mot de passe."); </script>';
    }
    if (isset ($_SESSION["reiniok"])){
        echo' <script> alert("Votre mot de passe a bien été changé"); </script>';
    }
?>

<!DOCTYPE html>
<html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
<!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
<head>
    <!--meta permet de fourni des indications différentes du contenu de la page web -->
    <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
    <title>Inscription/Connexion</title>
    <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container"> <!--container global de la page-->
        <div class="row"> <!--création d'une ligne de 2 colonne de 6-->
            <div class="col-6"> 
                <!--d-none d-md-block supprime l'element sur petit écran -->
                <img src="public/images/jarditou_logo.jpg"  class="d-none d-md-block w-50 mt-2" alt="Image responsive" title="Image logo">
            </div>
            <div class="col-6">
                <!--display-6 est une taille de police-->
                <h2 class="d-none d-md-block display-6 float-right mr-5 mt-3">Tout le jardin</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <img src="public/images/promotion.jpg"  class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
            </div>
        </div>
    <br>
    <br>
    
    <h2 class="d-flex justify-content-center"><b>Formulaire d'inscription client</b></h2>  
    <p>Pour vous inscrire en tant qu'administrateur afin d'avoir accés à toutes les fonctionnalités du site, veuillez me contacter : nadir.boudjerada@gmail.com</p>
        <p>Tout les champs sont obligatoires</p>
        <form name="inscription" id="inscription" method="post" action="authentification.php">
            <div class="form-group">
                <label for="Nom"><b>Nom</b></label><input type="text" class="form-control" name="Nom" id="Nom" value="<?php if  (isset ($_SESSION["Nom"])) echo $_SESSION["Nom"];?>" placeholder="Veuillez saisir votre nom" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-nom" class="text-danger"><?php if  (isset ($_SESSION["messNom"])) echo $_SESSION["messNom"];?> </span>
                <br>
                <label for="Prenom"><b>Prenom</b></label><input type="text" class="form-control" name="Prenom" id="Prenom" value="<?php if  (isset ($_SESSION["Prenom"])) echo $_SESSION["Prenom"];?>" placeholder="Veuillez saisir votre prénom" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-prenom" class="text-danger"><?php if  (isset ($_SESSION["messPrenom"])) echo $_SESSION["messPrenom"];?></span> 
                <br>
                <label for="Mail"><b>E-mail</b></label><input type="text" class="form-control" name="Mail" id="Mail" value="<?php if  (isset ($_SESSION["Mail"])) echo $_SESSION["Mail"];?>" placeholder="Veuillez saisir votre mail" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-nom"class="text-danger"> <?php if  (isset ($_SESSION["messMail"])) echo $_SESSION["messMail"];?> </span>
                <br>
                <label for="Login"><b>Login</b></label><input type="text" class="form-control" name="Login" id="Login" value="<?php if  (isset ($_SESSION["Login"])) echo $_SESSION["Login"];?>" placeholder="Veuillez choisir un login de connexion de 6 caractères minimum" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-login" class="text-danger"><?php if  (isset ($_SESSION["messLogin"])) echo $_SESSION["messLogin"];?> </span>
                <br>
                <label for="motdepasse"><b>Mot de passe</b></label><input type="text" class="form-control" name="motdepasse" id="motdepasse" placeholder="Veuillez choisir un mot de passe de connexion de 8 caractères" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-motdepasse"> </span>
                <br>
                <label for="motdepasse2"><b>Mot de passe</b></label><input type="text" class="form-control" name="motdepasse2" id="motdepasse2" placeholder="Veuillez confirmer vôtre mot de passe de connexion" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-motdepasse2" class="text-danger"><?php if  (isset ($_SESSION["messmdp"])) echo $_SESSION["messmdp"]; ?> </span>
                <br>
            </div>
            <div class="d-flex justify-content-center" name = "actioninscription">
                <button class="btn btn-dark" type="submit" name="submit" id ="submit" value="1" required>Inscription</button>
                <button class="btn btn-dark ml-2" type="button" id="efface">Annuler</button>
            </div>
        </form>

    <br>
    <br>
    <h2 class="d-flex justify-content-center"><b>Déjà inscrit :</b></h2> 
        <form name="inscription" id="inscription" method="post" action="connexion.php">
            <div class="form-group">
                <label for="Login"><b>Login</b></label><input type="text" class="form-control" name="Log" id="Log" value="<?php if  (isset ($_SESSION["Log"])) echo $_SESSION["Log"];?>" placeholder="Veuillez saisir vôtre login" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-logina" class="text-danger"><?php if  (isset ($_SESSION["messlog2"])) { echo $_SESSION["messlog2"]; echo $_SESSION["messlog3"];}?> </span>
                <br>
                <label for="motdepasse3"><b>Mot de passe</b></label><input type="text" class="form-control" name="motdepasse3" id="motdepasse3" placeholder="Veuillez saisir vôtre mot de passe de connexion" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-motdepasse" class="text-danger"><?php if  (isset ($_SESSION["messlog1"])) echo $_SESSION["messlog1"]; ?> </span>
            </div>
            <div class="d-flex justify-content-center" name = "actionauthentification">
                <button class="btn btn-primary" type="submit" name="submit2" id ="submit2" value="1" required>Connexion</button>
            </div>
        </form>
    <br>
    <a href="envoimtp.php">Mot de passe perdu<a>
    <br>
    <br>
    <div class="row">
     <div class="col-12">
        <nav class="d-flex justify-content-center navbar navbar-expand-sm bg-dark navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
            </button> 
         <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="">mention légales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">horaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">plan du site</a>
                    </li>
                </ul>
            </div> 
        </nav>
    </div>
</div>

</div>
        
<!--fichiers Javascript nécessaires à Bootstrap-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php

echo'
<script>
     document.querySelector("#efface").onclick= function(){
           if(confirm("êtes-vous sur(e) de vouloir effacer?")){
                     document.getElementById("inscription").reset();
              }
     }
</script>';

echo'
<script>
     document.querySelector("#submit").onclick= function(){
           if(confirm("êtes-vous sur(e) de vouloir vous inscrire?")){
                     document.getElementById("inscription").post();
              }
     }
</script>';

/*Detruction session */

$_SESSION["Nom"]="";
$_SESSION["Prenom"]="";
$_SESSION["Login"]="";
$_SESSION["Mail"]="";
$_SESSION["messNom"] = "";
$_SESSION["messPrenom"] = "";
$_SESSION["messMail"] = "";
$_SESSION["messLogin"] = "";
$_SESSION["messmdp"]="";
$_SESSION["Log"]="";
$_SESSION["messlog1"]="";
$_SESSION["messlog2"]="";
$_SESSION["messlog3"]="";
$_SESSION["panier"]="";
$_SESSION["status"] ="";

/*enregistrement client*/
$_SESSION["enrok"] = "";

/*Réinitialisation mot de passe*/
$_SESSION["envrei"]="";
$_SESSION["reiniok"]="";



unset($_SESSION["Nom"]);
unset($_SESSION["Prenom"]);
unset($_SESSION["Login"]);
unset($_SESSION["Mail"]);
unset($_SESSION["messNom"]);
unset($_SESSION["messPrenom"]);
unset($_SESSION["messMail"]);
unset($_SESSION["messLogin"]);
unset($_SESSION["messmdp"]);
unset($_SESSION["Log"]);
unset($_SESSION["messlog1"]);
unset($_SESSION["messlog2"]);
unset($_SESSION["messlog3"]);
unset($_SESSION["panier"]);
unset($_SESSION["status"]);

unset($_SESSION["enrok"]);
unset($_SESSION["reiniok"]);
unset($_SESSION["envrei"]);




/*en cas de modification réussi*/
$_SESSION["champ"] = "";
$_SESSION["messchamp"]="";
$_SESSION["numerique"]="";
$_SESSION["messnumeric"] = "";
$_SESSION["ref"] = "ok";
$_SESSION["messref"] = "";
unset($_SESSION["champ"]);
unset($_SESSION["messchamp"]);
unset($_SESSION["numerique"]);
unset($_SESSION["messnumeric"]);
unset($_SESSION["ref"]);
unset($_SESSION["messref"]);

/*Sécurité pour formulaire contact */


$_SESSION["Nom"]="";
$_SESSION["Prenom"]="";
$_SESSION["Sexe"]="";
$_SESSION["Date"]="";
$_SESSION["CodePostal"]="";
$_SESSION["Adresse"]="";
$_SESSION["Ville"]="";
$_SESSION["Courriel"]="";
$_SESSION["question"]="";
$_SESSION["messNom"]="";
$_SESSION["messPrenom"]="";
$_SESSION["messSexe"]="";
$_SESSION["messDate"]="";
$_SESSION["messCp"]="";
$_SESSION["messAdr"]="";
$_SESSION["messVille"]="";
$_SESSION["messMail"]="";
$_SESSION["Sujet"]="";
$_SESSION["messQuest"]="";

$_SESSION["enrcontactok"]="";

unset($_SESSION["Nom"]);
unset($_SESSION["Prenom"]);
unset($_SESSION["Sexe"]);
unset($_SESSION["Date"]);
unset($_SESSION["CodePostal"]);
unset($_SESSION["Adresse"]);
unset($_SESSION["Ville"]);
unset($_SESSION["Courriel"]);
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

unset($_SESSION["enrcontactok"]);

session_destroy();

?>