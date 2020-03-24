<?php

$servername = "localhost";
$username = "root"; //"qpslhdsp_api";
$password = ""; //"q80p80s";
$database = "cds_attendance";//qpslhdsp_dbforqps";
 
// Create connection
$conn = new mysqli($servername, $username, $password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected successfully";
}

?>
