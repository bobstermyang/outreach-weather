<?php 
include 'core/init.php';

echo "<pre>";
if(!empty($_GET['location']) == true && !empty($_GET['degree']) == true){
	$data = get_weather_data($_GET['location'], "en-US", $_GET['degree']);
	if($data == false){
		echo '{"location_name":"false"}';
	} else {
		unset($data['CurrentData']['skyCode']);
		print_r(json_encode(array_splice($data, 0, -5)));
	}
}
echo "</pre>";

?>