<?php
include 'includes/pays.php';

//récupération de l'id fourni en paramètre d'url
if(empty($_GET['id'])) {
	die('error');
}

$results = getPaysById($_GET['id']);

//réponse au client sous le format json
echo json_encode($results);
?>
