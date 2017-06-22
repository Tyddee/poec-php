<?php
//echo json_encode($_POST);
include 'includes/connexion_db.php';

$db = connect();

$query = $db->prepare('INSERT INTO joueur (nom, prenom, age, maillot, equipe) VALUES(:nom, :prenom, :age, :maillot, :equipe)');

$result = $query->execute(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'age' => $_POST['age'],
    'maillot' => $_POST['maillot'],
    'equipe' => $_POST['equipe']
));

echo $result; //renvoie le résultat de la requête sql (booléen) au client.

?>