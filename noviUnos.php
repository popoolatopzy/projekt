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

						<ul class="tabs" data-tabs id="example-tabs">
							<li class="tabs-title is-active">
								<a href="#panel1" aria-selected="true">Projekt</a>
							</li>
							<li class="tabs-title">
								<a href="#panel2">Potprojekt</a>
							</li>
							<li class="tabs-title">
								<a href="#panel3">Investitor</a>
							</li>
						</ul>

						<div class="tabs-content" data-tabs-content="example-tabs">
							<div class="tabs-panel is-active" id="panel1">
							
								</p>

						<legend>
									<h3>Podaci o projektu</h3>
								</legend>


						<label for="smjer">Tip građevine</label>
						<select id="tip_gradevine" name="tip_gradevine">
							<option value="0">Odaberite tip građevine</option>
							<?php
							$izraz = $veza->prepare("select * from kategorija_pp order by kategorija_pp");
						$izraz->execute();
						$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
						//d($rezultati);
						
						foreach ($rezultati as $red) :
							?>
							<option <?php
								if (isset($_POST["kategorija_pp"]) && $_POST["kategorija_pp"] == $red -> id) {
									echo " selected=\"selected\" ";
								}
							?> value="<?php echo $red->id ?>"><?php echo $red->kategorija_pp ?></option>
							<?php
							endforeach;
							?>
							
						</select>

									<label for="lokacija">Lokacija</label>
									<input id="lokacija" name="lokacija" type="text" value="" placeholder="Ulica, mjesto, poštanski broj" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="glavni_projektant">Glavni projektant</label>
									<input id="glavni_projektant" name="glavni_projektant" type="text" value=""  placeholder="Prezime, ime" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="datum1">Datum</label>
									<input id="datum1 " name="datum1"  value=""  type="date" />
									<span class="form-error"> Obavezno polje </span>

									<label for="opis">Opis</label>
									<textarea rows="10" cols="30" id="opis" value=""  name="opis" type="text" placeholder="Opis projekta" required></textarea>
									<span class="form-error"> Obavezno polje </span>
								</fieldset>
							<div data-alert class="alert-box alert radius">
      <strong>Niste ulogirani</strong> - Za unos podataka, potrebno je biti ulogiran u sustav.
      <a href="#" class="close">&times;</a>
    </div>


							</div>

							<div class="tabs-panel" id="panel2">
								<legend>
									<h3>Podaci o potprojektu</h3>
								</legend>
								<fieldset>
									<label for="naziv2">Naziv</label>
									<input id="naziv2" name="naziv" value=""  type="text" placeholder="Naziv investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="broj_potprojekta">Broj potprojekta</label>
									<input id="broj_potprojekta" name="broj_potprojekta"  value=""  type="number" placeholder="Broj potprojekta" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="datum1">Datum</label>
									<input id="datum" name="datum"  value=""  type="date" />
									<span class="form-error"> Obavezno polje </span>

									<label for="sporedni_projektant">Sporedni projektant</label>
									<input id="sporedni_projektant" name="sporedni_projektant" value=""  type="text" placeholder="Naziv sporednog projektanta" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="opis">Opis</label>
									<textarea rows="10" cols="30" id="opis" value=""  name="opis" type="text" placeholder="Opis projekta" required></textarea>
									<span class="form-error"> Obavezno polje</span>

								</fieldset>
								
							<div data-alert class="alert-box alert radius">
      <strong>!</strong> - Za unos podataka, potrebno je biti ulogiran u sustav.
      <a href="#" class="close">&times;</a>
    </div>





							</div>

							<div class="tabs-panel" id="panel3">
								<legend>
									<h3>Podaci o investitoru</h3>
								</legend>
								<fieldset>
									<label for="naziv2">Naziv</label>
									<input id="naziv2" name="naziv2" value=""  type="text" placeholder="Naziv investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="oib">OIB</label>
									<input id="oib" name="oib"  value=""  type="number" placeholder="OIB investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="adresa">Adresa</label>
									<input id="adresa" name="adresa" value=""  type="text" placeholder="Adresa investitora" required/>
									<span class="form-error"> Obavezno polje </span>
								</fieldset>
								
								<div data-alert class="alert-box alert radius">
      <strong>!</strong> - Za unos podataka, potrebno je biti ulogiran u sustav.
      <a href="#" class="close">&times;</a>
    </div>

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

							$naziv1 = $_POST["naziv1"];
							$broj_projekta = $_POST["broj_potprojekta"];
							$datum1 = $_POST["datum1"];
							$sporedni_projektant = $_POST["sporedni_projektant"];
							$opis1 = $_POST["opis1"];

							$naziv2 = $_POST["naziv2"];
							$oib = $_POST["oib"];
							$adresa = $_POST["adresa"];

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
								$zadnji = $veza -> lastInsertId();
								$veza -> commit();
								$izraz1 = $veza -> prepare("insert into potprojekt(naziv,broj_potprojekta,datum,sporedni_projektant,opis) values(:naziv1,:broj_potprojekta,:datum1,:sporedni_projektant,:opis1)");
								$izraz1 -> bindParam(':naziv1', $naziv1, PDO::PARAM_STR);
								$izraz1 -> bindParam(':broj_projekta', $broj_potprojekta, PDO::PARAM_INT);
								$izraz1 -> bindParam(':datum1', $datum1, PDO::PARAM_INT);
								$izraz1 -> bindParam(':sporedni_projektant', $sporedni_projektant, PDO::PARAM_STR);
								$izraz1 -> bindParam(':opis1', $opis1, PDO::PARAM_STR);
								$izraz1 -> execute();
								$zadnji = $veza -> lastInsertId();
								$izraz2 = $veza -> prepare("insert into investitor(naziv,oib,adresa) values(:naziv2, :oib,:adresa)");
								$izraz2 -> bindParam(':naziv2', $naziv2, PDO::PARAM_STR);
								$izraz2 -> bindParam(':oib', $oib, PDO::PARAM_INT);
								$izraz2 -> bindParam(':adresa', $adresa, PDO::PARAM_STR);
								$izraz2 -> execute();
								$zadnji = $veza -> lastInsertId();
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