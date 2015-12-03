<?php
require "connection.php";
// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sqlTest = "SELECT test_id, test_description FROM entrance_test";
$resultTest = mysqli_query($conn, $sqlTest);

$sqlCurrYear =  "SELECT YEAR(NOW());";
$resultCurrYear = mysqli_query($conn, $sqlCurrYear);

?>

<html> 
<head>
	<title>Milestone 3 (team 3)</title>
</head>
<body>

    <form action="PageLast.php" method="post">

    <h1>Entrance Tests</h1>
 
<p><em>Please select the entrance tests you will be submitting to Admissions for review.</em></p>

<?php
if(mysqli_num_rows($resultTest) > 0) {
    while($row = mysqli_fetch_row($resultTest)){
        echo "<p style='margin-left:20px;'>
<input type='checkbox' name='".$row[0]."'>".$row[1]."</p>
<p style='margin-left:40px;'>
<em>Month and year taken:</em></p>
<p style='margin-left:40px;'>";
$sqlTestMonth = "SELECT month_id, month_descrip FROM month";
$resultTestMonth = mysqli_query($conn, $sqlTestMonth);
        if(mysqli_num_rows($resultTestMonth) > 0) {
            echo "<select id='month'>";
            while($row = mysqli_fetch_row($resultTestMonth)){
                echo "<p style='margin-left:40px;'>
<option value='".$row[0]."'>".$row[1]."</option>";
            }
        } else {
            echo "0 results for Months";
        }
    echo "<input type='number' name='".$row[0]."Year' min='1900' max='2015'></p>";
    }
} else {
    echo "0 results for Tests";
}


?>




<p>
<input type=submit value="Submit">
<input type=reset value="Clear">
</p>

</form>
</body>

<?php
// Free result set
mysqli_free_result($resultTest);
mysqli_free_result($resultCurrYear);
?>

</html>