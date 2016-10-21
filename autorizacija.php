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
				<div class="callout tijelo" id="visina">
					<div class="row" id="log">
						<div class="medium-6 medium-centered large-4 large-centered columns">
							<form method="post" action="autoriziraj.php">
								
								<div class="row column log-in-form">
									<h4 class="text-center">Prijava u sustav</h4>
									<label><br />
										<div class="row collapse">
            							<div class="small-2 columns ">
           				 				  <span class="prefix"><i class="fi-torso-female"></i></span>
          								  </div>
										<div class="small-10 columns ">
										<input type="email" name="email" placeholder="somebody@example.com" aria-describedby="emailPomoc" required 
										value="<?php echo isset($_GET["email"]) ? $_GET["email"] : ""; ?>">
										</div>
										</div>
										<span class="form-error"> Molimo unijeti ispravan email </span> </label>
									</label>

									<label>
										<div class="row collapse">
            							<div class="small-2 columns ">
           				 				  <span class="prefix"><i class="fi-lock"></i></span>
          								  </div>
										<div class="small-10 columns ">
										<input type="password" name="password" placeholder="Password" aria-describedby="lozinkaPomoc" required >
										</div>
										</div>
										<span class="form-error"> Obavezan unos lozinke </span> </label>
																
									<?php
									if (isset($_GET["g"]) && $_GET["g"] == Greske::$NEISPRAVAN_LOGIN) {
										echo "Neispravna kombinacija korisničkog imena i lozinke";
									}
									?>
										<input type="submit" value="Prijava" class="button expanded" />
										
								</div>
								
											
						
								
								
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once 'predlozak/podnozje.php';
		?>
		<?php
		include_once 'predlozak/skripte.php';
		?>
	</body>
</html>
