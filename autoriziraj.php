<?php

$e = $_POST["email"];
$l = $_POST["password"];

if(!isset($e) || !isset($l)  ){
	header("location: index.php");
} 

if(strlen($e)==0 || strlen($l)==0){
	header("location: autorizacija.php");
}


include_once 'konfiguracija.php';

$izraz = $veza->prepare("select * from operater where 
email = :email and password=md5(:password);");

$izraz->execute($_POST);
$operater=$izraz->fetch(PDO::FETCH_OBJ);

if($operater!=null){
	$operater->password="8b3519adbb02f8f3f77596215ea24070";
	$upit = "update operater set zadnjilogin=now() ";
	if($operater->prvilogin==""){
		$upit.=" , prvilogin=now() ";
	}
	$upit .= " where id=:id";
	$izraz = $veza->prepare($upit);
	$izraz->execute(array("id"=>$operater->id));
	//d($operater);
	$_SESSION[$sid . "operater"] = $operater;
	header("location: index.php");
}else{
	header("location: autorizacija.php?email=" . $e . "&g=" . Greske::$NEISPRAVAN_LOGIN);
}


