<?php

class Player
{
    public $db;

    public $id; //nécessaire pr les opérations de màj et suppression
    public $nom;
    public $prenom;
    public $age;
    public $maillot;
    public $equipe;

    function __construct($data)
    {//hydratation interne grâce à $data
     //connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=formation-poec','root','');

        //si l'identifiant du joueur fait partie du tableau de données passé en entrée du constructeur, on l'utilise pr hydrater la propriété id de l'objet.
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        $this->nom      = $data['nom'];
        $this->prenom   = $data['prenom'];
        $this->age      = $data['age'];
        $this->maillot  = $data['maillot'];
        $this->equipe   = $data['equipe'];
    }

    function save()
    {
    //2) requête type SQL
    $query = $this->db->prepare('INSERT INTO joueur (nom, prenom, age, maillot, equipe) VALUES(:nom, :prenom, :age, :maillot, :equipe)');

    //3)execution
    return $query->execute(array(
        ':nom'      => $this->nom,
        ':prenom'   => $this->prenom,
        ':age'      => $this->age,
        ':maillot'  => $this->maillot,
        ':equipe'   => $this->equipe
    ));
    }

    function update()
    {
    $query = $this->db->prepare('UPDATE joueur SET prenom = :prenom, nom = :nom, age = :age, maillot = :maillot, equipe = :equipe WHERE id = :id');

    return $query->execute(array(
        ':prenom' =>    $this->prenom,
        ':nom' =>       $this->nom,
        ':age' =>       $this->age,
        ':maillot' =>   $this->maillot,
        ':equipe' =>    $this->equipe,
        ':id' =>        $this->id
    ));
    }

    function delete()
    {
    $query = $this->db->prepare('DELETE FROM joueur WHERE id = :id');

    return $query->execute(array(
        ':id' => $this->id
        ));
    }
}

?>