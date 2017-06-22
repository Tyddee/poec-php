<?php
include_once 'includes/pays.php';
include '../../includes/util.inc.php';
include '../../includes/header.php';
include '../../includes/menu.php';
?>

<?php
$paysList = getPaysList();
//var_dump($paysList)
?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
<h1>Pays</h1>
<p> Faites votre choix de pays pour plus d'informations :</p>

<div class="well" id="formPays">
    <form>
        <label>Pays</label>
        <select id="paysList" name="pays">
	        <option>Faites votre choix</option>
	        <?php
		        foreach ($paysList as $key => $value) {
		        	echo "<option value=\"" . $value["id"] . "\">" . $value["pays"] . "</option>";
		        }
	        ?>
        </select>
    </form>
</div>

<div id="detailsPays">
	<ul style="float: left;">
		<li>Capitale : <span class="capitale">-</span></li>
		<li>Nombre d'habitants : <span class="habitants">-</span></li>
		<li>Superficie : <span class="superficie">-</span></li>
		<li>Langues parlées : <span class="langues">-</span></li>
	</ul>
	<div style="float: right;">
		<img style="width: 400px; padding: 10px;" class="flag" src="/projet/php/TP/selectCountry/img/flags/">
	</div>
</div>


<script src= "/projet/php/TP/selectCountry/js/zepto.min.js"></script>
<script src= "/projet/php/TP/selectCountry/js/lodash.js"></script>
<script src= "/projet/php/TP/selectCountry/js/pays.js"></script>

<?php include '../../includes/footer.php';?>
</body>
</html>
