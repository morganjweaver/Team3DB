<?php
require "connection.php";
// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sqlDegree = "SELECT degree_earned_id, degree_earned_description FROM degree_earned";
$resultDegree = mysqli_query($conn, $sqlDegree);

$sqlMonthStart = "SELECT month_id, month_descrip FROM month";
$resultMonthStart = mysqli_query($conn, $sqlMonthStart);

$sqlMonthFinish = "SELECT month_id, month_descrip FROM month";
$resultMonthFinish = mysqli_query($conn, $sqlMonthFinish);

$sqlMonthDegree = "SELECT month_id, month_descrip FROM month";
$resultMonthDegree = mysqli_query($conn, $sqlMonthDegree);

?>

<html> 
<head>
	<title>Milestone 3 (team 3)</title>
</head>
<body>

    <form action="Page4b_Add_Educational_History.php" method="post">

    <h1>Educational History</h1>
 
<p>Institution:  <input type="text", name="ed_institution", 
placeholder="School Name"></p>

<p>Attended from:
<?php
if(mysqli_num_rows($resultMonthStart) > 0) {
    echo "<select id='month_start'>";
    while ($row = mysqli_fetch_row($resultMonthStart)) {
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }
    echo "</select>";
} else {
    echo "0 results for months";
}
?>

<?php
echo "<select id='day_start'>";
for($day_start=1; $day_start<=31; $day_start++) {
    echo "<option value='".$day_start."'>".$day_start."</option>";
}
echo "</select>";
?>

<?php
echo "<select id='year_start'>";
for($year_start=2015; $year_start>=1900; $year_start--) {
    echo "<option value='".$year_start."'>".$year_start."</option>";
}
echo "</select>";
?>

</p>
<p style='margin-left:80px;'> to:

<?php
if(mysqli_num_rows($resultMonthFinish) > 0) {
    echo "<select id='month_finish'>";
    while ($row = mysqli_fetch_row($resultMonthFinish)) {
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }
    echo "</select>";
} else {
    echo "0 results for months";
}
?>

<?php
echo "<select id='day_finish'>";
for($day_finish=1; $day_finish<=31; $day_finish++) {
    echo "<option value='".$day_finish."'>".$day_finish."</option>";
}
echo "</select>";
?>

<?php
echo "<select id='year_finish'>";
for($year_finish=2015; $year_finish>=1900; $year_finish--) {
    echo "<option value='".$year_finish."'>".$year_finish."</option>";
}
echo "</select>";
?>

</p>

<p>Degree earned: 

<?php
if (mysqli_num_rows($resultDegree) > 0) {
    echo "<select id='degree_earned'>";
    while ($row = mysqli_fetch_row($resultDegree)) {
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }
    echo "</select>";
} else {
    echo "0 results for degree earned";
}


?>
</p>

<p>Major:  <input type="text", name="ed_major"></p>

<p>Degree received date:  

<?php
if(mysqli_num_rows($resultMonthDegree) > 0) {
    echo "<select id='month_degree_earned'>";
    while ($row = mysqli_fetch_row($resultMonthDegree)) {
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }
    echo "</select>";
} else {
    echo "0 results for months";
}
?>

<?php
echo "<select id='day_degree_earned'>";
for($day_degree_earned=1; $day_degree_earned<=31; $day_degree_earned++) {
    echo "<option value='".$day_degree_earned."'>".$day_degree_earned."</option>";
}
echo "</select>";
?>

<?php
echo "<select id='year_degree_earned'>";
for($year_degree_earned=2015; $year_degree_earned>=1900; $year_degree_earned--) {
    echo "<option value='".$year_degree_earned."'>".$year_degree_earned."</option>";
}
echo "</select>";
?>

</p>

<p>
<input type="submit" value="Submit">
<input type="reset" value="Clear">
</p>

<p><em>You will have the option to add additional Education History records<br> after clicking "Submit".</em></p>

</form>
</body>

<?php
// Free result set
mysqli_free_result($resultDegree);
mysqli_free_result($resultMonthStart);
mysqli_free_result($resultMonthFinish);
mysqli_free_result($resultMonthDegree);
?>

</html>