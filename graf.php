<?php include_once 'konfiguracija.php'; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once 'predlozak/head.php'; ?>
	</head>
	<body>
		<?php include_once 'predlozak/izbornik.php';?>
     <div class="row">
    	<div class="large-12 columns">
    		<div class="callout tijelo" id="pad">
    			<div id="container" style="min-width: 210px; height: 310px; max-width: 600px; margin: 0 auto"></div>
    		</div>
    	</div>
    </div>
 <?php include_once 'predlozak/skripte.php'; ?> 
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
	</body>
</html>






