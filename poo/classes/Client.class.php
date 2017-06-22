<?php

class Client 
{
    //propriétés
    public $nom; //accessible depuis l'extérieur de la classe, sans getter
    public $prenom; //idem
    private $nb_cb; //accessible à l'intérieur de la classe par l'ensemble des méthodes MAIS inacessible depuis l'extérieur. On recourt alors à la méthode d'accès (getter) : getNbCb()

    //méthodes, le constructeur fait partie des méthodes.
    //Conventionnellement c'est le constructeur que l'on met en 1er.
    function __construct($nom, $prenom, $nb_cb)
    {
        //le nom des arguments fournis en entrée est arbitraire, ils ne doivent pas forcément être identiques aux noms des propriétés.
        //echo 'Client instancié';

        //Hydratation : on fournit des valeurs aux propriétés.
        $this->nom = $nom;
        $this->prenom = $prenom;
        //$this->nb_cb = $nb_cb; //hydratation, modification directe sans contrôle
        $this->setNbCb($nb_cb); //hydratation par method, modif via une méthode setter
    }

    public function isCbValid() 
    {
        // on retire les espaces éventuels
        $cb_no_spaces = str_replace(' ', '', $this->nb_cb);

        //on vérifie que le numéro de cb contient 16 caractères
        if (strlen($cb_no_spaces) == 16) {
            return true;
        } else {
            return false;
        }
    }

    //méthode à usage interne, non accessible depuis l'extérieur de la classe
    private function isCbOk($nb_cb)
    {
        // on retire les espaces éventuels
        $cb_no_spaces = str_replace(' ', '', $nb_cb);

        //on vérifie que le numéro de cb contient 16 caractères
        if (strlen($cb_no_spaces) == 16) {
            return true;
        } else {
            return false;
        }
    }

   //Accesseur (Getter)
   //accèder à une propriété via une méthode d'accès (un accesseur) permet d'effectuer un contrôle 
   //avant de renvoyer la valeur.
   //Exemple : on renvoie le numéro de CB uniquement si l'utilisateur du site est loggé en tant qu'administrateur
    public function getNbCb()
    {
        return $this->nb_cb;
    }

    //Mutateur (setter)
    public function setNbCb($value)
    {
        if ($this->isCbOk($value)) {
            $this->nb_cb = $value;
        }
    }
}

?>