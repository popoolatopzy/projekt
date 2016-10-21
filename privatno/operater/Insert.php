<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location: ../index.php");
}
if($_POST){
	$izraz = $veza->prepare("insert into operater (username, password, email, ime, prezime) values " . 
							" (:username,md5(:password),:email, :ime, :prezime)");
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
					
						<div class="large-9 columns">
									<div class="zaglavlje">
								<legend>
									<h3>Registracija novog operatera</h3>
								</legend>
								</div>
								</div>
								<div class="large-3 columns">
    							<a href="index.php" button class="hollow button">Pregled operatera</a>
    							</div>
					
					
						
						<label for="username">Korisničko ime
							<input id="username" name="username" type="text"  value=""  placeholder="unesite korisničko ime" required />
							<span class="form-error"> Obavezno polje </span> </label>

						<label for="password">Password 
							<input id="password" name="password" type="password" placeholder="unesite password" aria-describedby="exampleHelpText" required />
							<span class="form-error"> Obavezno polje</span> </label>
						<p class="help-text" id="exampleHelpText">
							Obavezno polje
						</p>
						<label for="email">E-mail
							<input id="email" name="email" type="email"  value=""  placeholder="unesite email" required />
							<span class="form-error"> Obavezno polje </span> </label>
						
							<label for="ime">Ime korisnika
							<input id="ime" name="ime" type="text"  value=""  placeholder="unesite ime" required />
							<span class="form-error"> Obavezno polje </span> </label>

							<label for="prezime">Prezime korisnika
							<input id="ime" name="prezime" type="text"  value=""  placeholder="unesite prezime" required />
							<span class="form-error"> Obavezno polje </span> </label>
						
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
