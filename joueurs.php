<?php
include 'poo/classes/PlayerManager.class.php';

include 'includes/util.inc.php';
include 'includes/equipe.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

if (isset($_GET['ageLimit'])) {
    $ageLimit = $_GET['ageLimit'];

    if (strlen($ageLimit) > 2) {
        $ageLimit = 35;//on impose comme age limite 35.
    }
}


/*//connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=formation-poec','root','');

//préparation de la requête (en lecture)
if (isset($ageLimit)) {     //if isset= si la variable ageLimit existe
    $query = $db->prepare('SELECT * FROM joueur WHERE age <'.$ageLimit);
} else {
    $query = $db->prepare('SELECT * FROM joueur');
}

//exécution de la requête
$query->execute();//execute() renvoie vrai si réussite.*/


//Connexion en orienté objet:
$pm = new PlayerManager();

if (isset($ageLimit)) {
    $query = $pm->getListFilteredByAge($ageLimit);
} else {
    $query = $pm->getList();
}

?>

<h1>Joueurs</h1>

<div>
    <form>
        <label>Limite d'âge</label>
        <select name="ageLimit">
            <option value="20">20 ans</option>
            <option value="25">25 ans</option>
            <option value="30">30 ans</option>
            <option value="35">35 ans</option>
        </select>
        <input type="submit" value="Valider">
    </form>
</div>

<?php
    $output = '<div class="equipe">'; /*ouverture d'une zone de mémoire.Le balisage html va s'accumuler ici.*/
    $i = 0; //initialisation

    while ($joueur = $query->fetch()) {
        $i++;

    $condition = 
     $joueur['maillot'] > 0 &&
     $joueur['maillot'] < 1000;  

    if ($condition) {
        $output .= '<p>'.$joueur['prenom'].' '.$joueur['nom'].'('.$joueur['maillot'].')';
    } else {
        $output .= '<p>'.$joueur['prenom'].' '.$joueur['nom'].'';
    }

    $team = getTeamById($joueur['equipe']);
    if (!$team) { // équivalent à $team == false
        $output .= ', SCF';
    } else {
         //$output .= ', equipe :'. $team['nom'];
        $output .= '<img src="'.$team['logo'].'">';
    }
    //var_dump(getTeamById($joueur['equipe']));

    $output .= ' <a class="btn btn-primary btn-xs" href="updatePlayer.php?id='.$joueur['id'].'">Modifier</a>';

    $output .= ' |';

    $output .= ' <a class="btn btn-danger btn-xs" href="deletePlayer.php?id='.$joueur['id'].'">Supprimer</a>';
    
    $output .= '</p>';
    }

    $output .= '</div>';
    echo '<p>Nombre de résultats : '.$i.'</p>';
    echo $output;
?>

<?php include 'includes/footer.php';?>