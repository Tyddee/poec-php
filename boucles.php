<?php
include 'includes/header.php';
include 'includes/menu.php';
//*** boucles ***

//FOR

//le i++ permet de fermer la boucle, condition de sortie de la boucle
for ($i=0; $i<3; $i++) {
    echo '<p>'.$i.'<p>';
}

//WHILE

$i=0; //variable servant d'incrémenteur
while ( $i < 3) {
    echo '<p>'.$i.'<p>';
    $i++;
}

// FOREACH
// boucle idéale pour le parcour des tableaux, alternative + rapide

$mois = ["janvier", "février", "mars", "avril"];
    echo "<select>";
        foreach ($mois as $m) { /*la variable $m est automatiquement assignée à chq itération, elle correspondra tour à tour à chq valeur contenu dans le tableau $mois*/
            echo "<option>" . $m . "</option>";
        }
        for ($i=0; $i<4; $i++) {
            echo "<option>" . $mois[$i] . "</option>";
        }// équivalent au foreach juste au dessus

    echo "</select>";

$animaux = ["casoar", "elephant", "loup", "chat", "hamster"];
$width = 300;
    foreach ($animaux as $animal) {
        echo "<div><img style=\"width:" . $width . "px; border:2px orange solid\" src=\"img/" . $animal . ".jpg\"></div>";
    } /*le backslash permet d'échapper aux guillemets qui encerclent les images, propre, permet d'être ds les conventions de la w3c, échappe au concept php*/

echo "<script src=\"js/script.js\"></script>";
/*echo '<script src="js/script.js"></script>';  même chose que en haut, sauf qu'on a pas eu à echapper*/

//EXO 2
//Afficher 2 autres photos au choix OK
//afficher également une bordure colorée autour des images OK voir ligne 37


include 'includes/footer.php';
?>