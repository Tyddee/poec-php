<?php

class Maths
{
    //propriétés
    public $nb1;
    public $nb2;

    //méthodes
    function __construct($v1, $v2)
    {
        //Hydratation
        $this->nb1 = $v1;
        $this->nb2 = $v2;
    }

    function add()
    {
        return $this->nb1 + $this->nb2;
    }

    function multiply()
    {
        return $this->nb1 * $this->nb2;
    }

    function substract($v1, $v2)
    {
        //return $this->nb1 - $this->nb2;

        //retourne le résultat de la soustraction entre 2 valeurs
        //fournies lors de l'appel de la méthode
        //A la différence 2 méthodes add et multiply
        //ns n'opérons pas ici sur les propriétés internes de la classe (objets issues de cette classe)
        return $v1 - $v2;
    }
}


?>