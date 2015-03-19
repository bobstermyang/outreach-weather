<?php

function get_weather_data($location, $culture, $degreeType) {

	header("Content-Type: text/html;charset=utf-8");
	$xml = simplexml_load_file('http://weather.service.msn.com/data.aspx?weadegreetype='.$degreeType.'&culture='.$culture.'&weasearchstr='.$location.'&src=outlook');

	if((string)$xml->weather[0]['weatherlocationname'] == false){
		return false;
	}

	$data = array(
				"location_name" => (string)$xml->weather[0]['weatherlocationname'],
				"current_data"  => array(
									"temperature" => (string)$xml->weather[0]->current['temperature'],
									"sky_code"	  => (string)$xml->weather[0]->current['skycode'],
									"sky_text"	  => (string)$xml->weather[0]->current['skytext'],
									"humidity"	  => (string)$xml->weather[0]->current['humidity'],
									"wind"		  => (string)$xml->weather[0]->current['winddisplay']
								  ),
				"day0_data"  => array(
									"day" => (string)$xml->weather[0]->forecast[-1]['day'],
									"sky_code"	  => (string)$xml->weather[0]->forecast[0]['skycodeday'],
									"sky_text"	  => (string)$xml->weather[0]->forecast[0]['skytextday'],
									"min_temp"	  => (string)$xml->weather[0]->forecast[0]['low'],
									"max_temp"	  => (string)$xml->weather[0]->forecast[0]['high'],
									"date"		  => (string)$xml->weather[0]->forecast[0]['date'],
									"rain_chance" => (string)$xml->weather[0]->forecast[0]['precip']
								  ),
				"day1_data"  => array(
									"day" => (string)$xml->weather[0]->forecast[1]['day'],
									"sky_code"	  => (string)$xml->weather[0]->forecast[1]['skycodeday'],
									"sky_text"	  => (string)$xml->weather[0]->forecast[1]['skytextday'],
									"min_temp"	  => (string)$xml->weather[0]->forecast[1]['low'],
									"max_temp"	  => (string)$xml->weather[0]->forecast[1]['high'],
									"date"		  => (string)$xml->weather[0]->forecast[1]['date'],
									"rain_chance" => (string)$xml->weather[0]->forecast[1]['precip']
								  ),
				"day2_data"  => array(
									"day" => (string)$xml->weather[0]->forecast[2]['day'],
									"sky_code"	  => (string)$xml->weather[0]->forecast[2]['skycodeday'],
									"sky_text"	  => (string)$xml->weather[0]->forecast[2]['skytextday'],
									"min_temp"	  => (string)$xml->weather[0]->forecast[2]['low'],
									"max_temp"	  => (string)$xml->weather[0]->forecast[2]['high'],
									"date"		  => (string)$xml->weather[0]->forecast[2]['date'],
									"rain_chance" => (string)$xml->weather[0]->forecast[2]['precip']
								  ),
				"day3_data"  => array(
									"day" => (string)$xml->weather[0]->forecast[3]['day'],
									"sky_code"	  => (string)$xml->weather[0]->forecast[3]['skycodeday'],
									"sky_text"	  => (string)$xml->weather[0]->forecast[3]['skytextday'],
									"min_temp"	  => (string)$xml->weather[0]->forecast[3]['low'],
									"max_temp"	  => (string)$xml->weather[0]->forecast[3]['high'],
									"date"		  => (string)$xml->weather[0]->forecast[3]['date'],
									"rain_chance" => (string)$xml->weather[0]->forecast[3]['precip']
								  ),
				"day4_data"  => array(
									"day" => (string)$xml->weather[0]->forecast[4]['day'],
									"sky_code"	  => (string)$xml->weather[0]->forecast[4]['skycodeday'],
									"sky_text"	  => (string)$xml->weather[0]->forecast[4]['skytextday'],
									"min_temp"	  => (string)$xml->weather[0]->forecast[4]['low'],
									"max_temp"	  => (string)$xml->weather[0]->forecast[4]['high'],
									"date"		  => (string)$xml->weather[0]->forecast[4]['date'],
									"rain_chance" => (string)$xml->weather[0]->forecast[4]['precip']
								  ),
			);

	return $data;
}

