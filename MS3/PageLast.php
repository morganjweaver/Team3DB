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

<?php if (mysqli_num_rows($grad_type_result) > 0) { while($row = mysqli_fetch_row($grad_type_result)) { echo $row[0]; } } ?>
</p>
<p style='margin-left:20px;'> College:
</p>
<p style='margin-left:20px;'> Degree Type:
</p>
<p style='margin-left:20px;'> Major:
<p style='margin-left:20px;'> Term:
<p style='margin-left:20px;'> Name:
<p style='margin-left:20px;'> Preferred Name:
<p style='margin-left:20px;'> Date of Birth:
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