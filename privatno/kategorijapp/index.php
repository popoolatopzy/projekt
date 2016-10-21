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
					<div class="row">
					
						
						
						<div class="large-9 columns" center>
	
	<fieldset class="fieldset">
    			<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    				<label for="uvjet"><h5 class="napredno">Pretražite kategorije</h5></label>
    				<input type="text" id="uvjet" name="uvjet" value="<?php echo (isset($_POST["uvjet"]) ? $_POST["uvjet"] : "") ?>"/>
    				
    				<input class="button"  id="del" style="width: 100%;"  type="submit" value="Traži" />
    			</form>
			</fieldset>

						<table class="hover" >
    				<thead>
    					<tr>
    						<div class="large-7 columns">
    						<th>Kategorija potprojekta</th>
    						</div>
    						<div class="large-5 columns">
    						<th></th>
    						</div>
    					</tr>
    				</thead>
    				<tbody>
						
							<?php
							
							
				$izraz = $veza->prepare("select count(*) from kategorija_pp");
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

$izraz = $veza->prepare("select a.id, a.kategorija_pp, count(b.kategorija_pp) as dodijeljen 
from kategorija_pp a left join potprojekt b on a.id=b.kategorija_pp 
where a.kategorija_pp like :uvjet
group by a.id, a.kategorija_pp order by kategorija_pp " . 
" limit " . ($stranica*$rezultata-$rezultata) . "," . $rezultata);
$izraz->execute(array("uvjet" => $uvjet));
$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
//d($rezultati);



$izraz->execute();
$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
$rb=0;
foreach ($rezultati as $red) :


						?>
						
						
						<tr>
								<td><?php echo $red -> kategorija_pp; ?></td>
							
								<td><a class="tiny button" href="Update.php?id=<?php  echo $red->id ?>">promjeni</a> | 
									<?php if($red->dodijeljen==0): ?>
									<a class="tiny button" id="del" href="Delete.php?id=<?php  echo $red->id ?>">obriši</a></td>
									<?php endif; ?>
								
							
							</tr>
							
							<?php
							endforeach;
							?>
						
				
				</tbody>
    			</table>
    			
    			
    			<ul class="pagination center" role="navigation" aria-label="Pagination">
    			<li><a href="index.php?stranica=1">Prva </a></li>
				  <li><a href="index.php?stranica=<?php echo $stranica-1; ?>">Prethodno </a></li>
				  <?php 
				  $us=ceil ($ukupno/$rezultata);
				  for($i=1;$i<=$us;$i++):
				  	
					 if($i+2<$stranica || $i-2>$stranica){
					 	continue;
					 }
				  	
				  	if($i==$stranica):
						?>
						<li class="current"><span class="show-for-sr">Vi ste na</span> <?php echo $i ?></li>
						
						<?php
					else:
						?>
						<li><a href="index.php?stranica=<?php echo $i; ?>" aria-label="Stranica <?php echo $i ?>"><?php echo $i ?></a></li>
						
						<?php
						endif;
				  		?>
				  
	
				  <?php endfor;?>
				  <li><a href="#" aria-label="Sljedeća stranica"><a href="index.php?stranica=<?php echo $stranica+1; ?>">Sljedeće</a> <span class="show-for-sr">page</span></a></li>
				  <li><a href="index.php?stranica=<?php echo $us; ?>">Zadnja </a></li>
				</ul>	
				 
    			
								
							</div>
							
				<div class="large-3 columns">
					<a href="Insert.php" class="button siroko">Nova kategorija</a>
					</div>
    					
							
						
						
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
