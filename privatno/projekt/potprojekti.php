<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
}

if (!isset($_GET["id"]) ){ 
	header("location:" . $putanjaAPP);
}else if (!isset($_POST["id"])){
	$izraz = $veza->prepare(
	"select * from potprojekt where id=:id");
	$izraz->execute($_GET);
	$entitet=$izraz->fetch(PDO::FETCH_OBJ);
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
					
				
						
							<div class="row">
									<div class="large-12 columns">
											<h1>POvaj projekt sadrži: <?php echo $entitet->potprojekt;  ?></h1>
									</div>
								</div>
    					
    			<?php 
    			
    			

				   	$izraz = $veza->prepare("select 
	a.id,
	a.naziv,
	b.id,
	b.naziv as potprojekt
	from potprojekt a left join projekt b on b.id=a.projekt; ");
						$izraz->execute();
						$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
						//d($rezultati);
						
						foreach ($rezultati as $red) :
							?>
							
					
							
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
		
	</body>
</html>
