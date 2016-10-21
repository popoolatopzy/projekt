<?php include_once '../../konfiguracija.php'; 

if (!isset($_GET["id"])  ){ 
	header("location:" . $putanjaAPP);
}

print_r($_GET);
	$izraz = $veza->prepare(
	"delete from investitor where id=:id");
	$izraz->execute($_GET);
	header("location: index.php" );

	
