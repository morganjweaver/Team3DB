<?php
require "connection.php";
require "include/Header.php";
require "include/navbar.php";
// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sqlMonthStartDate = "SELECT month_id, month_descrip FROM month";
$resultMonthStartDate = mysqli_query($conn, $sqlMonthStartDate);

$sqlMonthEndDate = "SELECT month_id, month_descrip FROM month";
$resultMonthEndDate = mysqli_query($conn, $sqlMonthEndDate);


?>

<html> 
<head>
	<title>Milestone 3 (team 3)</title>
</head>
<body>

    <form action="Page5b_Add_Employment_History.php" method="post">

    <h1>Employment History</h1>
 
<p>Employer/Organization:  <input type="text" name="emp_name"></p>

<p>Are you currently employed at this organization?</p>
<p style='margin-left:20px;'>
<input type="radio" name="emp_current" value=true> Yes</p>
<p style='margin-left:20px;'>
<input type="radio" name="emp_current" value=false> No</p>

<p>Organization address:</p>
<p style='margin-left:20px;'>
<input type="text" name="emp_street_addr" placeholder="Street Address">
<input type="text" name="emp_unit_num" placeholder="Unit#, Apt#, Bldg#">
</p>
<p style='margin-left:20px;'>
<input type="text" name="emp_city" placeholder="City">

<?php
$sql = "SELECT state_id, state_description FROM state";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<select id='state'>";
while ($row = mysqli_fetch_row($result)) {
    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
}
echo "</select>";
} else {
    echo "0 results";
}
?>

<p style='margin-left:20px;'>
<input type="text" name="emp_zip" maxlength=5 size=5 placeholder="Zip Code">
</p>

<p>Organization phone: (
<input type="text" name="emp_phone1" maxlength=3 size=1 
placeholder=" ###"> ) 
<input type="text" name="emp_phone2" maxlength=3 size=1
placeholder=" ###"> -
<input type="text" name="emp_phone3" maxlength=4 size=2 
placeholder=" ####"> 
</p>


<p>Job title: </p>
<p style='margin-left:20px;'>
<input type="text" name="emp_occupation">
</p>

<p>
Start date: 

<?php
if(mysqli_num_rows($resultMonthStartDate) > 0) {
    echo "<select id='month_startdate'>";
    while ($row = mysqli_fetch_row($resultMonthStartDate)) {
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }
    echo "</select>";
} else {
    echo "0 results for months";
}
?>

<?php
echo "<select id='day_startdate'>";
for($day_startdate=1; $day_startdate<=31; $day_startdate++) {
    echo "<option value='".$day_startdate."'>".$day_startdate."</option>";
}
echo "</select>";
?>

<?php
echo "<select id='year_startdate'>";
for($year_startdate=2015; $year_startdate>=1900; $year_startdate--) {
    echo "<option value='".$year_startdate."'>".$year_startdate."</option>";
}
echo "</select>";
?>
</p>

<p>
End date:

<?php
if(mysqli_num_rows($resultMonthEndDate) > 0) {
    echo "<select id='month_enddate'>";
    while ($row = mysqli_fetch_row($resultMonthEndDate)) {
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }
    echo "</select>";
} else {
    echo "0 results for months";
}
?>

<?php
echo "<select id='day_enddate'>";
for($day_enddate=1; $day_enddate<=31; $day_enddate++) {
    echo "<option value='".$day_enddate."'>".$day_enddate."</option>";
}
echo "</select>";
?>

<?php
echo "<select id='year_enddate'>";
for($year_enddate=2015; $year_enddate>=1900; $year_enddate--) {
    echo "<option value='".$year_enddate."'>".$year_enddate."</option>";
}
echo "</select>";
?>

</p>

<p>This position was 

<?php
$sql = "SELECT fptime_id, fptime_descrip FROM fptime";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<select id='fptime'>";
while ($row = mysqli_fetch_row($result)) {
    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
}
echo "</select>";
} else {
    echo "0 results";
}
?>
.</p>

<p>
<input type="submit" value="Submit">
<input type="reset" value="Clear">
</p>

<p><em>You will have the option to add additional Employment History records<br> after clicking "Submit".</em></p>

</form>
</body>

<?php
// Free result set
mysqli_free_result($resultMonthStartDate);
mysqli_free_result($resultMonthEndDate);
?>
</html>