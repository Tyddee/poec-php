<?php
include 'includes/connexion_db.php';

$db = connect();

/*$query = $db->prepare('
SELECT joueur.nom, joueur.prenom, joueur.age, joueur.equipe, joueur.maillot, equipe.nom AS equipe_nom
FROM joueur, equipe 
WHERE joueur.equipe = equipe.id');*/

/*nouvelle syntaxe pr la jointure interne
INNER JOIN : jointure interne, restrictive. Elimine les lignes qui n'ont pas de correspondance dans l'autre table

LEFT JOIN : jointure externe, ouverte. Inclut les lignes n'ayant pas de correspondance dans l'autre table (colonnes manquantes remplies par NULL)*/
$query = $db->prepare('
SELECT joueur.id, joueur.nom, joueur.prenom, joueur.age, joueur.equipe, joueur.maillot, equipe.logo AS equipe_logo, equipe.nom AS equipe_nom
FROM joueur
LEFT JOIN equipe
ON joueur.equipe = equipe.id
ORDER BY joueur.nom ASC, joueur.age ASC
');

$query->execute();
$results = $query->fetchAll(); //qui devient un tableau associatif

//TEST
//$results[0]['nom'] = 'toto';

/*foreach ($results as $result) {
    $result['nom'] = 'toto';
}*/

//Modification des données (majuscule, minuscule, etc..) avant l'envoi au client (boucle).
for($i=0; $i<sizeof($results); $i++){
    //$results[$i]['nom'] = ucfirst($results[$i]['nom']); /*initiale en majuscule*/
    $results[$i]['nom'] = strtoupper($results[$i]['nom']);

    /*si le joueur n'est relié à aucune équipe, on modifie sa propriété "equipe_logo" en lui assignant le lien vers le logo de pole emploi*/
    if ($results[$i]['equipe'] == 0) {
        //$results[$i]['equipe_nom'] = "Sans équipe";
        $results[$i]['equipe_nom'] = "../img/logo/pole-emploi.jpg";
    }
}

//var_dump($results);

echo json_encode($results);

?>