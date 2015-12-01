<?php

// set a boolean to track if Personal_Information fields are completed
$applicationInfoIsComplete = True;

if (isset($_POST['financial_aid'])){
	$financial_aid = $_POST['financial_aid'];
} else {
	echo "<p> <font color='red'>* Financial aid status not entered. </font> <p>";
	$applicationInfoIsComplete = False;
}

if (isset($_POST['employer_tuition'])){
	$employer_tuition = $_POST['employer_tuition'];
} else {
	echo "<p> <font color='red'>* Employer tuition assistance status not entered. 
	</font> <p>";
	$applicationInfoIsComplete = False;
}

if (isset($_POST['other_program_apps'])){
	$other_program_apps = $_POST['other_program_apps'];
} else {
	echo "<p> <font color='red'>* Application to other programs status not entered. 
	</font> <p>";
	$applicationInfoIsComplete = False;
}

if (isset($_POST['felony'])){
	$felony = $_POST['felony'];
} else {
	echo "<p> <font color='red'>* Conviction of felony or gross misdemeanor status not entered. 
	</font> <p>";
	$applicationInfoIsComplete = False;
}

if (isset($_POST['sanctioned'])){
	$felony = $_POST['sanctioned'];
} else {
	echo "<p> <font color='red'>* Suspension, probation, or dismissal status not entered. 
	</font> <p>";
	$applicationInfoIsComplete = False;
}
	
?>