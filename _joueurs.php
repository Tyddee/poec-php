<?php
include 'includes/util.inc.php';
include 'includes/header.php';
include 'includes/menu.php';

if (isset($_GET['ageLimit'])) {
    $ageLimit = $_GET['ageLimit'];
    /*si l'utilisateur donne une valeur contenant plus de 2 caractères, on force $ageLimit à recevoir la veleur 35 par mesure de sécurité*/
    if (strlen($ageLimit) > 2) {
        $ageLimit = 35;//on impose comme age limite 35.
    }
}


//bibliothèque utilisée pour dialoguer à MySQL : PDO
//connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=formation-poec','root','');

//prépartion de la requête (en lecture)
if (isset($ageLimit)) {
    $query = $db->prepare('SELECT * FROM joueur WHERE age <'.$ageLimit);
} else {
    $query = $db->prepare('SELECT * FROM joueur');
}


//exécution de la requête
$query->execute();//execute() renvoie vrai si réussite.

/*var_dump($query); 
on aurait pu mettre print_r, mais var_dump permet de debbuger, outils de prédilection pr debug. La fct var_dump affiche la description détaillée (type et valeur) de la variable fournie en entrée, c'est rare de laisser un var_dump actif ds le code.*/

//récupération des données
//$joueurs = $query->fetchAll();

//var_dump($data);
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

<!--Nous allons itérer par rapport aux résultats-->
<?php
    // foreach ($joueurs as $joueur) {
    //     echo '<p>'.$joueur['prenom'].' '.$joueur['nom'].'</p>';
    // }
/*La méthode .fetch() renvoie sous forme d'un tableau php
La prochaine ligne (row) sql non traitée
Les lignes sql déjà traitées (fetched) sont retirées de l'objet $query
fetch() renvoie false quand ttes les lignes sql ont été traitées.*/


// variable compteur
$i = 0;

while ($joueur = $query->fetch()) {
    $i++; //incrémentation du compteur

    /*à chq itération, la variable $joueur reçoit le résultat de fetch() c-à-d un tableau associatif contenant les données joueur.*/
    $condition = 
     $joueur['maillot'] > 0 &&
     $joueur['maillot'] < 1000;  

    if ($condition) {
        echo '<p>'.$joueur['prenom'].' '.$joueur['nom'].'('.$joueur['maillot'].')';
    } else {
        echo '<p>'.$joueur['prenom'].' '.$joueur['nom'].'';
    }

    echo ' <a class="btn btn-primary btn-xs" href="updatePlayer.php?id='.$joueur['id'].'">Modifier</a>';

    echo ' |';

    echo ' <a class="btn btn-danger btn-xs" href="deletePlayer.php?id='.$joueur['id'].'">Supprimer</a>';
    
    echo '</p>';
    }
?>

<p>Nombre de résultats : <?php echo $i;?> </p>

<?php include 'includes/footer.php';?>