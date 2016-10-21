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
									<h3>Podaci o potprojektu</h3>
								</legend>
								<fieldset>
									
									<label for="kategorija_pp">Kategorija potprojekta</label>
									<select id="kategorija_pp" name="kategorija_pp">
							<option value="0">Odaberite tip građevine</option>
					
									<?php
									$izraz = $veza->prepare("select * from kategorija_pp order by kategorija_pp");
									$izraz->execute();
									$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
									//d($rezultati);
						
									foreach ($rezultati as $red) :
									?>
									<option <?php 
									if(isset($_POST["kategorija_pp"]) && $_POST["kategorija_pp"]==$red->id){
									echo " selected=\"selected\" ";
									}
									?> value="<?php echo $red->id ?>"><?php echo $red->kategorija_pp ?></option>
									<?php
									endforeach;
									?>
									
									
									<label for="naziv2">Naziv</label>
									<input id="naziv2" name="naziv" value="gg"  type="text" placeholder="Naziv investitora" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="broj_potprojekta">Broj potprojekta</label>
									<input id="broj_potprojekta" name="broj_potprojekta"  value="123456789121"  type="number" placeholder="Broj potprojekta" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="datum1">Datum</label>
									<input id="datum" name="datum"  value="05-05-2016"  type="date" />
									<span class="form-error"> Obavezno polje </span>

									<label for="sporedni_projektant">Sporedni projektant</label>
									<input id="sporedni_projektant" name="sporedni_projektant" value="gg"  type="text" placeholder="Naziv sporednog projektanta" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="opis">Opis</label>
									<textarea rows="10" cols="30" id="opis" value="ggaagafafaffffffffffffffffffffffffffg"  name="opis" type="text" placeholder="Opis projekta" required></textarea>
									<span class="form-error"> Obavezno polje</span>

								</fieldset>
								<input type="submit" class="button" style="width: 100%;" value="Pohrani"  />

							</div>

							

						
						<?php

						if ($_POST) {
							$kategorija_pp = $_POST["kategorija_pp"];
							$naziv = $_POST["naziv"];
							$broj_projekta = $_POST["broj_potprojekta"];
							$datum = $_POST["datum"];
							$sporedni_projektant = $_POST["sporedni_projektant"];
							$opis = $_POST["opis"];

							$veza -> beginTransaction();
							try {		
								$izraz1 = $veza -> prepare("insert into potprojekt(kategorija_pp,naziv,broj_potprojekta,datum,sporedni_projektant,opis) values(:kategorija_pp,:naziv,:broj_potprojekta,:datum,:sporedni_projektant,:opis)");
								$izraz1 -> bindParam(':kategorija_pp', $kategorija_pp, PDO::PARAM_STR);
								$izraz1 -> bindParam(':naziv', $naziv, PDO::PARAM_STR);
								$izraz1 -> bindParam(':broj_projekta', $broj_potprojekta, PDO::PARAM_INT);
								$izraz1 -> bindParam(':datum', $datum, PDO::PARAM_INT);
								$izraz1 -> bindParam(':sporedni_projektant', $sporedni_projektant, PDO::PARAM_STR);
								$izraz1 -> bindParam(':opis', $opis, PDO::PARAM_STR);
								$izraz1 -> execute();
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