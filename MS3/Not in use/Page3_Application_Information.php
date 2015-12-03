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

<?php
if (isset($_POST['felony']) && 
   ($_POST['felony'] == 1)) {
    process_formAppInfo();
} elseif (isset($_POST['felony']) && 
   ($_POST['felony'] == 0)) {
    goTo_formEdHist();
} else {
    display_formAppInfo();
}
  
function display_formAppInfo() {
    echo <<<EOF
    <form action="$_SERVER[PHP_SELF]" method="post">
    <h1>Application Information</h1>
<p>Will you be applying for financial aid? </p>
<p style='margin-left:20px;'>
<input type="radio" name="financial_aid" value=1> Yes</p>
<p style='margin-left:20px;'>
<input type="radio" name="financial_aid" value=0> No</p>

<p>Do you have employer tuition assistance? </p>
<p style='margin-left:20px;'>
<input type="radio" name="employer_tuition" value=1> Yes</p>
<p style='margin-left:20px;'>
<input type="radio" name="employer_tuition" value=0> No</p>

<p>Are you also applying to other programs? </p>
<p style='margin-left:20px;'>
<input type="radio" name="other_program_apps" value=1> Yes</p>
<p style='margin-left:20px;'>
<input type="radio" name="other_program_apps" value=0> No</p>

<p>Have you ever been convicted of a felony or a gross misdemeanor?</p>
<p style='margin-left:20px;'>
<input type="radio" name="felony" value=1> Yes</p>
<p style='margin-left:20px;'>
<input type="radio" name="felony" value=0> No</p>

<p>
<input type="submit" value="Submit" />
<input type="reset" value="Clear" />
</p>
    </form>
EOF;
}

function process_formAppInfo(){
    echo <<<EOF
    <form action="Page4a_Educational_History.php" method="post">
<p>
A conviction will not necessarily bar admission but will require additional <br>
documentation prior to a decision. You will be contacted shortly via email with <br>
instructions on reporting the nature of your conviction.
</p>
<p><input type=submit value="Continue"></p>
EOF;
}

function goTo_formEdHist(){
    header("Location: Page4a_Educational_History.php");
    exit();
}

?>

</body>
</html>