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
				<div class="callout">

					<div class="row">
						<div class="large-8 columns">
							<a href="<?php echo $putanjaAPP; ?>index.php">
							<img src="<?php echo $putanjaAPP; ?>img/logo.png" alt="projektni ured - logo" /></a>
						</div>
						
					
						<hr/>
						
					
						
						<a href="projekti.php">
						<div class="large-4 columns end">
							<div class="callout1">
								<i class="fi-page-edit"></i>
								<h4>Projekti</h4>
							</div>
						</div></a>
						
						<a href="investitori.php">
						<div class="large-4 columns end">
							<div class="callout1">
								<i class="fi-torsos-all"></i>
								<h4>Investitori</h4>
							</div>
						</div></a>
						
						<a href="noviUnos.php">
						<div class="large-4 columns end">
							<div class="callout1">
								<i class="fi-save"></i>
								<h4>Pohranjivanje</h4>
							</div>
						</div></a>

						<hr/>
				<div class="large-12 columns">
				
					
							<div class="large-6 columns" ">
								<p>

									<?php
									include_once 'graf.php';
									?>
								</p>
							</div>
						<div class="large-6 columns">
								<p>
									<h4>Posljednje dodano</h4>
									<hr />
	
									<a href=""class="view">Obnova VG-272</a>, GKO-27797, poslovna zgrada, Tin Barić
									<br />
									<a href="" class="view">Nadogradnja VG-576</a>, ZGO-35797, stambena zgrada, Filip Tadić
									<br />
									<a href="" class="view">Rekonstrukcija VG-276</a>, ZGO-35797, poslovna zgrada, Stjepan Kožul
									<br />
									<a href="" class="view">Parcelacija zemljišta VG-876</a>, ZGO-35797, stambena zgrada, Tea Raguž
									<br />
									<a href="" class="view">Nadogradnja VG-776</a>, ZGO-35797, poslovna zgrada, Stjepan Raguž
									<br />
									<a href="" class="view">Projekt instalacije VG-586</a>, ZGO-35797, stambena zgrada, Ivan Bilić
									<br />
									<a href="" class="view">Obnova VG-976</a>, ZGO-35797, poslovna zgrada, Stjepan Gik
									<br />
									<a href="" class="view">Nadogradnja VG-476</a>, ZGO-35797, stambena zgrada, Ante Raguž
									<br />
									<a href="" class="view">Rekonstrukcija VG-276</a>, ZGO-35797, poslovnazgrada, Marko Jukić
									<br />
									<a href="" class="view">Nadogradnja VG-176</a>, ZGO-35797, stambena zgrada, Stjepan Galić
									<br />
									<a href="" class="view">Rekonstrukcija VG-176</a>, ZGO-35797, stambena zgrada, Stjepan Babić
									<br />

									<br />
								</p>
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
			?><script>
			$('#content').height($(window).height() - $('#header').height());</script>
	</div>
	</body>
</html>
