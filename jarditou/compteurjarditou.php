<?php
// On ouvre le fichier moncompteurjarditou.txt lecture ecriture pointeur au début
$fichier = fopen("moncompteurjarditou.txt","r+");
// on lit le nombre indiqué dans ce fichier dans la variable
$visiteurs = fgets($fichier,255);
// on ajoute 1 au nombre de visiteurs
$visiteurs++;
// on se positionne au début du fichier
fseek($fichier,0);
// on écrit le nouveau nombre dans le fichier
fputs($fichier,$visiteurs);
// on referme le fichier moncompteur.txt
fclose($fichier);
// on indique sur la page le nombre de visiteurs
//print("$visiteurs personnes sont passées par ici");
?>