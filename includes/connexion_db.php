<?php
    
//1) connexion par une fonction
function connect (){
    $db = new PDO('mysql:host=localhost;dbname=formation-poec','root','');
    return $db;
}

?>