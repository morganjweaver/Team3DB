<?php
require "connection.php";
session_start();

// if this doesn't automatically post to the application page, we should
// just make user_id a session variable for sanity's sake
$_POST['user_id'] = "100";
$_SESSION['application_id'] = NULL;

// for testing purposes only
//print_r($_POST);
//print_r($_SESSION);

// check if user has created an application in new_application
$stmt_NewApp = mysqli_prepare($conn, "SELECT application_id FROM 
new_application WHERE user_id = ?");
mysqli_stmt_bind_param($stmt_NewApp, "s", $user);
$user = $_POST['user_id'];
mysqli_stmt_execute($stmt_NewApp);
mysqli_stmt_bind_result($stmt_NewApp, $application);

// works within count statement
//mysqli_stmt_fetch($stmt_NewApp);


$countNewApp = 0;
while(mysqli_stmt_fetch($stmt_NewApp)){
	$countNewApp++;
}

// testing
//echo "<p>Application id is ".$application;

mysqli_stmt_close($stmt_NewApp);

// testing
//echo "<p>Count for New_Application is ".$countNewApp;

// if the user has created an application, find the state of completion
if($countNewApp > 0){
	// get the applcation_id
	$_SESSION['application_id'] = $application;
	// check to see if Personal_Information was completed
	$stmt_PerInf = mysqli_prepare($conn, "SELECT student_fname FROM 
	personal_information WHERE application_id = ?");
	mysqli_stmt_bind_param($stmt_PerInf, "i", $app);
	$app = $_SESSION['application_id'];
	mysqli_stmt_execute($stmt_PerInf);
	mysqli_stmt_bind_result($stmt_PerInf, $result_perInf);
	
	$countPerInf = 0;
	while(mysqli_stmt_fetch($stmt_PerInf)){
		$countPerInf++;
	}
	
	// testing
	//echo "<p>Student name is ".$name;
	//echo "<p>Count for Personal_Informaiton is".$countPerInf;
	
	mysqli_stmt_close($stmt_PerInf);

	// testing
	//echo "<p>Count for Personal_Informaiton is ".$countPerInf;
	
	// if Personal_Informaiton page completed, check next page
	if($countPerInf > 0){
		// check to see if Application_Information was completed
		$stmt_AppInf = mysqli_prepare($conn, "SELECT app_felony FROM 
		application_information	WHERE application_id = ?");
		mysqli_stmt_bind_param($stmt_AppInf, "i", $application);
		$application = $_SESSION["application_id"];
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
	header("Location: Confirmation.php");
    exit();
}

function goTo_applicationInfo(){
	echo <<<EOF
    <form action="Application_Information.php" method="post">
<p>
Our records show that your application is incomplete. 
</p>
<p>
Please click "Continue" to return to the Application Information page to complete your application.<br>
Once your application is complete, you will be able to review your submission.
</p>
<p><input type="submit" value="Continue"></p>
EOF;
}

function goTo_personalInfo(){
	echo <<<EOF
    <form action="Personal_Information.php" method="post">
<p>
Our records show that your application is incomplete. 
</p>
<p>
Please click "Continue" to return to the Personal Information page to complete your application.<br>
Once your application is complete, you will be able to review your submission.
</p>
<p><input type="submit" value="Continue"></p>
EOF;
}

function goTo_newApplication(){
	echo <<<EOF
    <form action="New_Application.php" method="post">
<p>
Our records show that you have not yet created an application. 
</p>
<p>
Please click "Continue" to begin a new application.<br>
Once your application is complete, you will be able to review your submission.
</p>
<p><input type="submit" value="Continue"></p>
EOF;
}

mysqli_close($conn);
session_unset();
session_destroy();

?>