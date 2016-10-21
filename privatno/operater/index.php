<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location: ../index.php");
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
					<a href="Insert.php" class="button siroko">Novi</a>
					
					<div class="row">	
						<div class="large-12 columns">
						<fieldset class="fieldset" >
						<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    					<label for="uvjet"><h5 class="napredno">Pretražite operatere</h5></label>
    					<input type="text" placeholder="upišite prezime operatera" id="uvjet" name="uvjet" value="<?php echo (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") ?>"/>
    					<input class="button" id="del" style="width: 100%;"  type="submit" value="Traži" />
    					</form>
    					</div>
    					</fieldset>
    					</div>
					<div class="row">

				<?php
				
				$izraz = $veza->prepare("select count(*) from operater");
				$izraz->execute();
				$ukupno=$izraz->fetchColumn();
    			
				$rezultata=10;
				$stranica=1;
				
				if(isset($_GET["stranica"])){
					$stranica=$_GET["stranica"];
				}
				//zadnja
				if($stranica>$ukupno/$rezultata){
					$stranica=$ukupno/$rezultata;
				}
				//prva
				if($stranica<1){
					$stranica=1;
				}
				
    				$uvjet="%";
					if($_POST){
						$uvjet="%" . $_POST["uvjet"] . "%";
					}
							
				$izraz = $veza->prepare("select a.id, a.username, a.password, a.email, a.ime, a.prezime, 
				a.prvilogin, a.zadnjilogin, count(b.operater) as dodijeljen 
				from operater a left join projekt b on a.id=b.operater 
				where a.prezime like :uvjet
				group by a.id, a.username, a.password, a.email, a.ime, a.prezime, a.prvilogin, a.zadnjilogin 
				order by prezime " . " limit " . ($stranica*$rezultata-$rezultata) . "," . $rezultata);
				$izraz->execute(array("uvjet" => $uvjet));
				$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
				
				
$izraz->execute();
$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
$rb=0;
foreach ($rezultati as $red) :
					$rb++;
				?>

						<div class="large-3 columns end">
							<div class="callout korisnik1">
								<h3><?php echo $red -> ime . " " . $red -> prezime ?></h3>
								<h6><?php echo $red -> email ?></h6>
								<p>Korisničko ime: <?php echo $red -> username ?> </p>
												
						<div class="row">
							
							<div class="large-6 columns">
										<a class="tiny button" href="Update.php?id=<?php  echo $red->id?>">promjeni</a>
									</div>
								
									<div  class="large-6 columns">
										<?php 
										if($red->dodijeljen==0):
										?>
										<a class="tiny button" id="del" href="Delete.php?id=<?php  echo $red->id ?>">obriši</a>
										<?php endif; ?>
									</div>
									
									
										
								</div>
						</div>
						</div>
								

						<?php
						endforeach;
						?>
						
					
						
					</div>
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
