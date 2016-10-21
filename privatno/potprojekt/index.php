<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "operater"])) {
	header("location:" . $putanjaAPP);
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
					<a href="Insert.php" class="button siroko">Novi potprojekt</a>
					
				
				
			<!-- trazilica2 -->
					<div class="row">	
						<div class="large-12 columns">
						<fieldset class="fieldset" >
						<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    					<label for="uvjet"><h5 class="napredno">Pretražite potprojekte</h5></label>
    					<input type="text" id="uvjet" name="uvjet" value="<?php echo (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") ?>"/>
    					<input class="button" id="del" style="width: 100%;"  type="submit" value="Traži" />
    					</form>
    					</div>
    					</fieldset>
    					</div>
    				
				
					<!-- izvan petlje -->
					<div class="row">
			
						
						<?php		
				$izraz = $veza->prepare("select count(*) from potprojekt");
				$izraz->execute();
				$ukupno=$izraz->fetchColumn();
    			
				$rezultata=20;
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
						
$izraz = $veza->prepare("select 
	a.id,
	a.naziv, 
	a.broj_potprojekta,
	a.datum_p,
	a.datum_k,
	a.sporedni_projektant,
	a.opis,
	b.naziv as projekt,
	c.kategorija_pp as kategorija_pp,
	count(b.id) as dodijeljen
	from potprojekt a left join projekt b on a.projekt=b.id 
	inner join kategorija_pp c on a.kategorija_pp=c.id
	where a.naziv like :uvjet
	group by a.id,a.naziv, a.broj_potprojekta,a.datum_p,a.datum_k,a.sporedni_projektant,a.opis, b.id, c.kategorija_pp
	order by naziv " .
" limit " . ($stranica*$rezultata-$rezultata) . "," . $rezultata);
$izraz->execute(array("uvjet" => $uvjet));
$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
	
$izraz->execute();
$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
$rb=0;
foreach ($rezultati as $red) :
						?>
					

					
		
						<div class="large-12 columns end">
							
							<div class="callout">
							<div class="preko">
								<div class="row">
										
								<h3 class="naslovp"><?php echo $red -> naziv ?> </h3>
							<div class="large-4 small-12 medium-6 columns">
					<ul>
                   	  <li><strong>Kategorija: </strong><?php echo $red -> kategorija_pp; ?></li>
                	  <li><strong>Broj potprojekta:</strong> <?php echo $red -> broj_potprojekta; ?></stron></li>
                      <li><strong>Sporedni projektant: </strong><?php echo $red -> sporedni_projektant; ?></li>
                     
                            
                    </ul>
                    </div>	
                    <div class="large-4 small-12 medium-6 columns">
                    	 <li><strong>Nadređeni projekt:</strong><?php echo $red -> projekt; ?></li>
                    	<li><strong>Datum početka:</strong> <?php if($red->datum_p!=null){echo date("d. m. Y.",strtotime($red->datum_p));}?></li>
                      <li><strong>Datum završetka:</strong> <?php if($red->datum_k!=null){echo date("d. m. Y.",strtotime($red->datum_k));}?></li>
                      
                    	</div>
                    	
                    	 <div class="large-4 columns">
                    	 	<div class="large-6 columns">
										<a class="secondary button " href="Update.php?id=<?php  echo $red->id?>">Promjeni</a>
									</div>
									<div class="large-6 columns">
										<?php 
										if($red->dodijeljen==0):
										?>
										<a class=" button" href="Delete.php?id=<?php  echo $red->id ?>">obriši</a>
										<?php endif;  ?>
									</div>
                    	 	
                    	</div>
                    	 <div class="large-12 columns">
						<p><strong>Opis:</strong><div class="comment more"><?php echo $red -> opis; ?></p> 		
								</div>
								</div>
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
		
		
			<script> 

    // http://jsfiddle.net/X5r8r/1156/
   
  $(document).ready(function() {
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "Prikaži više...";
	var lesstext = "Prikaži manje...";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});
		
		</script>
		
		</div>
	</body>
</html>
