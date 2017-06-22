<?php
include 'includes/util.inc.php';
include 'includes/equipe.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

if (isset($_POST['input']) && isset($_FILES)) {

$extension = substr($_FILES['logo']['name'], -4);
$conditions = $_FILES['logo']['size'] < 500000 && isFormatAllowed($extension);
//expression bolean ci-dessus

    // upload du fichier
    if ($conditions) {
        //var_dump($_FILES);
        //echo '<p>Fichier correct</p>';
        
        /*déplacer le fichier de la zone temporaire vers son emplacement "définitif" sur le serveur*/
        $src = $_FILES['logo']['tmp_name'];
        
        /*$dest = 'img/logo/' . $_FILES['logo']['name']; On annule celui-ci pr que l'utilisateur n'intègre pas n'importe quel nom*/
        $dest = 'img/logo/' . rightFormat ($_POST['nom']).$extension;/*On récupère le nom de l'équipe pr l'image et on lui impose un format de sortie avec la fonction rightFormat*/

        /*Déplacer le fichier ds la zone temporaire vers son emplacement "définitif" sur le serveur*/
        move_uploaded_file($src, $dest);

    $team = $_POST; //copie $_POST dans $team;
    $team['logo'] = $dest; // on ajoute la clé 'logo' au tableau associatif $team;
    //var_dump($team);

    //formulaire posté
    if (createTeam($team)){
        //redirection de l'internaute vers la page equipe.php
        header ('location:equipes.php');
    } else {
        echo '<p class="text-warning">L\'enregistrement a échoué</p>';
    }

    //var_dump($_POST);
    //var_dump($_FILES['logo']);
    } else {
        echo '<p>Format non autorisé ou fichier trop lourd</p>';
    }
}
?>

<?php 
//if (isset($_SESSION['logged'])){
if (isset($_SESSION['user'])){
    if ($_SESSION['user']['role'] == 'admin') {
        include 'includes/forms/addTeam.inc.php';
    } else {
        echop('Droits insuffisants');
    }
} else {
    echop('Vous devez être connecté pour accéder à cette ressource');
}

?>


<?php include 'includes/footer.php';?>