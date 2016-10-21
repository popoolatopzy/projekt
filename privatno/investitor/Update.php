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
	"select * from investitor where id=:id");
	$izraz->execute($_GET);
	$entitet=$izraz->fetch(PDO::FETCH_OBJ);
}else{
	
	//update
	$izraz = $veza->prepare(
	"update investitor set naziv=:naziv, oib=:oib, adresa=:adresa  where id=:id");
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
									<h3>Izmjena podataka o investitoru</h3>
								</legend>
					
									<label for="naziv">Naziv</label>
									<input id="naziv" name="naziv" value="<?php echo $entitet->naziv; ?>"  type="text" placeholder="Naziv investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="oib">OIB</label>
									<input id="oib" name="oib"  value="<?php echo $entitet->oib; ?>"  type="number" placeholder="OIB investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="adresa">Adresa</label>
									<input id="adresa" name="adresa" value="<?php echo $entitet->adresa; ?>"  type="text" placeholder="Adresa investitora" required/>
									<span class="form-error"> Obavezno polje </span>

					<input type="hidden" name="id" value="<?php echo $entitet->id; ?>" />
								
								<div class="row">
									<div class="large-6 columns">
										<input type="submit" class="button siroko"  value="Unesi promjene" />
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
