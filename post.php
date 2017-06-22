<?php
/*session_start(); ouverture d'une session ou reprise d'une session déjà ouverte;*/

include 'includes/util.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

/*var_dump($_SESSION); renvoie null si aucune session ouverte, sinon renvoie tableau associatif (potentiellement vide);

$_SESSION['test'] = 'ça marche!';*/

?>

<h1>POST</h1>

<?php

/*print_r($_POST);  supprimé car test en dur. On va retravailler cela avc le serveur*/

$email = $_POST['email'];
$pass = $_POST['pass'];

if (isset ($_POST['admin'])) {
    $admin = $_POST['admin'];
}

/*$test = null;

if (isset ($test)) {
    echop ("La variable test est définie");
} else {
    echop ("La variable test n'est pas définie");
}*/


if ($email == "test@test.fr" && $pass == 1234 && isset($admin)) {
    echo ("Identification réussie");
//Enregistrer cet état dans la session
    $_SESSION['logged'] = true;
    header('location:index.php');
} else {
    echop("L'identification a échoué...");
}

?>

<?php include 'includes/footer.php';?>