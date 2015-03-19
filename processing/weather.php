<?php
include '../core/init.php';

/* Define some needed variables */
if(isset($_POST['latitude'], $_POST['longitude'])) {

 	$location = get_city($_POST['latitude'], $_POST['longitude']);

	if(!$location) $location = $settings->default_location;

} else 

if(isset($_POST['location'])) {

	$location = $_POST['location'];

} else {

	$location = $settings->default_location;

}

$degree_type = (isset($_COOKIE['degree_type'])) ? $_COOKIE['degree_type'] : $settings->degree_type;

/* Get the weather data */
$weather = get_weather_data($location, $settings->culture, $degree_type);


/* Update the searches table */
if(User::x_exists('location', $weather['location_name'], 'searches') && isset($_POST['location'])) 
	$database->query("UPDATE `searches` SET `hits` = `hits` + 1 WHERE `location` = '{$weather['location_name']}'");
elseif(!User::x_exists('location', $weather['location_name'], 'searches') && isset($_POST['location']))
	$database->query("INSERT INTO `searches` (`location`, `hits`) VALUES ('{$weather['location_name']}', 1)");

?>
<div id="location" style="display: none;"><?php echo $weather['location_name']; ?></div>

<div class="card teal lighten-1">
	<div class="card-content white-text">

		<div class="row no-margin">

			<div class="col s12 m6 l6">

				<div class="row no-margin">
					<div class="col s12 m3 l3">
						<span class="weather-temperature"><?php echo $weather['current_data']['temperature'] . '&deg;'; ?></span>
					</div>
					<div class="col s12 m9 l9" style="padding-left: 35px;">
						<span class="card-title"><?php printf($language->home->header, $weather['location_name']); ?></span>
						<p><?php echo $weather['day0_data']['sky_text']; ?></p>
						<p class="tooltipped" data-tooltip="<?php echo $language->home->tooltip->humidity; ?>"><i class="tiny mdi-social-whatshot"></i> <?php echo $weather['current_data']['humidity']; ?></p>
						<p class="tooltipped" data-tooltip="<?php echo $language->home->tooltip->wind; ?>"><i class="tiny mdi-content-reply-all"></i> <?php echo $weather['current_data']['wind']; ?></p>
					</div>
				</div>

			</div>

			<div class="col s12 m6 l6 center-align hide-on-med-and-down">
				<p><?php echo $weather['day0_data']['date']; ?></p>
				<span class="card-title white-text"><?php echo $weather['day0_data']['day']; ?></span>
				<p><?php echo $weather['day0_data']['sky_text']; ?></p>
				<p class="tooltipped" data-tooltip="<?php echo $language->home->tooltip->rain_chance; ?>"><i class="tiny mdi-social-whatshot"></i><?php echo $weather['day0_data']['rain_chance']; ?>%</p>
			</div>

		</div>

	</div>
</div>

<div class="row">

	<?php for($i = 1; $i <= 4; $i++) { ?>
	<div class="col s12 m12 l3">
		<div class="card">
	
			<div class="card-content center-align">
				<p><?php echo $weather['day' . $i . '_data']['date']; ?></p>
				<span class="card-title grey-text text-darken-2"><?php echo $weather['day' . $i . '_data']['day']; ?></span>
				<p><img src="template/images/weather/<?php echo $weather['day' . $i . '_data']['sky_code'] . '.png'; ?>" /></p>
				<p><?php echo $weather['day' . $i . '_data']['sky_text']; ?></p>
				<p class="tooltipped" data-tooltip="<?php echo $language->home->tooltip->rain_chance; ?>"><i class="tiny mdi-social-whatshot"></i><?php echo $weather['day' . $i . '_data']['rain_chance']; ?>%</p>
			</div>

			<div class="card-action center-align" style="font-size: 22px;">
				<span class="tooltipped" data-tooltip="<?php echo $language->home->tooltip->minimum_temperature; ?>"><?php echo $weather['day' . $i . '_data']['min_temp']; ?>&deg; </span>
				/ 
				<span class="tooltipped" data-tooltip="<?php echo $language->home->tooltip->maximum_temperature; ?>"><?php echo $weather['day' . $i . '_data']['max_temp']; ?>&deg; </span>
			</div>

		</div>
	</div>
	<?php } ?>


</div>

<script>
/* Enable tooltips */
$('.tooltipped').tooltip({delay: 50});
</script>