function get_city($lat,$long) {

	header("Content-Type: text/html;charset=utf-8");

	$file  = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "," . $long . "&sensor=true");
	$data  = json_decode($file);
	$data = $data->results[0]->address_components;

	$i=0;
	while($i <= 6){
		$type = @$data[$i]->types;
		if(@in_array('locality', $type)){ $locality = $i; }
		if(@in_array('country', $type)){ $country = $i; }
		$i++;
	}

	return $data[$locality]->long_name . ', ' . $data[$country]->long_name;
}


function bind_object($stmt, &$row) {
	$row = new StdClass;
	$md = $stmt->result_metadata();

	$params = array();
	while($field = $md->fetch_field()) {
		$params[] = &$row->{$field->name};
	}

	call_user_func_array(array($stmt, 'bind_result'), $params);

	$stmt->fetch();

	if($row->{key($row)} == '' || $row->{key($row)} == '0') $row = null;
}

function trim_value(&$value) {
	$value = trim($value);
}

function filter_banned_words($value) {
	global $settings;

	$words = explode(',', $settings->banned_words);
	array_walk($words, 'trim_value');

	foreach($words as $word) {
		$value = str_replace($word, str_repeat('*', strlen($word)), $value);
	}

	return $value;
}

function country_check($type, $value) {
	// Type 0: Verify whether the country exists or not
	// Type 1: Return the country list
	// Type 2: Key to Value
	$list = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AG" => "Antigua and Barbuda", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "AX" => "Åland Islands", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosnia and Herzegovina", "BW" => "Botswana", "BV" => "Bouvet Island", "BR" => "Brazil", "BQ" => "British Antarctic Territory", "IO" => "British Indian Ocean Territory", "VG" => "British Virgin Islands", "BN" => "Brunei", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "Cape Verde", "KY" => "Cayman Islands", "CF" => "Central African Republic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "Christmas Island", "CC" => "Cocos [Keeling] Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo - Brazzaville", "CD" => "Congo - Kinshasa", "CK" => "Cook Islands", "CR" => "Costa Rica", "HR" => "Croatia", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "CI" => "Côte d’Ivoire", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "El Salvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands", "FO" => "Faroe Islands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern Territories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heard Island and McDonald Islands", "HN" => "Honduras", "HK" => "Hong Kong SAR China", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "Laos", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau SAR China", "MK" => "Macedonia", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia", "MD" => "Moldova", "MC" => "Monaco", "MN" => "Mongolia", "ME" => "Montenegro", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar [Burma]", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NC" => "New Caledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "KP" => "North Korea", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PS" => "Palestinian Territories", "PA" => "Panama", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn Islands", "PL" => "Poland", "PT" => "Portugal", "PR" => "Puerto Rico", "QA" => "Qatar", "RO" => "Romania", "RU" => "Russia", "RW" => "Rwanda", "RE" => "R?ion", "SH" => "Saint Helena", "KN" => "Saint Kitts and Nevis", "LC" => "Saint Lucia", "PM" => "Saint Pierre and Miquelon", "VC" => "Saint Vincent and the Grenadines", "WS" => "Samoa", "SM" => "San Marino", "SA" => "Saudi Arabia", "SN" => "Senegal", "RS" => "Serbia", "CS" => "Serbia and Montenegro", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgia and the South Sandwich Islands", "KR" => "South Korea", "ES" => "Spain", "LK" => "Sri Lanka", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbard and Jan Mayen", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syria", "ST" => "S?Tom?nd Pr?ipe", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania", "TH" => "Thailand", "TL" => "Timor-Leste", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "Trinidad and Tobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turks and Caicos Islands", "TV" => "Tuvalu", "UM" => "U.S. Minor Outlying Islands", "VI" => "U.S. Virgin Islands", "UG" => "Uganda", "UA" => "Ukraine", "SU" => "Union of Soviet Socialist Republics", "AE" => "United Arab Emirates", "GB" => "United Kingdom", "US" => "United States", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VA" => "Vatican City", "VE" => "Venezuela", "VN" => "Vietnam", "WF" => "Wallis and Futuna", "EH" => "Western Sahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");

	if($type == 1) {

		foreach($list as $code => $name) {
			if($code == $value) {
				$selected = ' selected="selected"';
			} else {
				$selected = '';
			}
			echo '<option value="'.$code.'"'.$selected.'>'.$name.'</option>';
		}

	} elseif($type == 0) {

		return (array_key_exists($value, $list));

	} else {

		return $list[$value];

	}
}

