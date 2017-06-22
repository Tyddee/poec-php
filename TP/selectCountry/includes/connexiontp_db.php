<?php
//connexion db
function connect() {
	return new PDO('mysql:host=localhost;dbname=tp','root','');
}

