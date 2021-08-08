<?php session_start();?>
<?php
if  (isset ($_SESSION["Log"])){?>
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Modification d'un produit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <?php
        require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
        $db = connexionBase(); // Appel de la fonction de connexion
        $pro_id = $_GET["pro_id"];
   
        $requete1 = "SELECT cat_id, cat_nom, cat_parent FROM categories order by cat_nom";
        $result1 = $db->query($requete1);
    
        $requete = "SELECT * FROM produits where pro_id=".$pro_id;
        $result = $db->query($requete);
        $produit = $result->fetch(PDO::FETCH_OBJ); 

 
?>
    </head>
    <body> 
        <div class="container"> <!--container global de la page-->
                
            <?php include 'header/headerDetail.php'; ?>
       
            
            <div class="col-12 d-flex justify-content-center">
                <img src="public/images/<?=$pro_id?>" class="w-50" alt="Image responsive" title="<?=$pro_id.".".$produit->pro_photo;?>" >
            </div>

            

            <form name="Détail produit" id="Détail produit" method="POST" action="modification_script.php">
                <div class="form-group">
                    <label for="pro_id"><b>Identifiant Produit</b></label><input type="text" class="form-control" name="pro_id" id="pro_id" value="<?php echo $produit->pro_id?>" Readonly>
                    <label for="pro_ref"><b>Référence :</b></label><input type="text" class="form-control" name="pro_ref" id="pro_ref" value="<?php echo $produit->pro_ref?>">

                    <label for="cat_nom"><b>Catégorie :</b></label>
                    <select class="form-control" name="cat_nom" id="cat_nom">
             <?php
            
                    while ($row2= $result1->fetch(PDO::FETCH_OBJ))
                    {      
                    
                            echo"<option value=".$row2->cat_id."";
                
                    // row1 : requête sur le produit                   
                    // row2 : requête sur la catégorie
                                    
                            if ($row2->cat_id == $produit->pro_cat_id) {echo" selected";}
                    
                            echo">".$row2->cat_nom."</option>\n"; //separation ligne SUR CODE SOURCE
                        
                    }
            ?>
                  </select>
                    
                    <label for="pro_libelle"><b>Libéllé produit :</b></label><input type="text" class="form-control" name="pro_libelle" id="pro_libelle" value="<?php echo $produit->pro_libelle ?>">
                    <label for="pro_description"><b>Description produit :</b></label><input type="text" class="form-control" name="pro_description" id="pro_description" value="<?php echo $produit->pro_description?>">
                    <label for="pro_prix"><b>Prix :</b></label><input type="number" class="form-control" name="pro_prix" id="pro_prix" value="<?php echo $produit->pro_prix ?>">
                    <label for="pro_stock"><b>Quantité en stock :</b></label><input type="number" class="form-control" name="pro_stock" id="pro_stock" value="<?php echo $produit->pro_stock ?>">
                    <label for="pro_couleur"><b>Couleur Produit :</b></label><input type="text" class="form-control" name="pro_couleur" id="pro_couleur" value="<?php echo $produit->pro_couleur ?>">
                    
                    <label for="pro_photo"><b>Extension de la photo :</b></label><input type="text" class="form-control" name="pro_photo" id="pro_photo" value="<?php echo $produit->pro_photo?>" Readonly>
                    <br>
                    <label for="pro_bloque"><b>Produit bloqué :</b></label>
                         <div class="form-check form-check-inline">
                            <label class="form-check-label" for="pro_bloque">Oui&nbsp</label><input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque1" value=1 <?php if ($produit->pro_bloque == 1) echo"checked"; ?>>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="pro_bloque">Non&nbsp</label><input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque2" value=0  <?php if ($produit->pro_bloque == 0) echo"checked"; ?>>
                        </div>
                    <br>

                    <label for="pro_d_ajout"><b>Date d'ajout :</b></label><input type="text" class="form-control" name="pro_d_ajout" id="pro_d_ajout" value="<?php echo $produit->pro_d_ajout?>" Readonly>
                    <label for="pro_d_modif"><b>Date de modification :</b></label><input type="text" class="form-control" name="pro_d_modif" id="pro_d_modif" value='<?php echo date("yy-m-d");?>' Readonly>
                    
                   
                </div>  
            
                <span id="alerte-champs" class="text-danger"><?php if  (isset ($_SESSION["champ"])) echo $_SESSION["messchamp"];?> </span>
                <br>
                <span id="alerte-num" class="text-danger"><?php if  (isset ($_SESSION["numerique"])) echo $_SESSION["messnumeric"];?> </span>
                <br>
                <span id="alerte-ref" class="text-danger"><?php if  (isset ($_SESSION["ref"])) echo $_SESSION["messref"];?> </span>
                <br>
            <div class="d-flex justify-content-center" name ="actionProduit">
                <a  class="btn btn-success" href="tableauadmin.php">Retour</a>
                <button class="btn btn-primary ml-1" type="submit" name="submit" value="1" onclick="verif();">Enregistrer</button>
            </div>

            </form>

            <br>

        <?php include 'footer/footer.php'; ?>
<script>

    //vérifie si on envoit ou non le formulaire à "script_modif.php"
    function verif(){ 
        //Rappel : confirm() -> Bouton OK et Annuler, renvoit true ou false
        var resultat = confirm("Etes-vous certain de vouloir modifier cet enregistrement ?");

        //alert("retour :"+ resultat);

        if (resultat==false){
            alert("Vous avez annulé les modifications \nAucune modification ne sera apportée à cet enregistrement !");
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

unset($_SESSION["champ"]);
unset($_SESSION["messchamp"]);
unset($_SESSION["numerique"]);
unset($_SESSION["messnumeric"]);
unset($_SESSION["ref"]);
unset($_SESSION["messref"]);

?>