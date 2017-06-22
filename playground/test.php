<?php
include '../includes/util.inc.php';

$str ="benfica-blablabla-coucou.jpg";
//echo strlen($str); //renvoie 28

$len = strlen($str);
$sub = substr($str, $len-4);
//echo $sub;

//echo substr($str, -4);

/*for ($i=-1, $i>-6; $i--){
    echo '<p>'.substr($str, $i).'</p>';
}*/

$name = 'FC Barcelona'; //retour attendu : fc-barcelona
echo rightFormat($name);

?>