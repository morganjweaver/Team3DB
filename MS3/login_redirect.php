<?php
require "connection.php";
session_start();

// for testing purposes only
//print_r($_SESSION);

// check if user has created an application in new_application
$stmt_NewApp = mysqli_prepare($conn, "SELECT application_id FROM new_application
 WHERE user_id = ?");
mysqli_stmt_bind_param($stmt_NewApp, "s", $user);
$user = $_SESSION['user_id'];
mysqli_stmt_execute($stmt_NewApp);
mysqli_stmt_bind_result($stmt_NewApp, $application);

$countNewApp = 0;
while(mysqli_stmt_fetch($stmt_NewApp)){
	$countNewApp++;
}

mysqli_stmt_close($stmt_NewApp);

// if the user has created an application, find the state of completion
if($countNewApp > 0){
	// get the applcation_id
	$_SESSION['application_id'] = $application;
	// check to see if Personal_Information was completed
	$stmt_PerInf = mysqli_prepare($conn, "SELECT * FROM personal_information 
	WHERE user_id = ? and application_id = ?");
	mysqli_stmt_bind_param($stmt_PerInf, "si", $user, $applicaion);
	$user = $_SESSION['user_id'];
	$application = $_SESSION['application_id'];
	mysqli_stmt_execute($stmt_PerInf);
	mysqli_stmt_bind_result($stmt_PerInf, $result_perInf);
	
	$countPerInf = 0;
	while(mysqli_stmt_fetch($stmt_PerInf)){
		$countPerInf++;
	}
	mysqli_stmt_close($stmt_PerInf);

	// if Personal_Informaiton page completed, check next page
	if($countPerInf > 0){
		// check to see if Application_Information was completed
		$stmt_AppInf = mysqli_prepare($conn, "SELECT * FROM application_information
		WHERE user_id = ? and application_id = ?");
		mysqli_stmt_bind_param($stmt_AppInf, "si", $user, $application);
		$user = $_SESSION['user_id'];
		$application = $_SESSION['application_id'];
		mysqli_stmt_execute($stmt_AppInf);
		mysqli_stmt_bind_result($stmt_AppInf, $result_appInf);
		
		$countAppInf = 0;
		while(mysqli_stmt_fetch($stmt_AppInf)){
			$countAppInf++;
		}
		mysqli_stmt_close($stmt_AppInf);

		// if Application_Information completed, go to Confirmation page
		if($countAppInf > 0){
			goTo_Confirmation();			
		// else, if Application_Information not completed, go to Application_Information page			
		} else {
			goTo_applicationInfo();
		}	
	// else, if Personal_Informaiton not completed, go to the Personal_Informaiton page	
	} else {
	goTo_personalInfo();
	}
// else, if no application was created, go to New_Application page
} else {
	goTo_newApplication();
}


function goTo_Confirmation(){
	echo <<<EOF
    <form action="Confirmation.php" method="post">
<p>
Our records show that you already have an application on file. 
</p>
<p>
Click "Continue" to review your completed application.
</p>
<p><input type=submit value="Continue"></p>
EOF;
}

function goTo_applicationInfo(){
	echo <<<EOF
    <form action="Application_Information.php" method="post">
<p>
Our records show that you already have an application in progress. 
</p>
<p>
Click "Continue" to return to the Application Information page to complete your application.
</p>
<p><input type=submit value="Continue"></p>
EOF;
}

function goTo_personalInfo(){
	echo <<<EOF
    <form action="Personal_Informaiton.php" method="post">
<p>
Our records show that you already have an application in progress. 
</p>
<p>
Click "Continue" to return to the Personal Information page to complete your application.
</p>
<p><input type=submit value="Continue"></p>
EOF;
}

function goTo_newApplication(){
	header("Location: New_Application.php");
    exit();
}


mysqli_close($conn);
?>