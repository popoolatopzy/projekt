<?php
include_once 'konfiguracija.php';
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once 'predlozak/izbornik.php';
		?>

		<div class="row">

			<div class="large-12 columns">
				<div class="callout tijelo">
					<form data-abide novalidate method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">

						<div class="tabs-content" data-tabs-content="example-tabs">
							<div class="tabs-panel is-active" id="panel1">
									<legend>
									<h3>Podaci o investitoru</h3>
								</legend>
								<fieldset>
									<label for="naziv2">Naziv</label>
									<input id="naziv2" name="naziv2" value="gg"  type="text" placeholder="Naziv investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="oib">OIB</label>
									<input id="oib" name="oib"  value="123456789121"  type="number" placeholder="OIB investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="adresa">Adresa</label>
									<input id="adresa" name="adresa" value="gg"  type="text" placeholder="Adresa investitora" required/>
									<span class="form-error"> Obavezno polje </span>
								</fieldset>
								<input type="submit" class="button" style="width: 100%;" value="Pohrani"  />
							</div>

							

						
						</div>

						<?php

						if ($_POST) {
							$naziv2 = $_POST["naziv2"];
							$oib = $_POST["oib"];
							$adresa = $_POST["adresa"];

							$veza -> beginTransaction();
							try {	
								$izraz = $veza -> prepare("insert into investitor(naziv,oib,adresa) values(:naziv2,:oib,:adresa)");
								$izraz -> bindParam(':naziv2', $naziv2, PDO::PARAM_STR);
								$izraz -> bindParam(':oib', $oib, PDO::PARAM_INT);
								$izraz -> bindParam(':adresa', $adresa, PDO::PARAM_STR);
								$izraz -> execute();
								
								$veza -> commit();
								echo "Uspješno ste pohranili zapis.";
							} catch(PDOException $e) {
								$veza -> rollback();
								d($e);
								
							}

						}
						?>
					</form>

				</div>
			</div>
		
		<?php
		include_once 'predlozak/podnozje.php';
		?>
		<?php
		include_once 'predlozak/skripte.php';
		?>
		</div>
	</body>
</html>