function youtube_convert($id, $width = 400, $height = 250) {

	$output = '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>';

	return $output;

}

function youtube_url_to_id($url) {

	$output = preg_replace(
		"/(http:\/\/|https:\/\/)?(www.)?(youtube.com){1}(\/watch\?v=){1}([a-zA-Z0-9\-_]+)/",
		'$5',
		$url
	);

	return $output;
}

function bbcode($data){

	$search = array(
		'/\[b\](.*?)\[\/b\]/is',
		'/\[i\](.*?)\[\/i\]/is',
		'/\[u\](.*?)\[\/u\]/is',
		'/\[li\](.*?)\[\/li\]/is',
		'/\[br\]/is'
		);
	$replace = array(
		'<strong>$1</strong>',
		'<em>$1</em>',
		'<u>$1</u>',
		'<li>$1</li>',
		'<br />'
		);

	/* Check for multiple [br] tags */
	$data = preg_replace('/(\[br\])+/', '[br]', trim($data));

	/* Replace the codes */
	$data = preg_replace($search, $replace, $data);

	return $data;
}

function generateSlug($string, $delimiter = "-") {

		/* Convert accents characters */
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

		/* Replace all non words characters with the specified $delimiter */
		$string = preg_replace('/\W/', $delimiter, $string);

		/* Check for double $delimiters and remove them so it only will be 1 delimiter */
		$string = preg_replace('/-+/', '-', $string);

		/* Remove the $delimiter character from the start and the end of the string */
		$string = trim($string, $delimiter);

		/* Make all the remaining words lowercase */
		$string = strtolower($string);

		return $string;
}


function sendmail($to, $from, $title, $message) {

	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($to, $title, $message, $headers);
}

function resize($file_name, $path, $width, $height, $center = false) {
	/* Get original image x y*/
	list($w, $h) = getimagesize($file_name);

	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	$y = 0;
	if($center) $y = 250 + $h/1.5;

	/* read binary data from image file */
	$imgString = file_get_contents($file_name);

	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
	0, 0,
	$x, $y,
	$width, $height,
	$w, $h);

	/* Save image */
	imagejpeg($tmp, $path, 100);

	return $path;
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
}

function formatBytes($bytes, $precision = 2) {
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';

    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';

    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';

    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';

    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}

function string_resize($string, $maxchar) {
	$length = strlen($string);
	if($length > $maxchar) {
		$cutsize = -($length-$maxchar);
		$string  = substr($string, 0, $cutsize);
		$string  = $string . '..';
	}
	return $string;
}

function get_gravatar($email, $size) {
	$grav_url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim( $email ) ) ) . '?d=' . urlencode( 'http://www.gravatar.com/avatar/' ) . '&s=' . $size;
	return $grav_url;
}

/* Function to return all the settings table */
function settings_data() {
	global $database;

	$result = $database->query("SELECT * FROM `settings` WHERE `id` = 1");
	$data   = $result->fetch_object();

	return $data;
}

/* Initiate html columns */
function initiate_html_columns() {
	global $no_panel_pages;
	global $full_width_pages;

	include 'template/includes/initiate_main_column.php';
}


function display_notifications() {
	global $language;

	$types = array('error', 'success', 'info');
	foreach($types as $type) {
		if(isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
			if(!is_array($_SESSION[$type])) $_SESSION[$type] = array($_SESSION[$type]);

			foreach($_SESSION[$type] as $message) {
				echo '
					<div class="card-panel teal">
					<span class="white-text"><strong>' . $language->global->message_type->$type . '</strong> ' . $message . '</span>
					</div>
				';
			}
			unset($_SESSION[$type]);
		}
	}

}

?>
