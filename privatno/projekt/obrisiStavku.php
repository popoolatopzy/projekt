<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
}

if (!isset($_POST["grupa"]) && !isset($_POST["polaznik"])){ 
	header("location:" . $putanjaAPP);
}


	$izraz = $veza->prepare("delete from stavka 
	where projekt=:projekt and investitor=:investitor");
	$izraz->execute($_POST);
	
	echo "OK";
	