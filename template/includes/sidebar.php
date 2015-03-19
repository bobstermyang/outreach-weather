<div class="col s12 m12 l2" style="float:right;">
	<?php 

	include 'widgets/latest.php';
	include 'widgets/top.php';
	
	if($_GET['page'] == 'index') include 'widgets/temperature_type.php';

	if(!empty($settings->side_ads)) echo $settings->side_ads;

	?>
</div>