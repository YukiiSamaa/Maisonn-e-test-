<?php
if( session_id()=='' ){ session_start(); }
header('Content-type:text/html; charset=UTF-8');	// encodage UTF-8
//error_reporting(E_ALL); 	// en TEST !!
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>La maisonnée</title>

        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/main_article.css">

        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/responsive.css">
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Slabo+15px" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="57x57" href="favicon_maisonn%C3%A9e.ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="favicon_maisonn%C3%A9e.ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="favicon_maisonn%C3%A9e.ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="favicon_maisonn%C3%A9e.ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="favicon_maisonn%C3%A9e.ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="favicon_maisonn%C3%A9e.ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="favicon_maisonn%C3%A9e.ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="favicon_maisonn%C3%A9e.ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="favicon_maisonn%C3%A9e.ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="favicon_maisonn%C3%A9e.ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon_maisonn%C3%A9e.ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="favicon_maisonn%C3%A9e.ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon_maisonn%C3%A9e.ico/favicon-16x16.png">
        <link rel="manifest" href="favicon_maisonn%C3%A9e.ico/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">





    </head>
    <body>
        <header>
            <div class="logo-main">

                <a href="index.html"><img  src="../images/logo-maisonnee.png" class="logo_main"></a>

            </div>
            <div class="logo_FSE">
                <img src="../images/Layer%201.png" >
                <img src="../images/Layer%202%20copy.png" >
                <img src="../images/Layer%206%20copy.png">
                <img src="../images/Layer%203%20copy.png" >
                <img src="../images/Layer%204%20copy.png" >
                <img src="../images/Layer%205%20copy.png" >
            </div>
            <div class="nav">
                <nav>
                    <ul id="menu">
                        <li><a href="../index.html">Accueil</a></li>

                        <li><a href="../activit%C3%A9.html">Notre Activité</a>
                            <ul>
                                <li><a href="#main_1">Revue de Presse</a>
                                    <ul>

                                        <li><a href="image_insertion/revue_presse_9 .jpg" target="_blank"  > Cp du 13/06/2018</a> 
                                        </li>
                                        <li><a href="image_insertion/revue_presse_2.jpg"  target="_blank">Cp du 12/06/2018</a> </li>
                                        <li><a href="image_insertion/revue_presse_7%20copy.jpg" target="_blank">Cp du 11/02/2018</a> </li>
                                        <li><a href="image_insertion/revue_presse.jpg" target="_blank">Cp du 24/10/2017</a> </li>
                                        <li><a href="image_insertion/revue_presse-4.jpg" target="_blank">Vivre en Somme n°108 sept-oct 2017</a> </li>
                                        <li><a href="image_insertion/revue_presse_5.jpg" target="_blank">Cp du juin 2017</a> </li>
                                        <li><a href="image_insertion/revue_presse_3.jpg" target="_blank">Cp du 11/04/2017</a> </li>
                                    </ul>
                                
                                </li>
                                <li><a href="#main_2">Action d'insertion Sociale</a></li>
                                <li><a href="#main_3">Nos chantiers en cours</a></li>

                            </ul>
                        </li>


                        <li><a href="article.php">Notre actualité</a></li>

                        <li><a href="../contact.php">Contact</a></li>

                    </ul>
                </nav>

            </div>
        </header>
        
            <div id="mainCentrer">

                <div id="newsArticleListing">
                    <?php 
                    // ---------------------------------------------------
                    // © Jérome Réaux : http://j-reaux.developpez.com - https://www.jerome-reaux-creations.fr
                    // FICHE de la News -> indiquez le chemin correct
                    include(__DIR__.'/modules/mod_news/news_fiche.php');
                    // ---------------------------------------------------
                    ?>
                </div>
                <div class="LienRetourListe">
                    <a href="<?php echo (isset($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER'] : './index.php'; ?>"><span>Retour à la Liste des Articles</span></a>
                </div> 
            </div>
        </body>
        
    </html>