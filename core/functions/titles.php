<?php
$page_title = $language->home->title;

if(isset($_GET['page'])) {
	switch($_GET['page']) {
		case 'not_found' 					:	$page_title = $language->not_found->title;						break;
	}
}

$page_title .= ' - ' . $settings->title;
?>
