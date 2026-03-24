<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);

 $servername = "127.0.0.1";
 $dbname='db2504548_toolrental';
 $username = "2504548";
 $password = "4256123";
 // $password = ""; //This is for XAMPP local installation
 // Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
 if ($db->connect_error) {
 die("Connection failed: " . $db->connect_error);
}
echo "success";
?>