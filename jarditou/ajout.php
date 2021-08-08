<?php session_start();?>
<?php
if  (isset ($_SESSION["Log"])){?>
<!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <title>Ajout produit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <?php    
        require "connexion_bdd.php"; // Inclusion de notrebibliothèque de fonctions

        $db = connexionBase(); // Appel de la fonction deconnexion
        $requete = "SELECT * FROM categories";

        $result = $db->query($requete);

        // Renvoi de l'enregistrement sous forme d'un objet
        $categorie = $result->fetch(PDO::FETCH_OBJ);
       ?>
    </head>
    
    <body> 
        <div class="container"> <!--container global de la page-->
                
            <?php include 'header/headerDetail.php'; ?>



            <h1><b>Ajout d'un produit</b></h1>  
    <form name="ajoutProduit" id="ajout produit" method="post" action="ajout_script.php" enctype="multipart/form-data">
        <label for="cat_id"><b>Nom catégorie<b></label>
        <select class="form-control" name="cat_nom" id="cat_nom">
             <?php
                 while ($row = $result->fetch(PDO::FETCH_OBJ)){
                     echo"<option value=".$row->cat_id.">".$row->cat_nom."</option>";
                     }
            ?>
        </select>
        <div class="form-group">
            <label for="pro_ref"><b>Réference produit</b></label><input type="text" class="form-control" name="pro_ref" id="pro_ref">
            <label for="pro_libelle"><b>Libéllé produit</b></label><input type="text" class="form-control" name="pro_libelle" id="pro_libelle">
            <label for="pro_description"><b>Description produit</b></label><input type="text" class="form-control" name="pro_description" id="pro_description">
            <label for="pro_prix"><b>Prix</b></label><input type="number" class="form-control" name="pro_prix" id="pro_prix">
            <label for="pro_stock"><b>Quantité en stock</b></label><input type="number" class="form-control" name="pro_stock" id="pro_stock">
            <label for="pro_couleur"><b>Couleur Produit</b></label><input type="text" class="form-control" name="pro_couleur" id="pro_couleur">
            <label for="pro_photo"><b>Extension de la photo :</b></label>
                                <select class="form-control" name="pro_photo" id="pro_photo">
                                     <option>jpg</option>
                                     <option>png</option>
                                     <option>gif</option>
                                </select>
        </div>      
        <b>Produit bloqué&nbsp&nbsp<b>
        <div class="form-check form-check-inline">
             <label class="form-check-label" for="pro_bloque"><input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque1" value=1>bloque</label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="pro_bloque"><input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque2" value=0>Non bloque</label>
        </div>
        <br>
        <br>
        <label for="pro_d_ajout"><b>Date d'ajout :</b></label><input type="text" class="form-control" name="pro_d_ajout" id="pro_d_ajout" value='<?php echo date("yy-m-d");?>' Readonly>
        <br>
        <label for="fichier">Photo :&nbsp&nbsp</label>
        <br>
        
        <input type="file" name="fichier"> 
        <br>
        <br>
        <span id="alerte-champs" class="text-danger"><?php if  (isset ($_SESSION["champ"])) echo $_SESSION["messchamp"];?> </span>
        <br>
         <span id="alerte-num" class="text-danger"><?php if  (isset ($_SESSION["numerique"])) echo $_SESSION["messnumeric"];?> </span>
        <br>
        <span id="alerte-ref" class="text-danger"><?php if  (isset ($_SESSION["ref"])) echo $_SESSION["messref"];?> </span>
        <br>
        <span id="alerte-fich" class="text-danger"><?php if  (isset ($_SESSION["fich"])) echo $_SESSION["messfich"];?> </span>
        <br>
        <div class="d-flex justify-content-center" name = actionProduit>
            <button class="btn btn-primary" type="submit" name="submit" value="1" onclick="verif();">Envoyer</button>
            <a href="tableauadmin.php" class="btn btn-success ml-1" type="button" id="efface">Annuler</a>
        </div>
    </form>

    <br>


      
<br>
<?php include 'footer/footer.php'; ?>


<script>

    //vérifie si on envoit ou non le formulaire à "script_modif.php"
    function verif(){ 
        //Rappel : confirm() -> Bouton OK et Annuler, renvoit true ou false
        var resultat = confirm("Etes-vous certain de vouloir ajouter cet enregistrement ?");

        //alert("retour :"+ resultat);

        if (resultat==false){
            alert("Vous avez annulé l'enregistrement' \nAucun nouveau produit n'a était ajouté");
            //annule l'évènement par défaut ... SUBMIT vers "script_modif.php"
            event.preventDefault();    
        }
    }
</script>
       
       
</div>



<!--<script src="public/js/evalContact.js"></script>-->
<!--fichiers Javascript nécessaires à Bootstrap-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
    </html>


<?php }

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

<?php

    $_SESSION["champ"] = "";
     $_SESSION["messchamp"]="";
     $_SESSION["numerique"]="";
     $_SESSION["messnumeric"] = "";
     $_SESSION["ref"] = "";
     $_SESSION["messref"] = "";
     $_SESSION["fich"] = "";
     $_SESSION["messfich"] = "";
 
 
     unset($_SESSION["champ"]);
     unset($_SESSION["messchamp"]);
     unset($_SESSION["numerique"]);
     unset($_SESSION["messnumeric"]);
     unset($_SESSION["ref"]);
     unset($_SESSION["messref"]);
     unset($_SESSION["fich"]);
     unset($_SESSION["messfich"]);

?>