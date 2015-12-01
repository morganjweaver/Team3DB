<!--confirmation page displays all previously entered user data with logout or -->

<?php require "connection.php";
?>

<?php
$username = mysqli_real_escape_string($conn, $_POST["username"]);   
$pwd = $_POST["password"];  
$sql = "SELECT * FROM USER WHERE User_Name = '$username' AND password = MD5('$pwd')";   
$result = mysqli_query($conn, $sql);  
if  (mysqli_num_rows($result) > 0)  {
 echo "Welcome" . $username; 
} else {
    echo "Log in fail! Please try again.";  
}   
mysqli_free_result($result);    
mysqli_close($conn);    
?> 

<!DOCTYPE html>
<html>
<head>
<title>New Application</title>
</head>
<body>

<?php

$stmt = $conn->prepare("SELECT * FROM NEW_APPLICATION WHERE User_ID = $User_ID");
if ($stmt->execute(array($_GET['name']))) {
  while ($row = $stmt->fetch()) {
    print_r($row);
  }
}
$studenttypessql = "SELECT grad_type_id, grad_type_description FROM NEW_APPLICATION, 
graduate_type WHERE NEW_APPLICATION.User_ID=$User_ID";
$studenttypessqlresult = mysqli_query($conn, $studenttypessql);

?>
<p style='margin-left:20px;'> Student Type:
<p style='margin-left:20px;'> College:
<p style='margin-left:20px;'> Degree Type:
<p style='margin-left:20px;'> Major:
<p style='margin-left:20px;'> Term:
<p style='margin-left:20px;'> Name:
<p style='margin-left:20px;'> Preferred Name:
<p style='margin-left:20px;'> Date of Birth:
<p style='margin-left:20px;'> Mailing Address:
<p style='margin-left:20px;'> Phone Number: 
<p style='margin-left:20px;'> US Citizen:
<p style='margin-left:20px;'> Native ENglish Speaker:
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




<!-- post to next page here; what IS form action here?  
Just display? Logout? Final submission? -->
<form action= "Page2_Personal_Information.php" method= "POST">
<?php
//SELECT from DB or Form variable$ here?
?>

//change these to suit needed form action.  Logout?
<p><input type=submit value="Submit">
    <input type = reset value="Clear"></p>
</form>
</body>
</html>