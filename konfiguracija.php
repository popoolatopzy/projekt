<?php

session_start();

class Greske{
 public static $NEISPRAVAN_LOGIN=1;
 }

$naslovAPP = "Projektni ured";

$sid="projektniured";

$razvoj=$_SERVER["SERVER_NAME"]=="localhost";

$putanjaAPP="/projekt/";

//$putanjaAPP="/";

include_once 'funkcije.php';


$mysql_host = "localhost";
$mysql_database = "projekt";
$mysql_user = "nova";
$mysql_password = "nova";

//$mysql_host = "sql206.byethost13.com";
//$mysql_database = "b13_18858056_projekt";
//$mysql_user = "nvoa";
//$mysql_password = "nova";
 								
 								
		
    			
try{
	$veza = new PDO(
	"mysql:dbname=" . 	$mysql_database . 
	";host=" . 			$mysql_host 	. 
	";charset=utf8"			,
	$mysql_user				,  
	$mysql_password			, 
	array(					
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		)
	);
	
}catch(PDOException $e){
	

	switch ($e->getCode()) {
		case 2002:
			$g= "Ne mogu se spojiti na bazu. (Je li je server pokrenut i dobro navedena adresa?)";
			break;
		case 1045:
			$g= "Ne mogu se spojiti na bazu. (Neispravno korisničko ime ili lozinka)";
			break;
		case 1049:
			$g= "Ne mogu se spojiti na bazu. (Ime baze neispravno)";
			break;
		default:
			$g= "Ne mogu se spojiti na bazu. (Kontaktirajkte programera)";
			break;
	}
	header("location: greska.php?g=" . $g);
	exit();
}
