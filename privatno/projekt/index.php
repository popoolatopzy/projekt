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

		<div class="row">
			<div class="large-12 columns">
				<div class="callout tijelo">
					<a href="Insert.php" class="button siroko">Novi projekt</a>
						
			
					<div class="row">	
						<div class="large-12 columns">
						<fieldset class="fieldset" >
						<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    					<label for="uvjet"><h5 class="napredno">Pretražite projekte</h5></label>
    					<input type="text" id="uvjet" name="uvjet" value="<?php echo (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") ?>"/>
    					<input class="button" id="del" style="width: 100%;"  type="submit" value="Traži" />
    					</form>
    					</div>
    					</fieldset>
    					</div>
    		
				
				
					<div class="row">

						
						<?php
				$izraz = $veza->prepare("select count(*) from projekt");
				$izraz->execute();
				$ukupno=$izraz->fetchColumn();
    			
				$rezultata=20;
				$stranica=1;
				
				if(isset($_GET["stranica"])){
					$stranica=$_GET["stranica"];
				}
			
				if($stranica>$ukupno/$rezultata){
					$stranica=$ukupno/$rezultata;
				}
				
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
a.oznaka_projekta, 
a.broj_katastarske_cestice,
a.tip_gradevine,
a.lokacija,
a.glavni_projektant,
a.datum_p,
a.datum_k,
a.iznos_p,
a.iznos_z,
a.opis,
d.naziv as potprojekt,
concat(b.prezime, ' ', b.ime) as operater
from projekt a inner join operater b on a.operater=b.id
left join stavka c on a.id=c.projekt
left join potprojekt d on a.id=d.projekt
where a.naziv like :uvjet
group by a.id, a.naziv,a.oznaka_projekta, a.broj_katastarske_cestice, a.tip_gradevine,
a.lokacija, a.glavni_projektant, a.datum_p, a.datum_k, a.iznos_p, a.iznos_z, a.opis, b.id, d.naziv" .
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
						
                   	  <li><strong>Oznaka projekta: </strong><?php echo $red -> oznaka_projekta; ?></li>
                	  <li><strong>Katastarska čestica: </strong> <?php echo $red -> broj_katastarske_cestice; ?></li>
                      <li><strong>Tip građevine: </strong><?php echo $red -> tip_gradevine; ?></li>
                      <li><strong>Lokacija: </strong><?php echo $red -> lokacija; ?></li>
                         <li><strong>Glavni projektant: </strong><?php echo $red -> glavni_projektant; ?></li>
                    
                    </ul>
                    </div>	
                    <div class="large-4 small-12 medium-6 columns">
                    	
                    	<li><strong>Datum početka: </strong> <?php if($red->datum_p!=null){echo date("d. m. Y.",strtotime($red->datum_p));}?></li>
                      <li><strong>Datum završetka: </strong> <?php if($red->datum_k!=null){echo date("d. m. Y.",strtotime($red->datum_k));}?></li>
                      <li><strong>Predviđeni iznos: </strong><?php echo $red -> iznos_p; ?> kn</li>
                      <li><strong>Završni iznos: </strong><?php echo $red -> iznos_z; ?> kn</li>
                      <li><strong>Unio: </strong><?php echo $red -> operater; ?></li>
                    	
								
                    	
                    	
                    	
                    	
                    	</div>
                    	
                    	 <div class="large-4 columns">
                    	 	
                    	 	<div class="large-6 columns">
                    	 		
										<a class="secondary button " href="Update.php?id=<?php  echo $red->id?>">Promjeni</a>
									</div>
									<div class="large-6 columns">
										<?php 
										if($red->id==0):
										?>
										<a class=" button" href="Delete.php?id=<?php  echo $red->id ?>">obriši</a>
										<?php endif;  ?>
									</div>
                    	 	
                    	</div>
                    	 <div class="large-12 columns">
                    	 	
						<p><div class="comment more"><strong>Opis:</strong><?php echo $red -> opis; ?></p> 		
								
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
