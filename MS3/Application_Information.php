<?php
require "connection.php";

//echo mysqli_connect_error();

session_start();

// temporary for texting
$_SESSION['application_id'] = 1000001;

// for testing purposes only - will remove
print_r($_POST);
print_r($_SESSION);

// check for completion and set Personal_Information variables 
include "check_variables_Personal_Information.php";
	
// If all information on Personal_Information page is complete, add it to the 
// DB and display the Application_Information page. Otherwise, send the user 
// back to the Personal_Information page.
if ($personalInfoIsComplete){
	
	// prepared statement to insert personal_information into DB
	$stmt_personal_info = mysqli_prepare($conn, "INSERT INTO personal_information
	(application_id, student_fname, student_lname, student_initial, student_prefname, 
	student_dob, student_street_address, student_unit_num, student_city, student_zip, 
	state_id, student_prefphone, student_citizen, student_english_lang, gender_id, 
	vet_status_id, military_id, hisplat)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	
	// check connection status
	if($stmt_personal_info==FALSE){die("Connecton failed:".mysqli_connect_error());}
	
	mysqli_stmt_bind_param($stmt_personal_info, 'isssssssssssiisssi', $app, $fname, 
	$lname, $initial, $prefname, $dob, $street_address, $unit_num, $city, $zip, $state,	
	$prefphone, $citizen, $english_lang, $gender, $vet_status, $military, $hisp);
	
	$app = $_SESSION['application_id'];
	$fname = $student_fname;
	$lname = $student_lname;
	$initial = $student_initial;
	$prefname = $student_prefname;
	$dob = $student_dob;
	$street_address = $student_street_address;
	$unit_num = $student_unit_num;
	$city = $student_city;
	$zip = $student_zip;
	$state = $state_id;
	$prefphone = $student_prefphone;
	$citizen = $student_citizen;
	$english_lang = $student_english_lang;
	$gender = $gender_id;
	$vet_status = $vet_status_id;
	$military = $military_id;
	$hisp = $hisplat;	
	
	mysqli_stmt_execute($stmt_personal_info);
	mysqli_stmt_close($stmt_personal_info);
	
	// prepared statement to insert applicant_origin into the DB
	$stmt_origin = mysqli_prepare($conn, "INSERT INTO applicant_origin 
	VALUES(?,?)");
	mysqli_stmt_bind_param($stmt_origin, 'is', $application_id, 
	$app_origin);
	$application_id = $_SESSION['application_id'];
	foreach($origin_id as $origin){
		$app_origin = $origin;
		mysqli_stmt_execute($stmt_origin);
	}
	mysqli_stmt_close($stmt_origin);
	
	// displays the Application_Information form page
	display_formAppInfo();
	
} else {
	// returns user to the Personal_Information page to complete form
	goTo_personalInformation();
}


function goTo_personalInformation(){
    echo <<<EOF
    <form action="Personal_Information.php" method="post">
	<p>
	It appears that the reqired fields above were not completed on the Personal Information page. <br>
	Please note that all fields must be completed before clicking the "Submit" button. <br>
	</p>
	<p>
	Press "Continue" to return to the Personal Information page.
	</p>
	<p><input type=submit value="Continue"></p>
EOF;
}

?>

<html>
<head>
    <title>Milestone 4 (team 3)</title>
</head>
<body>    

<?php

function display_formAppInfo() {
    echo <<<EOF
    <form action="message_Application_Information.php" method="post">
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

<p>Have you ever been placed on probation, suspended from, dismissed from 
or <br>otherwise sanctioned by (for a period of time) any higher education institution?</p>
<p style='margin-left:20px;'>
<input type="radio" name="sanctioned" value=1> Yes</p>
<p style='margin-left:20px;'>
<input type="radio" name="sanctioned" value=0> No</p>

<p>
<input type="submit" value="Submit" />
<input type="reset" value="Clear" />
</p>
    </form>
EOF;
}

?>

</body>
<?php
mysqli_close($conn);
?>
</html>