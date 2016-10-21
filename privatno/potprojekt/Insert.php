<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
}
$greska="";
if($_POST){
	if($_POST["kategorija_pp"]=="0"){
		$greska="Obavezan odabir kategorije potprojekta";
		goto tijelo;
	}
	
	if($_POST["projekt"]=="0"){
		$greska="Obavezan odabir nadređenog projekta";
		goto tijelo;
	}
	
	d($_POST);
	
	
	$izraz = $veza->prepare("insert into potprojekt (kategorija_pp, naziv, broj_potprojekta, datum_p, datum_k, sporedni_projektant, opis, projekt) values " . 
							" (:kategorija_pp, :naziv, :broj_potprojekta, :datum_p, :datum_k, :sporedni_projektant, :opis, :projekt)");
	$izraz->bindParam("kategorija_pp",$_POST["kategorija_pp"]);
	$izraz->bindParam("naziv",$_POST["naziv"]);
	$izraz->bindParam("broj_potprojekta",$_POST["broj_potprojekta"]);
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
	$izraz->bindParam("sporedni_projektant",$_POST["sporedni_projektant"]);
	$izraz->bindParam("opis",$_POST["opis"]);
	$izraz->bindParam("projekt",$_POST["projekt"]);
	
	
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
									<h3>Podaci o potprojektu - novi unos</h3>
								</legend>
								</div>
								</div>
								<div class="large-3 columns">
    							<a href="index.php" button class="hollow button">Pregled potprojekata</a>
    							</div>
								
								<label for="naziv">Naziv</label>
									<input id="naziv" name="naziv" value=""  type="text" placeholder="Naziv investitora" required/>
								
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
									<input id="broj_potprojekta" name="broj_potprojekta"  value=""  type="number" placeholder="Broj potprojekta" required/>
									<span class="form-error"> Obavezno polje </span>
									
									<div class="large-6 columns">
									<label for="datum_p">Datum početka potprojekta</label>
									<input id="datum_p " name="datum_p"  value=""  type="date" />
									<span class="form-error"> Obavezno polje </span>
										</div>
										
													<div class="large-6 columns">
									<label for="datum_k">Datum kraja potprojekta</label>
									<input id="datum_k " name="datum_k"  value=""  type="date" />
									<span class="form-error"> Obavezno polje </span>
										</div>
										
									<label for="sporedni_projektant">Sporedni projektant</label>
									<input id="sporedni_projektant" name="sporedni_projektant" value=""  type="text" placeholder="Naziv sporednog projektanta" required/>
									<span class="form-error"> Obavezno polje </span>

									<label for="opis">Opis</label>
									<textarea rows="10" cols="30" id="opis" value=""  name="opis" type="text" placeholder="Opis projekta" required></textarea>
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
