<?php require "connection.php";
?>

<html> 
<head>
	<title>Confirmation</title>
</head>
<body>



<?php
$current_user = 'jane';

$grad_type = "SELECT grad_type_description FROM user, new_application, graduate_type 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.grad_type_id = graduate_type.grad_type_id";
$grad_type_result = mysqli_query($conn, $grad_type);

$college = "SELECT college.college_description FROM user, new_application, college 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.College_id = college.College_id";
$college_result = mysqli_query($conn, $college);

$degree_type = "SELECT desired_degree.desired_description FROM user, new_application, desired_degree 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.degree_id = desired_degree.degree_id";
$degree_type_result = mysqli_query($conn, $degree_type);

$major = "SELECT desired_major.desired_major_description FROM user, new_application, desired_major 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.desired_major_id = desired_major.desired_major_id";
$major_result = mysqli_query($conn, $major);

$term = "SELECT desired_major.desired_major_description FROM user, new_application, desired_major 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.desired_major_id = desired_major.desired_major_id";
$major_result = mysqli_query($conn, $major);

$name = "SELECT desired_major.desired_major_description FROM user, new_application, desired_major 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.desired_major_id = desired_major.desired_major_id";
$major_result = mysqli_query($conn, $major);

$preferred_name = "SELECT desired_major.desired_major_description FROM user, new_application, desired_major 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.desired_major_id = desired_major.desired_major_id";
$major_result = mysqli_query($conn, $major);

$DOB = "SELECT desired_major.desired_major_description FROM user, new_application, desired_major 
WHERE user.User_Name = '$current_user' AND user.User_ID = new_application.User_ID AND 
new_application.desired_major_id = desired_major.desired_major_id";
$major_result = mysqli_query($conn, $major);
?>
    <form action="Logout.php" method="post">

    <?php

// $stmt = $conn->prepare("SELECT * FROM NEW_APPLICATION WHERE User_ID = $User_ID");
// if ($stmt->execute(array($_GET['name']))) {
//   while ($row = $stmt->fetch()) {
//     print_r($row);
//   }
// }
// $studenttypessql = "SELECT grad_type_id, grad_type_description FROM NEW_APPLICATION, 
// graduate_type WHERE NEW_APPLICATION.User_ID=$User_ID";
// $studenttypessqlresult = mysqli_query($conn, $studenttypessql);

?>
<p style='margin-left:20px;'> Student Type: 
<?php if (mysqli_num_rows($grad_type_result) > 0) 
{ while($row = mysqli_fetch_row($grad_type_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> College:
<?php if (mysqli_num_rows($college_result) > 0) 
{ while($row = mysqli_fetch_row($college_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Degree Type:
<?php if (mysqli_num_rows($degree_type_result) > 0) 
{ while($row = mysqli_fetch_row($degree_type_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Major:
<?php if (mysqli_num_rows($major_result) > 0) 
{ while($row = mysqli_fetch_row($major_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Term:
<?php if (mysqli_num_rows($major_result) > 0) 
{ while($row = mysqli_fetch_row($major_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Name:
<?php if (mysqli_num_rows($major_result) > 0) 
{ while($row = mysqli_fetch_row($major_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Preferred Name:
<?php if (mysqli_num_rows($major_result) > 0) 
{ while($row = mysqli_fetch_row($major_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Date of Birth:
<?php if (mysqli_num_rows($major_result) > 0) 
{ while($row = mysqli_fetch_row($major_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Mailing Address:
<p style='margin-left:20px;'> Phone Number: 
<p style='margin-left:20px;'> US Citizen:
<p style='margin-left:20px;'> Native English Speaker:
<p style='margin-left:20px;'> Gender:
<p style='margin-left:20px;'> Veteran Status: <!--BRANCH!?-->
<p style='margin-left:20px;'> Hispanic/Latino Origin:
<p style='margin-left:20px;'> Ethnicity:
<p style='margin-left:20px;'> Financial Aid:
<p style='margin-left:20px;'> Employer Assitance:
<p style='margin-left:20px;'> Other Programs:
<p style='margin-left:20px;'> Felony/Misdemeanor:
<p style='margin-left:20px;'> Sanctioned:
<p style='margin-left:20px;'> Educational History:
<p style='margin-left:20px;'> Employment History
<p style='margin-left:20px;'> Entrance Tests:
<p style='margin-left:20px;'>

<p>
		<input type="submit" value="Log Out">
		<!-- <form action="logout.php">
    <input type="button" value="Logout">
</form> -->
	</p>

</form>
</body>
</html>