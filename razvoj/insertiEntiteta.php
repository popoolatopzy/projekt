<?php


function insertKategorija_pp($kategorija_pp){
	$izraz = $veza->prepare("insert into kategorija_pp values " . 
				" (null,:kategorija_pp)");
	$izraz->execute(
	array(
	"kategorija_pp" => $kategorija_pp
	)
	);
		echo "unio kategoriju_pp <br />";
}


