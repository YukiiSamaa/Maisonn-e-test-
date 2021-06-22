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
    <link rel="stylesheet" href="../css/responsive_article.css">
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
<header>
    <div class="logo-main">

        <a href="../index.html"><img  src="../images/logo-maisonnee.png" class="logo_main"></a>

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

                <li><a href="../activite.html">Notre Activité</a>
                    <ul>
                        <li><a href="">Revue de Presse</a>
                            <ul>
                                <li><a href="image_insertion/article-1.jpeg" target="_blank"  > Courrier Picard du 20/12/2018</a>
                                </li>
                                <li><a href="image_insertion/article-2.jpeg" target="_blank"  > Courrier Picard du 20/12/2018</a>
                                </li>
                                <li><a href="image_insertion/revue_presse_14.jpeg"  target="_blank">Le HURLEUX de novembre 2018</a>
                                <li><a href="image_insertion/revue_presse_10.jpg" target="_blank">Courrier Picard du 29/06/2018</a>
                                       </li>
                                <li><a href="../image_insertion/revue_presse_12.png" target="_blank"  > Courrier Picard du 21/06/2018</a>
                                </li>
                                <li><a href="../image_insertion/revue_presse_13.png" target="_blank"  > Bulletin Intercommunal Val de Somme :juin 2018</a>
                                </li>

                                <li><a href="../image_insertion/revue_presse_9 .jpg" target="_blank"  > Courrier Picard du 13/06/2018</a>
                                </li>
                                <li><a href="../image_insertion/revue_presse_2.jpg"  target="_blank">Courrier Picard du 12/06/2018</a> </li>
                                <li><a href="../image_insertion/revue_presse_7%20copy.jpg" target="_blank">Courrier Picard du 11/02/2018</a> </li>
                                <li><a href="../image_insertion/revue_presse.jpg" target="_blank">Courrier Picard du 24/10/2017</a> </li>
                                <li><a href="../image_insertion/revue_presse-4.jpg" target="_blank">Vivre en Somme n°108 sept-oct 2017</a> </li>
                                <li><a href="../image_insertion/revue_presse_5.jpg" target="_blank">Courrier Picard du juin 2017</a> </li>
                                <li><a href="../image_insertion/revue_presse_3.jpg" target="_blank">Courrier Picard du 11/04/2017</a> </li>
                            </ul>
                        </li>
                        <li><a href="../activite.html#main_2">Action d'insertion Sociale</a></li>
                        <li><a href="../activite.html#main_3">Nos chantiers en cours</a></li>

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
        // LISTING des News -> indiquez le chemin correct
        include(__DIR__.'/modules/mod_news/news_liste_colonne.php');
        // ---------------------------------------------------
        ?>
        
        
    </div>
    
    


</div>
<footer class="menu_tab">
    <div class="fb">
        <a href="https://www.facebook.com/maisonnee/"  > <img src="../images/fb_logo2.png" class="fb_logo"></a>
        <div class="fb_text">
            <p1>
                Suivez-nous
                sur Facebook
            </p1>

        </div>
    </div>
    <div class="menu_footer">
        <div class="logo_sec">
            <p class="text_logo">Avec le soutien :</p>
            <img  class="vinci"src="../images/Fond_Vinci_logo1%20copy.png">
            <img class="cmne" src="../images/B_CREDIT_MUTUEL2014_Q.png">
            <img class="caisse"src="../images/logo-caisse-epargne%20copy.png">

            <img class="credit"src="../images/Crédit_Agricole2.png">

        </div>
        <ul class="menu">
            <li class="first_tab">
                <a href="../contact.php" class="contact">Contact</a>
            </li>
            <li class="last_tab">
                <a href="../mention_legale.html" class="mentions">Mentions Légales
                </a>

            </li>
        </ul>
        <p2>

        </p2>

    </div>

</footer>
</body>

