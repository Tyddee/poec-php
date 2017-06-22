<?php

class Equipe 
{
    //propriétés (sec)
    public $nom;
    public $annee_creation;
    public $entraineur;
    public $couleurs;
    public $rencontres = []; //cette variable n'est pas hydraté, on a une petite usine.

    //méthodes (on fournit un tableau associatif, $data est un tableau de données, argument de type complexe)
    function __construct($data)
    {
        //Hydratation
        $this->nom              = $data['nom'];
        $this->annee_creation   = $data['annee_creation'];
        $this->entraineur       = $data['entraineur'];
        $this->couleurs         = $data['couleurs'];
    }

    function joueContre($adversaire, $lieu, $date)
    {
        //ajoute au tableau des rencontres, un tableau associatif contenant les infos de la rencontre
        //tableau imbriqué avec des clés-valeurs: (objet)
        array_push($this->rencontres, [
            "adversaire" => $adversaire,
            "lieu" => $lieu,
            "date" => $date
            ]);
    }
}

?>