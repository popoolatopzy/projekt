<?php include_once '../../konfiguracija.php'; 

if (!isset($_GET["id"])  ){ 
	header("location:" . $putanjaAPP);
}


	$izraz = $veza->prepare(
	"delete from operater where id=:id");
	$izraz->execute($_GET);
	header("location: index.php" );
