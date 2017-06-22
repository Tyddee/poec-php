<?php
include_once 'Player.class.php';

//la connexion va être caché à l'utilisateur :
class PlayerManager
{
    public $db;//membre global, visible pr ttes les fct

    function __construct()//instanciation de la classe
    {
        $this->db = new PDO('mysql:host=localhost;dbname=formation-poec','root','');
    }

    function getList() //permet de faire l'execution la requête SQL
    {
        $query = $this->db->prepare('SELECT * FROM joueur');
        $query->execute();
        return $query; //renvoie le retour SQL sans fetch
    }

    function getListFilteredByAge($ageLimit)
    {
        $query = $this->db->prepare('SELECT * FROM joueur WHERE age <'. $ageLimit);
        $query->execute();
        return $query;
    }

    function getListFetched()
    {
        $query = $this->db->prepare('SELECT * FROM joueur');
        $query->execute();
        return $query->fetchAll(); //renvoie tableau associatif
    }

    function getListFromAjax()
    {
        $query = $this->db->prepare('
            SELECT joueur.id, joueur.nom, joueur.prenom, joueur.age, joueur.equipe, joueur.maillot, equipe.logo AS equipe_logo, equipe.nom AS equipe_nom
            FROM joueur
            LEFT JOIN equipe
            ON joueur.equipe = equipe.id
            ORDER BY joueur.nom ASC, joueur.age ASC
        ');

        $query->execute();
        $results = $query->fetchAll(); //qui devient un tableau associatif

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
        return $results;

    }

    function getById($id)
    {
        $query = $this->db->prepare('SELECT * FROM joueur WHERE id = :id');
        $query->execute(array(
            ':id' => $id
        ));
        
        //return $query->fetch();//renvoie un tableau associatif

        //renvoie ici un objet de type player
        $player = new Player($query->fetch());//query fetch = transformation du tableau associatif, l'identifiant en fait partie. 2 transformation possible.
        return $player;//ttes les propriétés sont hyfdratés ici.
    }
}

?>