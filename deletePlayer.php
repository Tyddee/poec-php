<?php
include 'includes/connexion_db.php'; //fourni la fonction de connexion connect();

//récupération de l'id du joueur
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1) connexion
    $db = connect();

    // 2) requête, ds prepare on parle en sql, en majuscule par convention W3C
    $query = $db->prepare('DELETE FROM joueur WHERE id = :id');

    // 3) exécution
    $query->execute(array(
        ':id'=>$id
        ));

    if (isset($_GET['ajax'])) {
        //requête reçue en http ajax
        echo "Le joueur d'id" . $id . "a été supprimé";
    } else {
        //requête reçue en http "normal"
        
        // redirection vers liste joueurs
        header('location:joueurs.php');
    }
}

?>