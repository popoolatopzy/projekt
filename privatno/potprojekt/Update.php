<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
}
if (!isset($_GET["id"]) && !isset($_POST["idpotprojekt"]) ){ 
	header("location:" . $putanjaAPP);
}else if (!isset($_POST["idpotprojekt"])){
	$izraz = $veza->prepare(
	"select 
	a.id as idpotprojekt,
	a.naziv as nazivpp, 
	a.datum_p,
	a.datum_k,
	a.broj_potprojekta,
	a.sporedni_projektant,
	a.opis,
	b.id as idkategorija_pp,
	b.kategorija_pp,
	c.id as idprojekt,
	c.naziv
	from potprojekt a inner join kategorija_pp b on a.kategorija_pp=b.id 
	inner join projekt c on a.projekt=c.id where a.id=:id");
	$izraz->execute($_GET);
	$entitet=$izraz->fetch(PDO::FETCH_OBJ);
}



		
if($_POST ){
	error_reporting(E_ALL);
	
	$veza->beginTransaction();
	$izraz = $veza->prepare("update potprojekt set 
	naziv=:naziv, 
    broj_potprojekta=:broj_potprojekta,
	datum_p=:datum_p, 
	datum_k=:datum_k,
	sporedni_projektant=:sporedni_projektant, 
	opis=:opis, 
	projekt=:projekt where id=:id");
	$izraz->execute(
	array(
	"naziv"=>$_POST["naziv"],
	"broj_potprojekta"=>$_POST["broj_potprojekta"],
	"datum_p"=>$_POST["datum_p"],
	"datum_k"=>$_POST["datum_k"],
	"sporedni_projektant"=>$_POST["sporedni_projektant"],
	"opis"=>$_POST["opis"],
	"projekt"=>$_POST["projekt"],
	"id"=>$_POST["idpotprojekt"]
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
									<h3>Izmjena podataka o potprojektu</h3>
								</legend>
								
								<label for="naziv">Naziv</label>
									<input id="nazivpp" name="naziv" value="<?php echo $entitet->nazivpp; ?>""  type="text" placeholder="Naziv investitora" required/>
									<span class="form-error"> Obavezno polje </span>

								
									<label for="kategorija_pp">Kategorija potprojekta</label>
									<select id="kategorija_pp" name="kategorija_pp">
									<span class="form-error"> Obavezno polje </span>
									<option value="0">Odaberite kategoriju potprojekta</option>
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
									
									</select>
						
								
									
									<label for="broj_potprojekta">Broj potprojekta</label>
									<input id="broj_potprojekta" name="broj_potprojekta"  value="<?php echo $entitet->broj_potprojekta; ?>"  type="number" placeholder="Broj potprojekta" required/>
									<span class="form-error"> Obavezno polje </span>
									
									<div class="large-6 columns">
									<label for="datum_p">Datum početka potprojekta</label>
									<input type="date" id="datum_p" name="datum_p"  value="<?php echo strtotime($entitet->datum_p)>0 ? date("d.m.Y.",strtotime($entitet->datum_p)) : ""; ?>"  required/>
									<span class="form-error"> Obavezno polje </span>
									</div>
									
								
									<div class="large-6 columns">
									<label for="datum_k">Datum završetka projekta</label>
									<input id="datum_k " name="datum_k"  value="<?php echo strtotime($entitet->datum_k)>0 ? date("d.m.Y.",strtotime($entitet->datum_k)) : ""; ?>"  type="date" required/>
									<span class="form-error"> Obavezno polje </span>
									</div>
									
									<label for="sporedni_projektant">Sporedni projektant</label>
									<input id="sporedni_projektant" name="sporedni_projektant" value="<?php echo $entitet->sporedni_projektant; ?> 
									"  type="text" placeholder="Naziv sporednog projektanta" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="opis">Opis</label>
									<textarea rows="10" cols="30" id="opis"  name="opis" type="text" placeholder="Opis projekta" required><?php echo $entitet->opis; ?></textarea>
									<span class="form-error"> Obavezno polje</span>
									
									
									<label for="projekt">Nadređeni projekt</label>
									<select id="projekt" name="projekt">
									<span class="form-error"> Obavezno polje </span>
									<option value="0">Odaberite projekt kojem ovaj potprojekt pripada</option>
										<?php
										$izraz = $veza->prepare("select * from projekt");
										$izraz->execute();
										$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
										//d($rezultati);
										foreach ($rezultati as $red) :
										?>
				
								
										<option <?php 
									if(isset($_POST["projekt"]) && $_POST["projekt"]==$red->id){
									echo " selected=\"selected\" ";
									}
									?> value="<?php echo $red->id ?>"><?php echo $red->naziv ?></option>
									<?php
									endforeach;
									?>
									
									</select>
	
										<input type="hidden" name="idpotprojekt" value="<?php echo $entitet->idpotprojekt ?>" />
										<input type="hidden" name="idkategorija_pp" value="<?php echo $entitet->idkategorija_pp; ?>" />
										<input type="hidden" name="idprojekt" value="<?php echo $entitet->idprojekt; ?>" />
	
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
