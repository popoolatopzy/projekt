<?php

set_time_limit(1000);
include_once '../konfiguracija.php';
include_once 'insertiEntiteta.php';

error_reporting(E_ERROR | E_PARSE);


//kategorija_pp

$handle = fopen("kategorija_pp.txt", "r");
$kategorija_pp=array();
if (!$handle) {
	echo "Problem kod čitanja datoteke";
	return;
}

while (($line = fgets($handle)) !== false) {
	if(strlen(trim($line))==0){
		continue;
	}
	
	if(substr($line, 0,1)!=="#"){
		continue;
	}
	array_push($kategorija_pp,$line);
	
	}
	
	fclose($handle);

shuffle($kategorija_pp);





