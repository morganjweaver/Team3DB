<?php
// $servername = "localhost";		
// $username = "root";
// $password = "secret";
// $dbname = "cs5021team3";
$servername = "cssql.seattleu.edu";		
$username = "weaverm1";
$password = "yuhMUdJA";
$dbname = "cs5021team3";
// Create connec1on
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check	connecton
if (!$conn) {die("Connecton failed:".mysqli_connect_error());
}
echo "Connected successfully";	
?>