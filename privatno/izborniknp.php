<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
			
	</head>
	<body>
		

 

	<div class="row">
			<div class="large-12 columns">


			
					<?php if(isset($_SESSION[$sid . "operater"])): ?>
					<?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/Nadzornaploca.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/Nadzornaploca.php">
							<div class="large-2 columns end" id="izborniknp">
								<p>Nadzorna</p>
						</div></a>
				<?php endif; ?>
				
			
				<?php if(isset($_SESSION[$sid . "operater"])): ?>
					<?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/projekt/index.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/projekt/index.php">
							<div class="large-2 columns end" id="izborniknp">
								<p>Projekt</p>
						</div></a>
				<?php endif; ?>
			
    			

				<?php if(isset($_SESSION[$sid . "operater"])): ?>
					 <?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/potprojekt/index.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/potprojekt/index.php">
							<div class="large-2 columns end" id="izborniknp">
						
								<p>Potprojekt</p>
							
						</div></a>	
				<?php endif; ?>
				

		<?php if(isset($_SESSION[$sid . "operater"])): ?>
					 <?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/kategorijapp/index.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/kategorijapp/index.php">
							<div class="large-2 columns end" id="izborniknp">
							
								<p>Kategorija</p>
							
						</div></a>	
				<?php endif; ?>
				
					
						<?php if(isset($_SESSION[$sid . "operater"])): ?>
					<?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/investitor/index.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/investitor/index.php">
							<div class="large-2 columns end" id="izborniknp">
							
								<p>Investitor</p>
							
						</div></a>	
				<?php endif; ?>
						

						
						<?php if(isset($_SESSION[$sid . "operater"])): ?>
					 <?php
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/operater/index.php") {
						echo "class=\"active\"";
					}
					?>
						<a href="<?php echo $putanjaAPP; ?>privatno/operater/index.php">
							<div class="large-2 columns end" id="izborniknp">
							
								<p>Operater</p>
							
						</div></a>	
				<?php endif; ?>
						
	
						
							</div>
							
	
							
							   
    	
 		
 




 

 
 
</div>
	</body>

</html>
