<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location: ../index.php");
}
if (!isset($_GET["id"]) && !isset($_POST["id"]) ){ 
	header("location:" . $putanjaAPP);
}

if($_GET){
	$izraz = $veza->prepare(
	"select * from operater where id=:id");
	$izraz->execute($_GET);
	$entitet=$izraz->fetch(PDO::FETCH_OBJ);
}else{
	
	$izraz = $veza->prepare(
	"update operater set username=:username, password=:password, email=:email, ime=:ime, prezime=:prezime where id=:id");
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
				<div class="callout tijelo">
					<form method="post"
					action="<?php echo $_SERVER["PHP_SELF"] ?>"
					data-abide novalidate>
<fieldset class="fieldset">	
								<legend>
									<h3>Izmjena podataka o operateru</h3>
								</legend>

					
					<label for="username">Korisničko ime
							<input id="username" name="username" type="text"  value="<?php echo $entitet->username; ?>"  placeholder="unesite korisničko ime" required />
							<span class="form-error"> Obavezno polje </span> </label>

						<label for="password">Password 
							<input id="password" name="password" value="<?php echo $entitet->password; ?>" type="password" placeholder="unesite password" aria-describedby="exampleHelpText" required />
							<span class="form-error"> Obavezno polje</span> </label>
						<p class="help-text" id="exampleHelpText">
							Obavezno polje
						</p>
						<label for="email">E-mail
							<input id="email" name="email" type="email"  value="<?php echo $entitet->email; ?>"  placeholder="unesite email" required />
							<span class="form-error"> Obavezno polje </span> </label>
							
							
							<label for="ime">Ime korisnika
							<input id="ime" name="ime" type="text"  value="<?php echo $entitet->ime; ?>"  placeholder="unesite ime" required />
							<span class="form-error"> Obavezno polje </span> </label>

							<label for="prezime">Prezime korisnika
							<input id="ime" name="prezime" type="text"  value="<?php echo $entitet->prezime; ?>"  placeholder="unesite prezime" required />
							<span class="form-error"> Obavezno polje </span> </label>
						


					<input type="hidden" name="id" value="<?php echo $entitet->id; ?>" />
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
