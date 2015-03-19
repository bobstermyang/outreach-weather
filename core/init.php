<?php
/* Script version 1.2 */
ob_start();
session_start();
error_reporting(E_ALL);

include 'database/connect.php';
include 'functions/language.php';
include 'functions/general.php';
include 'classes/User.php';

/* Initialize variables */
$errors 				= array();
$settings 				= settings_data();
$no_panel_pages			= array('index', 'search');
$pre_processing_pages	= array('test');

/* If user is logged in get his data */
if(User::logged_in()) {
	$account_user_id = (isset($_SESSION['user_id']) == true) ? $_SESSION['user_id'] : $_COOKIE['user_id'];
	$account = new User($account_user_id);

	/* Update last activity */
	$database->query("UPDATE `users` SET `last_activity` = unix_timestamp() WHERE `user_id` = {$account_user_id}");
}

/* Redirect function */
function redirect($new_page = 'index') {
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = (strlen(dirname($_SERVER['PHP_SELF'])) < 2 ) ? null : dirname($_SERVER['PHP_SELF']);
	header('Location: http://'. $host . $uri . '/' . $new_page);
	die();
}


if(isset($_GET['page']) && in_array($_GET['page'], $pre_processing_pages)) include 'processing/' . $_GET['page'] . '.php';
include 'functions/titles.php';
?>
