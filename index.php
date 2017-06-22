<?php
    include 'includes/header.php';
    include 'includes/menu.php';
    $title = "Formation PHP Aston";
    $connected = true;
?>

<h1><?php echo $title; ?></h1>


<!-- Formulaire de connexion -->
<?php if($connected): ?>
<form action="login.php" method="POST">
<!-- par défaut method est en post, pas besoin de l'indiquer-->
    <label>Email: </label>
    <input name="email" type="email" placeholder="Tapez votre email">
    
    <label>Mot de passe: </label>
    <input name="pass" type="password" placeholder="Tapez votre mot de passe">

    <label>Administrateur: </label>
    <input type="checkbox" name="admin">

    <input type="submit" name="valider">
</form>
<?php endif ?>

<?php include 'includes/footer.php';?>