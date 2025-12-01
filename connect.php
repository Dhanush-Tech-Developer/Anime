<?php
define("HOSTNAME", "localhost:3307"); 
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "anime");

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>