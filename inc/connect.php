<?php
//Edit the following fields in order to establish a connection with mysqli
//********************************************************************************
$dbhost    = "localhost"; //Leave this as 'localhost' once uploaded on a server
$dbuser    = "root"; //Username that is allowed to access the database
$dbpass    = ""; //Password
$dbname    = "abcc"; //Name of the database
//********************************************************************************
date_default_timezone_set('Africa/Lagos');
$timenow = time();
$site_name = "ABCC 2K24 FAREWELL BASH";
$site_tagline = "Share moments, Happy moments!";
$site_path = "http://localhost/abcc";
error_reporting(E_ALL);
global $conn;
$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or ("<head><meta name='viewport' content='width=device-width,initial-scale=1.0'><title>Explora</title></head><h1>Something went wrong</h1>");
mysqli_select_db($conn, $dbname);
