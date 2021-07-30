
<html lang="fr">
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>La maisonnée</title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/slider_image.css">
        <link rel="stylesheet" href="assets/css/nav.css">
        <link rel="stylesheet" href="assets/css/main_contact.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/responsive_contact.css">
        <title>La maisonnée</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Slabo+15px" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="/favicon.ico" /><link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121324141-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-121324141-1');
        </script>





    </head>
    <body>
        <?php include("header/header_all.php")?>
        <section class="top">
            
            <div class="google_plan">
            <iframe class="plan" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d348.32402873356597!2d2.4986121969889616!3d49.9089830926758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e78c7f4110a57b%3A0x73be695cc14b8909!2sLa+Maisonn%C3%A9e!5e0!3m2!1sfr!2sfr!4v1528205570443" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="container_droite">
            <h3 class="H3">Horaire d'ouverture</h3>
            <p class="container_text">
            
            Lundi : 8h00 à 12h00 et 14h00 à 17h00
            </p>
            <p class="container_text ">
            Mardi : 8h00 à 12h00 et 14h00 à 17h00
            </p>
            <p class="container_text">
            Mercredi : 8h00 à 12h00
            </p>
            <p class="container_text">
            Jeudi : 8h00 à 12h00 et 14h00 à 17h00
            </p>
            <p class="container_text">
            Vendredi : 8h00 à 12h00 et 14h00 à 17h00
            </p>


        
            
            
            </div>
            
            
        </section>
        <section class="low">
            <div class="main">
                <h4>Nous Contacter</h4>
                <p class="text_low">
                    Pierre BOULANGER Port: 06.48.59.77.79<br>
                    Télephone:03.22.09.79.64<br>
                    Mail:la.maisonneecorbie@orange.fr
                   
                </p>
            </div>
        </section>
        <form id="contact" method="post" action="traitement_formulaire.php">
            <fieldset><legend>Vos coordonnées</legend>
                <p><label for="nom">Nom :</label><input type="text" id="nom" name="nom" tabindex="1" /></p>
                <p><label for="email">Email :</label><input type="text" id="email" name="email" tabindex="2" /></p>
            </fieldset>

            <fieldset><legend>Votre message :</legend>
                <p><label for="objet">Objet :</label><input type="text" id="objet" name="objet" tabindex="3" /></p>
                <p><label id="msg" for="message">Message :</label><textarea id="message" name="message" tabindex="4" cols="30" rows="8"></textarea></p>
            </fieldset>
            <div class="g-recaptcha" data-sitekey="6LdVSGAUAAAAAN-IZ-RxyZSp6VTpeTOAnoVy1tgN"></div>
            <div style=" margin-top:10px;text-align:center;"><input  id="btn"type="submit" name="envoi" value="Envoyer le formulaire !" /></div>
        </form>
        <?php include("footer/footer_all.php") ?>
    </body>
</html>

