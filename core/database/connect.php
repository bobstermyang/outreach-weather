<?php
// Connection parameters
$DatabaseServer = 'localhost';
$DatabaseUser   = 'root';
$DatabasePass   = 'Para123&';
$DatabaseName   = 'weather';

// Connecting to the database
$database = new mysqli($DatabaseServer, $DatabaseUser, $DatabasePass, $DatabaseName);

?>