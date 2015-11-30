<?php
$servername = "cssql.seattleu.edu";
$username = "griecoa1";
$password = "Dprtr8LJ";
$dbname = "cs5021team3";

// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<html> 
<head>
	<title>Milestone 3 (team 3)</title>
</head>
<body>

    <form action="ConfirmationStandIn.php" method="post">

    <h3>Confirmation Page (Stand-In)</h3>
 
<p>End of Milestone 3.</p>

</form>
</body>
</html>