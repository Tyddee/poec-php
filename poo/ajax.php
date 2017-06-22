<?php
include 'classes/PlayerManager.class.php';
include_once 'classes/Player.class.php';

//pt d'entrée (entry point) des requêtes ajax envoyées par le client.
//en mettant en place une structure conditionnelle avec le if.

$req_method = $_SERVER['REQUEST_METHOD']; //renvoie le nom de la méthode HTTP utilisée par la requête du client.

if ($req_method == 'GET') { // requête en GET

    switch ($_GET['action']) {
        case 'list':
            $pm = new PlayerManager();
            echo json_encode($pm->getListFromAjax());
            break;
    
        case 'delete':
            $pm = new PlayerManager();
            if ($pm->getById($_GET['id'])->delete()) {
                echo 'Joueur supprimé';
            } else {
                echo 'La tentative de suppression a échoué';
            }
            break;

        default:
            echo 'Action non reconnue';
            break;
        }

} elseif ($req_method == 'POST'){
    //echo 'requête POST';
    //PHP ne récupère pas les données postées par le client dans $_POST lorsque la requête POST est effectuée en Ajax

    //file_get_content('php://input') renvoie les données postées par le client dans une requête ajax.
    //Par défaut, json_decode convertit la chaîne JSON en objet, le paramètre $assoc = true permet d'obtenir à la place un tableau associatif
    $data = json_decode(file_get_contents('php://input'), true);
    
    //echo json_encode($data->player);//ns avons à faire a un objet player ici.
    //$data['player'] au lieu de $data->player
    $player = new Player($data['player']);

    //echo $player->id;
    if ($player->id) {
        //l'id est défini => mode mise à jour
        if($player->update()){
            echo 'joueur mis à jour';
        } else {
            echo 'La mise a jour a échoué';
        }
    } else {
        // aucun id défini => mode insertion
        if($player->save()){
            echo 'joueur enregistré';
        } else {
            echo 'L\'enregistrement a échoué';
        }
    }

} else {
    echo'Méthode HTTP non traitée';
}


?>