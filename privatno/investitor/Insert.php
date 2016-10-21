<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location: ../index.php");
}
if($_POST){
	$izraz = $veza->prepare("insert into investitor (naziv, oib, adresa) values " . 
				" (:naziv, :oib, :adresa)");
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

		
		<div class="row">
			<div class="large-12 columns">
				<div class="callout tijelo" id="visina">
					<?php
					include_once '../izborniknp.php';
					?>
					<form method="post"
					action="<?php echo $_SERVER["PHP_SELF"] ?>"
					data-abide novalidate>
					
					<fieldset class="fieldset" id="">	
							<div class="large-9 columns">
									<div class="zaglavlje">
								<legend>
									<h3>Podaci o investitoru</h3>
								</legend>
								</div>
								</div>
								<div class="large-3 columns">
    							<a href="index.php" button class="hollow button">Pregled investitora</a>
    							</div>
					
							
					
									<label for="naziv">Naziv</label>
									<input id="naziv" name="naziv" value=""  type="text" placeholder="Naziv investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="oib">OIB</label>
									<input id="oib" name="oib"  value=""  type="number" placeholder="OIB investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="adresa">Adresa</label>
									<input id="adresa" name="adresa" value=""  type="text" placeholder="Adresa investitora" required/>
									<span class="form-error"> Obavezno polje </span>
								
	
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
