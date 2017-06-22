<?php
include 'includes/util.inc.php';
include 'includes/header.php';
include 'includes/menu.php';
?>

<h1>GET</h1>
<?php 

/* la super-globale $_GET est un tableau associatif contenant les paramètres fournies ds l'URL*/

$country = $_GET['country'];
$sport = $_GET['sport'];

echop ('Pays demandé: '. $country);
echop ('Sport demandé: '. $sport);


switch (strtolower($country)) {
    case 'portugal':
        echo "Estamos muito satisfeitos de aprender PHP";
        break;
    
    case 'france':
        echo "Nous sommes très heureux d'apprendre le PHP";
        break;

    case 'italie':
        echo "Siamo molto felici di imparare il PHP";
        include 'italie.php';
        //ou pr le même resultat :include strtolower($country) . '.php';
        break;

    case 'espagne':
        echo "Estamos muy contentos de aprender PHP";
        break;
    
    default:
        echo "Pays inconnu";
        break;
}

?>
<?php include 'includes/footer.php';?>