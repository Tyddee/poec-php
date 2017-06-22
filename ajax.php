<?php 
$players = ['Chiellini', 'Benatia', 'Rincon'];

// Tableau associatif

$bonucci1 = [
    'path' => 'img/joueurs/bonucci1.jpg',
    'caption' => 'Bonucci menant équipe',
    'alt' => 'Meneur'
];

$bonucci2 = [
    'path' => 'img/joueurs/bonucci2.jpg',
    'caption' => 'Bonucci content',
    'alt' => 'Happy'
];

$bonucci3 = [
    'path' => 'img/joueurs/bonucci3.jpg',
    'caption' => 'Bonucci en conférence de presse',
    'alt' => 'Conférence'
];

$joueur = [
    'nom' => 'Bonucci', 
    'prenom' => 'Leonardo',
    'age' => 29,
    'numero' => 19,
    'club' => 'Juventus',
    'international' => true,
    'photos' => ['bonucci1','bonucci2','bonucci3'],//structure itérable.
    'photos2' => [$bonucci1, $bonucci2, $bonucci3] //variables.
    ];

/*print_r($players); 
retourne la chaîne de caractère suivante (pas un tableau) : Array ( [0] => Chiellini [1] => Benatia [2] => Rincon )*/

echo json_encode($players); /*IMPORTANT : envoie au client les données (le tableau) au format JSON (format d'échange de données*/

//echo json_encode($joueur);

?>