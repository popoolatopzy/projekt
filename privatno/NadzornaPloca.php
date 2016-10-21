<?php 
include_once '../konfiguracija.php'; 
if(!isset($_SESSION[$sid . "operater"])){
header("location:" . $putanjaAPP);
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
			<?php
		include_once '../predlozak/head.php';
		?>
	</head>
	<body>
		<?php 
		include_once '../predlozak/izbornik.php'
		;?>

 

	<div class="row">
			<div class="large-12 columns">
				<div class="callout" >
		<div class="row">

<div clas="nadzorna" >
		<div class="large-6 columns" align: center;> 
			
				<?php if(isset($_SESSION[$sid . "operater"])): ?>
					<?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/projekt/Insert.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/projekt/Insert.php">
							<div class="large-12 columns end">
							<div class="callout2">
								<h4>Projekt</h4>
							</div>
						</div></a>
				<?php endif; ?>
			
    			

				<?php if(isset($_SESSION[$sid . "operater"])): ?>
					 <?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/potprojekt/Insert.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/potprojekt/Insert.php">
							<div class="large-12 columns end">
							<div class="callout2">
								<h4>Potprojekt</h4>
							</div>
						</div></a>	
				<?php endif; ?>
				

		<?php if(isset($_SESSION[$sid . "operater"])): ?>
					 <?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/kategorijapp/Insert.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/kategorijapp/Insert.php">
							<div class="large-12 columns end">
							<div class="callout2">
								<h4>Kategorija potprojekta</h4>
							</div>
						</div></a>	
				<?php endif; ?>
				
					
						<?php if(isset($_SESSION[$sid . "operater"])): ?>
					<?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/investitor/Insert.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/investitor/Insert.php">
							<div class="large-12 columns end">
							<div class="callout2">
								<h4>Investitor</h4>
							</div>
						</div></a>	
				<?php endif; ?>
						

						
						<?php if(isset($_SESSION[$sid . "operater"])): ?>
					 <?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/operater/Insert.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/operater/Insert.php">
							<div class="large-12 columns end">
							<div class="callout2">
								<h4>Operater</h4>
							</div>
						</div></a>	
				<?php endif; ?>
						
	
						
							</div>
							
	
							
							   
    	<div class="large-6 columns">
    		<div class="callout tijelo">
    			<div id="container" style="min-width: 410px; height: 410px; max-width: 600px; margin: 0 auto"></div>
    	
    	</div>
    </div>
 </div>
							
							
							
							
</div>
</div>
</div>


 
 
 
    <?php
		include_once '../predlozak/podnozje.php';
 ?>
 <?php
	include_once '../predlozak/skripte.php';
 ?>
 
 
 
 <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
   <script>
   	$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Projekti'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Projekt',
            colorByPoint: true,
            data: [
            <?php 
            
            $izraz = $veza->query("select a.kategorija_pp, count(b.kategorija_pp) as ukupno 
from kategorija_pp a 
left join potprojekt b on a.id=b.kategorija_pp
group by b.kategorija_pp;");
		$izraz->execute();
		$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
		//d($rezultati);
		
		foreach ($rezultati as $red):
            
            ?>
            {
               name: '<?php echo $red->kategorija_pp; ?>',
                y: <?php echo $red->ukupno; ?>
            }, 
            <?php endforeach; ?>
            
            ]
        }]
    });
});
   	
   </script>
</div>
	</body>

</html>
