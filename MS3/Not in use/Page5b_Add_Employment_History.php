<?php
require "connection.php";
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
    <h1>Employment History</h1>

<?php
if (isset($_POST['addEmpHist']) && 
   ($_POST['addEmpHist'] == 1)) {
    goTo_formEmpHist();
} elseif (isset($_POST['addEmpHist']) && 
         ($_POST['addEmpHist'] == 0)) {
    goTo_formEntranceTests();
} else {
    display_AddEmpHistForm();
}

function display_AddEmpHistForm() {
    echo<<<EOF
    <form action="$_SERVER[PHP_SELF]" method="post">
    <p>Do you have another employment history record to add?</p>
    <p style='margin-left:20px;'>
    <input type="radio" name="addEmpHist" value=1> Yes</p>
    <p style='margin-left:20px;'>
    <input type="radio" name="addEmpHist" value=0> No</p>

    <p><input type="submit" value="Submit"></p>
    </form>
EOF;
}

function goTo_formEmpHist() {
    header ("Location: Page5a_Employment_History.php");
    exit();
}

function goTo_formEntranceTests() {
    header ("Location: Page6_Entrance_Tests.php");
    exit();
}

?>

</body>
</html>