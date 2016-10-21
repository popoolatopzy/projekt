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
									<h3>Podaci o projektu</h3>
								</legend>
								<fieldset>
									<label for="naziv">Naziv</label>
									<input id="naziv" name="naziv" type="text"  value="gg"  placeholder="Pravne ili fizičke osobe" required />
									<span class="form-error"> Obavezno polje </span>

									<div class="large-6 columns">
										<label for="oznaka_projekta">Oznaka projekta</label>
										<input id="oznaka_projekta" name="oznaka_projekta"  value="gg"  type="text" placeholder="Oznaka ili naziv projekta" required />
										<span class="form-error"> Obavezno polje </span>
									</div>

									<div class="large-6 columns">
										<label for="broj_katastarske_cestice">Katastarska čestica</label>
										<input id="broj_katastarske_cestice" name="broj_katastarske_cestice" value="456789"  type="number" placeholder="Broj katastarske čestice" required  />
										<span class="form-error"> Obavezno polje </span>
									</div>

							


					<label for="smjer">Tip građevine</label>
						<select id="tip_gradevine" name="tip_gradevine">
							<option value="0">Odaberite tip građevine</option>
							<!-- sredittttttttttttttttttttttttttttttttttiiiiiiii-->
						</select>


									<label for="lokacija">Lokacija</label>
									<input id="lokacija" name="lokacija" type="text" value="gg" placeholder="Ulica, mjesto, poštanski broj" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="glavni_projektant">Glavni projektant</label>
									<input id="glavni_projektant" name="glavni_projektant" type="text" value="gg"  placeholder="Prezime, ime" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="datum ">Datum</label>
									<input id="datum " name="datum"  value="05-05-2016"  type="date" />
									<span class="form-error"> Obavezno polje </span>

									<label for="opis">Opis</label>
									<textarea rows="10" cols="30" id="opis" value="ggaagafafaffffffffffffffffffffffffffg"  name="opis" type="text" placeholder="Opis projekta" required></textarea>
									<span class="form-error"> Obavezno polje </span>
								</fieldset>
								<input type="submit" class="button" style="width: 100%;" value="Pohrani"  />

							</div>

							

						
						</div>

						<?php

						if ($_POST) {
							$naziv = $_POST["naziv"];
							$oznaka_projekta = $_POST["oznaka_projekta"];
							$broj_katastarske_cestice = $_POST["broj_katastarske_cestice"];
							$tip_gradevine = $_POST["tip_gradevine"];
							$lokacija = $_POST["lokacija"];
							$glavni_projektant = $_POST["glavni_projektant"];
							$datum = $_POST["datum"];
							$opis = $_POST["opis"];

							

							$veza -> beginTransaction();
							try {
								$izraz = $veza -> prepare("insert into projekt(korisnik,naziv, oznaka_projekta, broj_katastarske_cestice, tip_gradevine, lokacija, glavni_projektant, datum, opis) values (1, :naziv, :oznaka_projekta, :broj_katastarske_cestice, :tip_gradevine, :lokacija, :glavni_projektant, :datum, :opis)");
								$izraz -> bindParam(':naziv', $naziv, PDO::PARAM_STR);
								$izraz -> bindParam(':oznaka_projekta', $oznaka_projekta, PDO::PARAM_STR);
								$izraz -> bindParam(':broj_katastarske_cestice', $broj_katastarske_cestice, PDO::PARAM_INT);
								$izraz -> bindParam(':tip_gradevine', $tip_gradevine, PDO::PARAM_STR);
								$izraz -> bindParam(':lokacija', $lokacija, PDO::PARAM_STR);
								$izraz -> bindParam(':glavni_projektant', $glavni_projektant, PDO::PARAM_STR);
								$izraz -> bindParam(':datum', $datum, PDO::PARAM_INT);
								$izraz -> bindParam(':opis', $opis, PDO::PARAM_STR);
								$izraz -> execute();
								$zadnji = $veza->lastInsertId();
								
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