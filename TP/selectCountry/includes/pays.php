<?php
include_once "connexiontp_db.php";

function getPaysList() {
    $db = connect();
    $db->exec("set names utf8");//permet d'encoder pour ç de français et les accents
    $query = $db->prepare('SELECT id,pays FROM pays');
    $query->execute();
    return $query->fetchAll();//tableau associatif
}

function getPaysById($id) {
	$db = connect();
    $db->exec("set names utf8");
    $query = $db->prepare('SELECT * FROM pays WHERE id=:id');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetch();//tableau associatif	
}
?>