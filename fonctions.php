<?php
include 'includes/header.php';
include 'includes/menu.php';
//$allowed_tags = ['p', 'div', 'span', 'strong', 'em', 'h1', 'h2'];

/*** Fonctions ***/
/*Ouvrier qualifié, micro usine, on est libre sur le nom que ns donnons à nos fct*/

//déclaration
function echop($str) {
    echo '<p>'.$str.'</p>';
}

function echot($str, $tag) {
    //function qui affiche la chaîne en entrée (argument 1)
    //compris entre début et fin d'une balise html fournie en entrée (argument 2)
    //plus modulable

    if (isTagAllowed($tag)) {
        echo '<'.$tag.'>'.$str.'</'.$tag.'>';
    } else {
        echop ('La balise <strong>'.$tag.'</strong> non reconnue ou non permise');
    }
}

function isTagAllowed($tag) {
    $allowed_tags = ['p', 'div', 'span', 'strong', 'em', 'h1', 'h2'];//dico

    //vérifie que le tag fait parties des tags autorisés
    $found_tag = false; //par défaut, on considère que la balise n'a pas été trouvée
    foreach ($allowed_tags as $allowed) {
        if ($tag == $allowed) {
            $found_tag = true; //tag trouvé ds le tableau
        }
    }
    return $found_tag;//on retroune vrai ou faux
}

//invocation (appel)

echo 'Les functions sont utiles';
echo 'Les functions sont utiles';
echo 'Les functions sont utiles';

echop("Les functions sont utiles");
echop("Les functions sont utiles");
echop("Les functions sont utiles");

echot("Les functions sont utiles","div");
echot("Les functions sont utiles","p");
echot("Les functions sont utiles","span");
echot("Les functions sont utiles","h3");

if (isTagAllowed('div')) {
    echop ("Ce tag est autorisé");
}

include 'includes/footer.php';
?>