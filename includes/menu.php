<?php
include_once 'access.inc.php';
//$base = 'http://localhost/projet/php/';
$menus = [
    ['href' => 'index.php', 'label' => 'Accueil'],
    ['href' => 'variables.php', 'label' => 'Variables'],
    ['href' => 'boucles.php', 'label' => 'Boucles'],
    ['href' => 'fonctions.php', 'label' => 'Fonctions'],
    ['href' => 'get.php?country=portugal&sport=football', 'label' => 'GET'],
    ['href' => 'joueurs.php', 'label' => 'Joueurs (PHP)'],
    ['href' => 'players.php', 'label' => 'Joueurs (ajax)'],
    ['href' => 'angularjs/index.php', 'label' => 'Angular'],
    ['href' => 'equipes.php', 'label' => 'Equipes'],
    ['href' => 'addPlayer.php', 'label' => 'Ajouter un joueur'],
    ['href' => 'addTeam.php', 'label' => 'Ajouter une équipe'],
    ['href' => 'TP/selectCountry/index.php', 'label' => 'TP selectCountry'],
];//source de données, fait en static, en raw. Viendra + tard une vraie bdd.
?>

<nav>
    <ul class="list-inline">
    <?php
    //foreach ($menus as $menu) {
        //echo '<li>'.$menu['label'].'</li>';
    //}
    ?>
<!--syntaxe alternative, ou template, pertinente qd on utilise directement le html-->
    <?php foreach ($menus as $menu): ?>
        <li>
            <a href="/projet/php/<?php echo $menu['href']; ?>">
            <?php echo $menu['label']; ?>
            </a>
        </li>
    <?php endforeach ?>
        <?php
            if (isLogged()) {
                echo '<li><a href="logout.php">Déconnexion</a></li>';
            }
        ?>
    </ul>
</nav>
