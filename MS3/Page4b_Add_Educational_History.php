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
    <h1>Educational History</h1>

<?php
if (isset($_POST['addEdHist']) && 
   ($_POST['addEdHist'] == 1)) {
    goTo_formEdHist();
} elseif (isset($_POST['addEdHist']) && 
         ($_POST['addEdHist'] == 0)) {
    goTo_formEmpHist();
} else {
    display_AddEdHistForm();
}

function display_AddEdHistForm() {
    echo<<<EOF
    <form action="$_SERVER[PHP_SELF]" method="post">
    <p>Do you have another educational history record to add?</p>
    <p style='margin-left:20px;'>
    <input type="radio" name="addEdHist" value=1> Yes</p>
    <p style='margin-left:20px;'>
    <input type="radio" name="addEdHist" value=0> No</p>

    <p><input type="submit" value="Submit"></p>
    </form>
EOF;
}

function goTo_formEdHist() {
    header ("Location: Page4a_Educational_History.php");
    exit();
}

function goTo_formEmpHist() {
    header ("Location: Page5a_Employment_History.php");
    exit();
}

?>

</body>
</html>