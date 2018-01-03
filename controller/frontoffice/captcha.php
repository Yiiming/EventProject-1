<?php

// On crée la session avant tout
session_start();

include "../../model/Connexion.php";

$connect = new Connexion('127.0.0.1', 'root', '', 'eventProject');
// On définit la configuration :
$perso = $connect->requete("SELECT nom FROM CAPTCHA");

// Là, on définit le header de la page pour la transformer en image
header ("Content-type: image/png");
// Là, on crée notre image
$_img = imagecreatefrompng('../../view/image/fond_verif_img.png');

// On définit maintenant les couleurs
// Couleur de fond :
$arriere_plan = imagecolorallocate($_img, 0, 0, 0); // Au cas où on n'utiliserait pas d'image de fond, on utilise cette couleur-là.
// Autres couleurs :
$avant_plan = imagecolorallocate($_img, 255, 255, 255); // Couleur de la font

##### Ici on crée la variable qui contiendra le nom aléatoire#####
$i = 0;
$tab = [];
while($nomPerso = $perso->fetch()) {
    $tab[$i] = strtoupper($nomPerso["nom"]);
    $i++;
}

$nom = null;
// On explore le tableau $chiffres afin d'y afficher toutes les entrées qui s'y trouvent
$chiffre = mt_rand(0, 49);
$nom = $tab[$chiffre];
##### On a fini de créer le nombre aléatoire, on le rentre maintenant dans une variable de session #####
$_SESSION['nomPerso'] = $nom;
// On détruit les variables inutiles :
unset($chiffre);
unset($i);
unset($caractere);
unset($chiffres);

imagestring($_img, 5, 15, 15, $nom, $avant_plan);

imagepng($_img);
?>