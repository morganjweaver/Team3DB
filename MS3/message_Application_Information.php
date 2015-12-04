<?php
require "connection.php";
session_start();
?>

<html>
<head>
    <title>Milestone 4 (team 3)</title>
</head>
<body>    

<?php

include "check_variables_Application_Information.php";

if ($applicationInfoIsComplete) {
	// prepared statement for application_information table
	$stmt_application_info = mysqli_prepare($conn, "INSERT INTO application_information
	(application_id, app_financial_aid,app_employer_tuition,app_other_program_apps,
		app_felony, app_sanctioned) VALUES(?,?,?,?,?,?)");
	
	// check connection status
	if($stmt_application_info==FALSE){die("Error:".mysqli_connect_error());}
	
	mysqli_stmt_bind_param($stmt_application_info, 'iiiiii', $app, $fin, $emp_tuition,
		$other, $fel, $sanct);
	
	$app = $_SESSION['application_id'];
	$fin = $financial_aid;
	$emp_tuition = $employer_tuition;
	$other = $other_program_apps;
	$fel = $felony;
	$sanct = $sanctioned;	
	
	mysqli_stmt_execute($stmt_application_info);
	mysqli_stmt_close($stmt_application_info);

	if($_POST['felony'] == 1) {
		display_message();
	} else {
		goTo_confirmation();
	} 
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