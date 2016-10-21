<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
}

if (!isset($_POST["projekt"]) && !isset($_POST["investitor"])){ 
	header("location:" . $putanjaAPP);
}


	$izraz = $veza->prepare("insert into stavka (projekt, investitor, iznos_p, iznos_z) 
	values (:projekt,:investitor,:iznos_p,:iznos_z)");
	$izraz->execute($_POST);
	
	echo "OK";
	