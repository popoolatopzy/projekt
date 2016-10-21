<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location: ../index.php");
}
if($_POST){
	$izraz = $veza->prepare("insert into kategorija_pp (kategorija_pp) values " . 
				" (:kategorija_pp)");
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
						
							<fieldset class="fieldset" id="visina">	
						<div class="large-9 columns">
									<div class="zaglavlje">
								<legend>
									<h3>Unos kategorije potprojekta</h3>
								</legend>
								</div>
								</div>
								<div class="large-3 columns">
    							<a href="index.php" button class="hollow button">Pregled kategorija</a>
    							</div>

							<br />
								<br />
									<label for="naziv">Kategorija
									<input id="kategorija_pp" name="kategorija_pp" type="text"  value=""  placeholder="Unesite kategoriju potprojekta" required />
									<span class="form-error"> Obavezno polje </span></label>

		<br />
		
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
