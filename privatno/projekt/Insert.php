<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
}
$greska="";
if($_POST){
	if($_POST["operater"]=="0"){
		$greska="Obavezan odabir operatera";
		goto tijelo;
	}
	
	if($_POST["tip_gradevine"]=="0"){
		$greska="Obavezan odabir tipa građevine";
		goto tijelo;
	}
	
	d($_POST);
	
	
	$izraz = $veza->prepare("insert into projekt (naziv, oznaka_projekta, broj_katastarske_cestice, tip_gradevine, lokacija, glavni_projektant, datum_p, datum_k,iznos_p,iznos_z, opis, operater) values " . 
							" (:naziv, :oznaka_projekta, :broj_katastarske_cestice, :tip_gradevine, :lokacija, :glavni_projektant, :datum_p, :datum_k, :iznos_p, :iznos_z, :opis, :operater)");
	$izraz->bindParam("naziv",$_POST["naziv"]);
	$izraz->bindParam("oznaka_projekta",$_POST["oznaka_projekta"]);
	$izraz->bindParam("broj_katastarske_cestice",$_POST["broj_katastarske_cestice"]);
	$izraz->bindParam("tip_gradevine",$_POST["tip_gradevine"]);
	$izraz->bindParam("lokacija",$_POST["lokacija"]);
	$izraz->bindParam("glavni_projektant",$_POST["glavni_projektant"]);
	if($_POST["datum_p"]==""){
	$izraz->bindValue("datum_p",$t=null,PDO::PARAM_NULL);
	}else{
	$izraz->bindParam("datum_p",$_POST["datum_p"]);
	}
	if($_POST["datum_k"]==""){
	$izraz->bindValue("datum_k",$t=null,PDO::PARAM_NULL);
	}else{
	$izraz->bindParam("datum_k",$_POST["datum_k"]);
	}
	$izraz->bindParam("iznos_p",$_POST["iznos_p"]);
	$izraz->bindParam("iznos_z",$_POST["iznos_z"]);
	$izraz->bindParam("opis",$_POST["opis"]);
	$izraz->bindParam("operater",$_POST["operater"]);
	
	$izraz->execute();
	header("location: index.php");
}
tijelo:
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
				<div class="callout tijelo">
					<?php
					include_once '../izborniknp.php';
					?>
					<form method="post"
					action="<?php echo $_SERVER["PHP_SELF"] ?>"
					data-abide novalidate>
					
						
				
					
					<fieldset class="fieldset">	
								<div class="large-9 columns">
									<div class="zaglavlje">
								<legend>
									<h3>Podaci o projektu - novi unos</h3>
								</legend>
								</div>
								</div>
								<div class="large-3 columns">
    							<a href="index.php" button class="hollow button">Pregled projekata</a>
    							</div>
								
								
									<label for="naziv">Naziv</label>
									<input id="naziv" name="naziv" type="text" placeholder="Pravne ili fizičke osobe" required 
									value=""  />		
									<span class="form-error"> Obavezno polje </span>

									<div class="large-6 columns">
										<label for="oznaka_projekta">Oznaka projekta</label>
										<input id="oznaka_projekta" name="oznaka_projekta"  value=""  type="text" placeholder="Oznaka ili naziv projekta" required />
										<span class="form-error"> Obavezno polje </span>
									</div>

									<div class="large-6 columns">
										<label for="broj_katastarske_cestice">Katastarska čestica</label>
										<input id="broj_katastarske_cestice" name="broj_katastarske_cestice" value=""  type="number" placeholder="Broj katastarske čestice" required  />
										<span class="form-error"> Obavezno polje </span>
									</div>

							
									<label for="tip_gradevine">Tip građevine</label>
									<select id="tip_gradevine" name="tip_gradevine"  />
									<option value="0">Odaberite tip građevine</option>
									<option value="stambena">Stambena zgrada</option>
									<option value="poslovna">Poslovna zgrada</option>
									<option value="industrijska">Industrijski prostor</option>
									</select>
						

									<label for="lokacija">Lokacija</label>
									<input id="lokacija" name="lokacija" type="text" value="" placeholder="Ulica, mjesto, poštanski broj" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="glavni_projektant">Glavni projektant</label>
									<input id="glavni_projektant" name="glavni_projektant" type="text" value=""  placeholder="Prezime, ime" required/>
									<span class="form-error"> Obavezno polje </span>
									
									<div class="large-6 columns">
									<label for="datum_p">Datum početka projekta</label>
									<input id="datum_p " name="datum_p"  value=""  type="date" required   />
									<span class="form-error"> Obavezno polje </span>
									</div>
										
									<div class="large-6 columns">
									<label for="datum_k">Datum završetka projekta</label>
									<input id="datum_k " name="datum_k"  value=""  type="date" required   />
									<span class="form-error"> Obavezno polje </span>
									</div>
										
										
									<div class="large-6 columns">
									<label for="iznos_p">Predviđeni iznos</label>
									<input id="iznos_p" name="iznos_p" type="number" value=""  placeholder="predviđeni iznos projekta" required  />
									<span class="form-error"> Obavezno polje </span>
									</div>
										
									<div class="large-6 columns">
									<label for="iznos_z">Završni iznos</label>
									<input id="iznos_z" name="iznos_z" type="number" value="" placeholder="završni iznos projekta" required  />
									<span class="form-error"> Obavezno polje </span>
									</div>
							
										
										
									<label for="opis">Opis</label>
									<textarea id="opis" name="opis"  rows="10" cols="30" type="text" placeholder="Opis projekta" required></textarea>
									<span class="form-error"> Obavezno polje </span>
									
									
									<label for="operater">Operater</label>
									<select id="operater" name="operater">
									<span class="form-error"> Obavezno polje </span>
									<option value="0">Odaberite operatera koji je unio podatke o projektu</option>
										<?php
										$izraz = $veza->prepare("select * from operater");
											$izraz->execute();
										$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
										//d($rezultati);
										foreach ($rezultati as $red) :
										?>
				
										<option <?php 
										if(isset($_POST["operater"]) && $_POST["operater"]==$red->id){
										echo " selected=\"selected\" ";
										}
										?> value="<?php echo $red->id ?>"><?php echo $red->prezime . " " . $red->ime ?></option>
										<?php
										endforeach;
										?>
										</select>
								
									
						
									
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
