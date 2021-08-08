<?php session_start();?>
<?php
if  (isset ($_SESSION["Log"])){

if (isset ($_SESSION["enrcontactok"])){
    echo' <script> alert("Votre demande a été prise en compte"); </script>';
}


?>


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
    
    <?php include 'header/headerContact.php'; ?>

        <p id="contact"></p>
        <h1><b>Vos Coordonées</b></h1>  
        <p>*Ces zones sont obligatoires</p>
        <form name="formulaire" id="formulaire" method="post" action="scriptcontact.php"> 
            <div class="form-group">
                <label for="Nom"><b>Nom*</b></label><input type="text" class="form-control" name="Nom" id="Nom"  value="<?php if  (isset ($_SESSION["Nom"])) echo $_SESSION["Nom"];?>" placeholder="Veuillez saisir votre nom" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-nom" class="text-danger"><?php if  (isset ($_SESSION["messNom"])) echo $_SESSION["messNom"];?> </span>
                <br>
                <label for="Prenom"><b>Prénom*</b></label><input type="text" class="form-control" name="Prenom" id="Prenom"   value="<?php if  (isset ($_SESSION["Prenom"])) echo $_SESSION["Prenom"];?>" placeholder="Veuillez saisir votre prénom">
                <span id="alerte-prenom" class="text-danger"><?php if  (isset ($_SESSION["messPrenom"])) echo $_SESSION["messPrenom"];?> </span>
            </div>
            
            <b>sexe*&nbsp</b>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sexe"><input class="form-check-input" type="radio" name="sexe" id="sexe1" value="F" <?php if (isset($_SESSION["Sexe"]) and $_SESSION["Sexe"] == 'F') echo "checked"; ?>>Féminin</label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sexe"><input class="form-check-input" type="radio" name="sexe" id="sexe2" value="M" <?php if (isset($_SESSION["Sexe"]) and $_SESSION["Sexe"] == 'M') echo "checked"; ?>>Masculin</label>
            </div>
            <br>
            <span id="alerte-sexe" class="text-danger"><?php if  (isset ($_SESSION["messSexe"])) echo $_SESSION["messSexe"];?> </span>
            <br>
            
            <div class="form-group">
                <label for="date"><b>Date de naissance*</b></label><input type="text" class="form-control" name="date" id="date"  value="<?php if  (isset ($_SESSION["Date"])) echo $_SESSION["Date"];?>"  placeholder="Veuillez saisir votre date de naissance">
                <span id="alerte-date" class="text-danger"><?php if  (isset ($_SESSION["messDate"])) echo $_SESSION["messDate"];?> </span>
                <br>
                <label for="CodePostal"><b>Code postal*</b></label><input type="number" class="form-control" name="CodePostal" id="CodePostal"  value="<?php if  (isset ($_SESSION["CodePostal"])) echo $_SESSION["CodePostal"];?>"  placeholder="Veuillez saisir votre code postal">
                <span id="alerte-codep" class="text-danger"><?php if  (isset ($_SESSION["messCp"])) echo $_SESSION["messCp"];?> </span>
                <br>
                <label for="Adresse"><b>Adresse*</b></label><input type="text" class="form-control" name="Adresse" id="Adresse"  value="<?php if  (isset ($_SESSION["Adresse"])) echo $_SESSION["Adresse"];?>"  placeholder="Veuillez saisir votre adresse">
                <span id="alerte-adresse" class="text-danger"><?php if  (isset ($_SESSION["messAdr"])) echo $_SESSION["messAdr"];?> </span>
                <br>
                <br>
                <label for="Ville"><b>Ville*</b></label><input type="text" class="form-control" name="Ville" id="Ville"  value="<?php if  (isset ($_SESSION["Ville"])) echo $_SESSION["Ville"];?>"  placeholder="Veuillez saisir votre ville">
                <span id="alerte-ville" class="text-danger"><?php if  (isset ($_SESSION["messVille"])) echo $_SESSION["messVille"];?> </span>
                <br>
                <br>
                <label for="courriel"><b>Email*</b></label><input type="email" class="form-control" name="courriel" id="courriel"  value="<?php if  (isset ($_SESSION["Courriel"])) echo $_SESSION["Courriel"];?>" placeholder="date.loper@afpa.fr" >
                <span id="alerte-courriel" class="text-danger"><?php if  (isset ($_SESSION["messMail"])) echo $_SESSION["messMail"];?> </span>
                <br>
                <br>
            </div>
            <h1><b>Votre demande</b></h1>
                <label for="Sujet">Sujet</label>
                <select class="form-control" name="Sujet" id="Sujet">
                    <option value = 0  <?php if (isset($_SESSION["Sujet"]) and $_SESSION["Sujet"] == 0) echo "selected"; ?>>Veuillez séléctionner un sujet</option>
                    <option value = 1 <?php if (isset($_SESSION["Sujet"]) and $_SESSION["Sujet"] == 1) echo "selected"; ?>>Mes commandes</option>
                    <option value = 2 <?php if (isset($_SESSION["Sujet"]) and $_SESSION["Sujet"] == 2) echo "selected"; ?>>Question sur un produit</option>
                    <option value = 3 <?php if (isset($_SESSION["Sujet"]) and $_SESSION["Sujet"] == 3) echo "selected"; ?>>Réclamations</option>
                    <option value = 4 <?php if (isset($_SESSION["Sujet"]) and $_SESSION["Sujet"] == 4) echo "selected"; ?>>Autres</option>
                </select> 
                <span id="alerte-sujet" class="text-danger"><?php if  (isset ($_SESSION["messSujet"])) echo $_SESSION["messSujet"];?> </span>
                <br>
                <p>Votre question*:</p>
                <textarea for="question" name="question" class="form-control ml-1 row col-12 col-sm-12" id="question" rows="3"><?php if  (isset ($_SESSION["question"])) echo $_SESSION["question"];?></textarea>
                <span id="alerte-question" class="text-danger"><?php if  (isset ($_SESSION["messQuest"])) echo $_SESSION["messQuest"];?> </span>
                <br>
                <br>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="acceptation" required>
                    <label class="form-check-label" for="acceptation">J'accepte le traitement informatique de ce formulaire</label>
                </div>
            </div>
            <button class="btn btn-dark" type="submit" name="submit" value="1" >Envoyer</button>
            <button class="btn btn-dark" type="button" id="efface">Annuler</button>
        </form>
        <br>
       
        <?php include 'footer/footer.php'; ?>
    </div>



<!--<script src="public/js/evalContact.js"></script>-->
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
                     document.getElementById("formulaire").reset();
              }
     }
</script>';

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

$_SESSION["enrcontactok"]="";



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

unset($_SESSION["enrcontactok"]);


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