<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location: ../index.php");
}
if (!isset($_GET["id"]) && !isset($_POST["id"]) ){ 
	header("location:" . $putanjaAPP);
}

if($_GET){
	$izraz = $veza->prepare(
	"select * from kategorija_pp where id=:id");
	$izraz->execute($_GET);
	$entitet=$izraz->fetch(PDO::FETCH_OBJ);
}else{
	
	//update
	$izraz = $veza->prepare(
	"update kategorija_pp set kategorija_pp=:kategorija_pp where id=:id");
	$izraz->execute($_POST);
	header("location: index.php");
}
?>



<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../predlozak/head.php';
		?>
	</head>
	<body>
	
		<?php
			include_once '../../predlozak/izbornik.php';
		?>

		<!-- tijelo -->
		<div class="row">
			<div class="large-12 columns">
				<div class="callout tijelo">
					<form method="post"
					action="<?php echo $_SERVER["PHP_SELF"] ?>"
					data-abide novalidate>
	<fieldset class="fieldset">	
		<legend>
									<h3>Izmjena naziva kategorije potprojekta</h3>
								</legend>
					
					<label for="naziv">Izmjena kategorije
									<input id="naziv" name="kategorija_pp" type="text"  value="<?php echo $entitet->kategorija_pp; ?>"  placeholder="Unesite kategoriju potprojekta" required />
									<span class="form-error"> Obavezno polje </span></label>

					<input type="hidden" name="id" value="<?php echo $entitet->id; ?>" />
								<div class="row">
									<div class="large-6 columns">
										<input type="submit" class="button siroko"  value="Unesi" />
									</div>
									<div class="large-6 columns">
										<a class="alert button siroko" href="index.php">Odustani</a>
									</div>
									
								</div>
							</fieldset>
					</form>

				</div>
			</div>

		<?php
			include_once '../../predlozak/podnozje.php';
		?>
		<?php
			include_once '../../predlozak/skripte.php';
		?>
				</div>
	</body>
</html>
