<?php
require "connection.php";
session_start();

// for testing purposes only - will remove
print_r($_POST);
//print_r($_SESSION);
?>

<html>
<head>
    <title>Milestone 4 (team 3)</title>
</head>
<body>    

<?php
// check for completion and set Application_Information variables
include "check_variables_Application_Information.php";

if ($applicationInfoIsComplete && 
   ($_POST['felony'] == 1)) {
    display_message();
	// include prepared statement for Application_Information here
} elseif ($applicationInfoIsComplete && 
   ($_POST['felony'] == 0)) {
    goTo_confirmation();
	// include prepared statement for Application_Information here
} else {
    goTo_applicationInformation();
}

function display_message(){
    echo <<<EOF
    <form action="Confirmation.php" method="post">
<p>
A conviction will not necessarily bar admission but will require additional <br>
documentation prior to a decision. You will be contacted shortly via email with <br>
instructions on reporting the nature of your conviction. 
</p>
<p>
Click "Continue" to review your completed application.
</p>
<p><input type=submit value="Continue"></p>
EOF;
}

function goTo_Confirmation(){
	    echo <<<EOF
    <form action="Confirmation.php" method="post">
<p>
Your application is complete. Click "Continue" to review your submission.
</p>
<p><input type=submit value="Continue"></p>
EOF;
}

function goTo_applicationInformation(){
	    echo <<<EOF
    <form action="Application_Information.php" method="post">
	<p>
	It appears that the reqired fields above were not completed on the Application Information page. <br>
	Please note that all fields must be completed before clicking the "Submit" button. <br>
	</p>
	<p>
	Press "Continue" to return to the Application Information page.
	</p>
	<p><input type=submit value="Continue"></p>
EOF;
}

?>