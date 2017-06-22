<?php
include 'classes/PlayerManager.class.php';
include_once 'classes/Player.class.php';

$pm = new PlayerManager();
$joueurs = $pm->getListFetched();//ici joueur est tableau associatif

//donnees en DUR, on va les envelopper ds un objet.
$donnees = [
    'nom' => 'Nedved',
    'prenom' => 'Pavel',
    'age' => 45,
    'maillot' => 6,
    'equipe' => 1
];

$player = new Player($donnees); 
//l'objet $player est hydraté ci-dessus.
//var_dump($player);
/*if ($player->save()){
    echo 'Joueur enregistré en base de données';
} else {
    echo 'nooobbbbb, pas d\'enregistrement effectué';
}*/

//var_dump($pm->getById(4));
$player2 = $pm->getById(4);//ici player2 est un objet de type player
//var_dump($player2);
$player2->maillot = 19;
//var_dump($player2);

/*if ($player2->update()){
    echo 'Joueur mis à jour';
} else {
    echo 'WTF';
}*/

/*if ($pm->getById(38)->delete()) { //2 instructions chaînées, carctéristique de la POO
    echo 'Joueur supprimé';
} else {
    echo 'WTF?!';
} */

?>