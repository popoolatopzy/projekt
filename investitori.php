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
  		<div class="callout" id="visina">
    			     			
    	<div class="row">
    		<div class="large-12 columns">
    			
    			<fieldset class="fieldset">
    			<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    				<label for="uvjet"><h5 class="napredno">Pretražite investitore</h5></label>
    				<input type="text" id="uvjet" name="uvjet" value="<?php echo (isset($_POST["uvjet"]) ? $_POST["uvjet"] : "") ?>"/>
    				
    				<input class="button"  style="width: 100%;"  type="submit" value="Traži" />
    			</form>
    			</div>
    		</div>
    		
    			<table class="hover" >
    				<thead>
    					<tr>
    						<th>Naziv</th>
    						<th>OIB</th>
    						<th>Adresa </th>
    						
    					</tr>
    				</thead>
    				<tbody>
    					
    				
    			<?php 
				$izraz = $veza->prepare("select count(*) from investitor");
				$izraz->execute();
				$ukupno=$izraz->fetchColumn();
    			
				$rezultata=5;
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
    		
				   	$izraz = $veza->prepare("select * from investitor where naziv like :uvjet order by naziv " . 
					" limit " . ($stranica*$rezultata-$rezultata) . "," . $rezultata);
						$izraz->execute(array("uvjet" => $uvjet));
						$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
						//d($rezultati);
						
						foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red -> naziv; ?></td>
								<td><?php echo $red -> oib; ?></td>
								<td><?php echo $red -> adresa; ?></td>
								
								
								
								
							</tr>
							
							<?php
							endforeach;
				?>
				</tbody>
    			</table>
  
    				<ul class="pagination center" role="navigation" aria-label="Pagination">
    				<li><a href="investitori.php?stranica=1">Prva </a></li>
				  <li><a href="investitori.php?stranica=<?php echo $stranica-1; ?>">Prethodno </a></li>
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
						<li><a href="investitori.php?stranica=<?php echo $i; ?>" aria-label="Stranica <?php echo $i ?>"><?php echo $i ?></a></li>
						
						<?php
						endif;
				  		?>
				  
	
				  <?php endfor;?>
				  <li><a href="#" aria-label="Sljedeća stranica"><a href="investitori.php?stranica=<?php echo $stranica+1; ?>">Sljedeće</a> <span class="show-for-sr">page</span></a></li>
				  <li><a href="investitori.php?stranica=<?php echo $us; ?>">Zadnja </a></li>
				</ul>			
    		</div>
    	</div>
  
   	
  
    
<?php
include_once 'predlozak/podnozje.php';
 ?>
 <?php
include_once 'predlozak/skripte.php';
 ?>
 </div>
 
  </body>
</html>
