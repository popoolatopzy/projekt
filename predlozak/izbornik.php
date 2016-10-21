<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
	<button class="menu-icon" type="button" data-toggle></button>
	<div class="title-bar-title">
		Izbornik
	</div>
</div>


<div class="top-bar-container" id="example-menu" data-sticky-container>
	<div class="sticky" data-sticky data-options="anchor: page; marginTop: 0; stickyOn: small;">
	<div class="top-bar-left stacked-for-medium"" >
		<!-- <ul class="dropdown menu" data-dropdown-menu > -->
			<ul class="dropdown vertical medium-horizontal menu" data-dropdown-menu>
					<li <?php

					//print_r($_SERVER);
					// echo $_SERVER["PHP_SELF"];
					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "index.php") {
						echo "class=\"active\"";
					}
					?>>
			
			<li class="menu-text" style="padding: 0; margin:10px 5px" >
			
				<a href="<?php echo $putanjaAPP; ?>index.php">
							<img src="<?php echo $putanjaAPP; ?>img/lo1.png" alt="projektni ured - logo" /></a>
			</li>
			
			
			
			<li>
				<a href="<?php echo $putanjaAPP; ?>index.php">Početna</a>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>projekti.php">Projekti</a>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>investitori.php">Investitori</a>
			</li>
		
			<li>
				<a href="<?php echo $putanjaAPP; ?>era.php">ERA</a>
			</li>
			

				<?php if(isset($_SESSION[$sid . "operater"])): ?>
					
					<li <?php

					if ($_SERVER["PHP_SELF"] == $putanjaAPP . "privatno/NadzornaPloca.php") {
						echo "class=\"active\"";
					}
					?>>
						<a href="<?php echo $putanjaAPP; ?>privatno/NadzornaPloca.php">Nadzorna ploča</a>
					
					</li>	
				
				<?php endif; ?>
				
				
		
		</ul>
	</div>


		<div class="top-bar-right">
			
			
		
			<?php if(isset($_SESSION[$sid . "operater"])):
			?>
			<a class="button" style="margin: 25px 35px" href="<?php echo $putanjaAPP; ?>odjava.php">Odjavi <?php echo $_SESSION[$sid . "operater"] -> ime . " " . $_SESSION[$sid . "operater"] -> prezime; ?></a>
			<?php else: ?>
			<a class="button" style="margin: 25px 35px" href="<?php echo $putanjaAPP; ?>autorizacija.php">Prijava</a>

			<?php endif; ?>
			
			
		</div>
		
				
		</div>
</div>

