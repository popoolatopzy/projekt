<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
}
if (!isset($_GET["id"]) && !isset($_POST["idprojekt"]) ){ 
	header("location:" . $putanjaAPP);
}else if (!isset($_POST["idprojekt"])){
	$izraz = $veza->prepare(
	"select 
	a.id as idprojekt, 
	a.naziv,
	a.oznaka_projekta, 
    a.broj_katastarske_cestice,
	a.tip_gradevine,
	a.lokacija,
	a.glavni_projektant,
	a.datum_p,
	a.datum_k,
	a.iznos_p,
	a.iznos_z,
	a.opis,
	b.id as idoperater,
	b.ime, 
	b.prezime
	from projekt a inner join operater b on a.operater=b.id where a.id=:id");
	$izraz->execute($_GET);
	
	$entitet=$izraz->fetch(PDO::FETCH_OBJ);
}
		
		
if($_POST ){
	error_reporting(E_ALL);

	
	$veza->beginTransaction();
	$izraz = $veza->prepare("update projekt set 
	naziv=:naziv, 
	oznaka_projekta=:oznaka_projekta, 
    broj_katastarske_cestice=:broj_katastarske_cestice,
	tip_gradevine=:tip_gradevine, 
	lokacija=:lokacija, 
	glavni_projektant=:glavni_projektant, 
	datum_p=:datum_p, 
	datum_k=:datum_k,
	iznos_p=:iznos_p,
	iznos_z=:iznos_z,
	opis=:opis where id=:id");
	$izraz->execute(
	array(
	"naziv"=>$_POST["naziv"],
	"oznaka_projekta"=>$_POST["oznaka_projekta"],
	"broj_katastarske_cestice"=>$_POST["broj_katastarske_cestice"],
	"tip_gradevine"=>$_POST["tip_gradevine"],
	"lokacija"=>$_POST["lokacija"],
	"glavni_projektant"=>$_POST["glavni_projektant"],
	"datum_p"=>$_POST["datum_p"],
	"datum_k"=>$_POST["datum_k"],
	"iznos_p"=>$_POST["iznos_p"],
	"iznos_z"=>$_POST["iznos_z"],
	"opis"=>$_POST["opis"],
	"id"=>$_POST["idprojekt"]
	));
	


	
	$veza->commit();
	
	header("location: index.php" );


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
									<h3>Izmjena podataka o projektu</h3>
								</legend>
								
								
									<label for="naziv">Naziv</label>
									<input id="naziv" name="naziv" type="text" placeholder="Pravne ili fizičke osobe"  value="<?php echo $entitet->naziv; ?>" required />		
									<span class="form-error"> Obavezno polje </span>

									<div class="large-6 columns">
										<label for="oznaka_projekta">Oznaka projekta</label>
										<input id="oznaka_projekta" name="oznaka_projekta"  value="<?php echo $entitet->oznaka_projekta; ?>"  type="text" placeholder="Oznaka ili naziv projekta" required />
										<span class="form-error"> Obavezno polje </span>
									</div>

									<div class="large-6 columns">
										<label for="broj_katastarske_cestice">Katastarska čestica</label>
										<input id="broj_katastarske_cestice" name="broj_katastarske_cestice" value="<?php echo $entitet->broj_katastarske_cestice; ?>"  type="number" placeholder="Broj katastarske čestice" required  />
										<span class="form-error"> Obavezno polje </span>
									</div>

							
									<label for="tip_gradevine">Tip građevine</label>
									<select id="tip_gradevine" name="tip_gradevine">
									<option value="0">Odaberite tip građevine</option>
									<option value="stambena">Stambena zgrada</option>
									<option value="poslovna">Poslovna zgrada</option>
									<option value="industrijska">Industrijski prostor</option>
									</select>
						

									<label for="lokacija">Lokacija</label>
									<input id="lokacija" name="lokacija" type="text" value="<?php echo $entitet->lokacija; ?>" placeholder="Ulica, mjesto, poštanski broj" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="glavni_projektant">Glavni projektant</label>
									<input id="glavni_projektant" name="glavni_projektant" type="text" value="<?php echo $entitet->glavni_projektant; ?>"  placeholder="Prezime, ime" required/>
									<span class="form-error"> Obavezno polje </span>
									
									<div class="large-6 columns">
									<label for="datum_p">Datum početka projekta</label>
									<input id="datum_p " name="datum_p"  value="<?php echo strtotime($entitet->datum_p)>0 ? date("d.m.Y.",strtotime($entitet->datum_p)) : ""; ?>"  type="date" />
									<span class="form-error"> Obavezno polje </span>
									</div>
									
									<div class="large-6 columns">
									<label for="datum_k">Datum završetka projekta</label>
									<input id="datum_k " name="datum_k"  value="<?php echo strtotime($entitet->datum_k)>0 ? date("d.m.Y.",strtotime($entitet->datum_k)) : ""; ?>"  type="date" />
									<span class="form-error"> Obavezno polje </span>
									</div>
						
						
										<div class="large-6 columns">
										<label for="iznos_p">Predviđeni iznos</label>
										<input id="iznos_p" name="iznos_p" type="number" value="<?php echo $entitet->iznos_p; ?>" placeholder="predviđeni iznos projekta" required  />
										<span class="form-error"> Obavezno polje </span>
										</div>
										<div class="large-6 columns">
										<label for="iznos_z">Završni iznos</label>
										<input id="iznos_z" name="iznos_z" type="number" value="<?php echo $entitet->iznos_z; ?>" placeholder="završni iznos projekta" required  />
										<span class="form-error"> Obavezno polje </span>
										</div>
						
						
						
									<label for="opis">Opis</label>
									<textarea id="opis" name="opis" rows="10" cols="30" type="text" placeholder="Opis projekta" required><?php echo $entitet->opis; ?></textarea>
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
								
									
										<input type="hidden" name="idprojekt" value="<?php echo $entitet->idprojekt ?>" />
										<input type="hidden" name="idoperater" value="<?php echo $entitet->idoperater; ?>" />
									
										
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
