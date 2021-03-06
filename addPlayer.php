<?php
include 'includes/util.inc.php';
include 'includes/equipe.inc.php';
include_once 'includes/access.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

if (isset($_POST['input'])) {
    //echo 'Le client a validé le formulaire';
    //étape 1) : connexion au serveur sql;
    $db = new PDO('mysql:host=localhost;dbname=formation-poec','root','');

    //2) requête
    $query = $db->prepare('INSERT INTO joueur (nom, prenom, age, maillot, equipe) VALUES(:nom, :prenom, :age, :maillot, :equipe)');

    //3)execution
    $query->execute(array(
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':age' => $_POST['age'],
        ':maillot' => $_POST['maillot'],
        ':equipe' => $_POST['equipe']
    ));

    //redirection
    header('location:joueurs.php');

} else {
    //echo 'Le client n\'a pas validé le formulaire';
}

?>

<?php 
/*if (isset($_SESSION['user'])){
    if ($_SESSION['user']['role'] == 'admin'||'client') {
        include 'includes/forms/addPlayer.inc.php';
    } else {
        echop('Droits insuffisants');
    }
} else {
    echop('Vous devez être connecté pour accéder à cette ressource');
}*/

if (isLogged()) {
    if (getRole() == 'admin' || 'client') {
        include 'includes/forms/addPlayer.inc.php';
    } else {
        echop('Droits insuffisants');
    }
} else {
    echop('Vous devez être connecté pour accéder à cette ressource');
}
?>



<?php include 'includes/footer.php';?>