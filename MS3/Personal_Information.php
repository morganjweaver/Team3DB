<?php
	
	require "connection.php";
	session_start();

	$sqlStateQuery = "SELECT state_id, state_description FROM state";
	$sqlMilitaryBranchQuery = "SELECT military_id, military_description FROM military_branch";
	$sqlVetStatQuery = "SELECT vet_status_id, vet_status_description FROM veteran_status";
	$sqlOriginTypeQuery = "SELECT origin_id, origin_description FROM origin_type";
	$sqlGender = "SELECT gender_id, gender_description FROM gender";
	$sqlMonth = "SELECT month_id, month_description FROM month";
	$resultState = mysqli_query($conn, $sqlStateQuery);
	$resultMilitaryBranch = mysqli_query($conn, $sqlMilitaryBranchQuery);
	$resultVetStat = mysqli_query($conn, $sqlVetStatQuery);
	$resultOriginType = mysqli_query($conn, $sqlOriginTypeQuery);
	$resultGender = mysqli_query($conn, $sqlGender);
	$resultMonth = mysqli_query($conn, $sqlMonth);

	//prepared statment to insert new_application into DB
	$stmt_new_application = mysqli_prepare($conn,"INSERT INTO new_application
		(user_id,grad_type_id,college_id,degree_id,desired_major_id,term_season_id,term_year_id) 
		VALUES (?,?,?,?,?,?,?)");
	
	// check connection status
	if($stmt_new_application==FALSE){die("Connecton failed:".mysqli_connect_error());}
	
	mysqli_stmt_bind_param($stmt_new_application, "sssssss",  
		$_SESSION['user_id'],
		$_POST['grad_type_id'], 
		$_POST['college_id'], 
		$_POST['degree_id'], 
		$_POST['desired_major_id'],
		$_POST['term_season_id'], 
		$_POST['term_year_id'] 
		); 

	//execute prepared statement
	mysqli_stmt_execute($stmt_new_application);
	//close statement and connection
	mysqli_stmt_close($stmt_new_application);

	$sessionUserID = $_SESSION['user_id'];
	//adding application_id to $_SESSION
	$sqlAppID = "SELECT application_id FROM new_application WHERE user_id = '$sessionUserID' ORDER BY application_id DESC LIMIT 1";
	$appID = mysqli_query($conn, $sqlAppID);
	$row = mysqli_fetch_row($appID);
	$_SESSION['application_id'] = $row[0];
?>

<!DOCTYPE html>
<html>

<head>
	<title>Personal Information</title>
</head>

<body>
	<h1>Personal Information</h1>
	
	<form action="Application_Information.php" method="POST">

	<!--<h3>Name</h3>-->
	<table>
		<tr>
			<td>
				<label for="fName">First Name:</label>
			</td>
			<td>
				<input id="fName" name="student_fname" placeholder="Your first name">
			</td>
		<tr>
			<td>
				<label for="initialName">Middle Initial:</label>
			</td>
			<td>
				<input id="initialName" name="student_initial" placeholder="I" size=1 maxlength=1>
			</td>
		<tr>
			<td>
				<label for="lName">Last Name:</label>
			</td>
			<td>
				<input id="lName" name="student_lname" placeholder="Your last name">
			</td>
		</tr>
		<tr>
			<td>
				<label for="prefName">Preferred Name:</label>
			</td>
			<td>
				<input id="prefName" name="student_prefname" placeholder="Your preferred name">
			</td>
		</tr>
	</table>

	<p>
		Date of Birth:	
					
				<?php
					if (mysqli_num_rows($resultMonth) > 0) 
					{
						// changed name from student_dob to the id 'bdayMonth'
						echo "<select id='bdayMonth' name='bdayMonth'>\n";
						while($row = mysqli_fetch_row($resultMonth)) 
						{
							echo "<option value='" . $row[0]	. "'>" . $row[1] . "</option>\n";
						}
						echo "</select>\n";
					} 
					else 
					{
						echo "0 results";
					}
				?>

				<!--<input type ="date" name="bdayMonth">-->
			<!--adding in a name for the $_POST variable-->
			<select name = 'bdayDay'>
					<?php
						for($i=1; $i<32; $i++)
						{
							echo "<option value='" . $i . "'>" . $i . "</option>\n";						
						}
					?>

				</select>
			<select name = 'bdayYear'>
					<?php
						for($i=2015; $i>1915; $i--)
						{
							echo "<option value='" . $i . "'>" . $i . "</option>\n";						
						}
					?>

				</select>
	</p>

<!--<h3>Contact Information</h3>-->
	<p>
		<label for"studentAddr">Mailing Address:</label>
	</p>
	<p>
		<input id="studentAddr" type="text" name="student_street_addr" placeholder="Street Address">
		<input type="text" name="student_unit_num" placeholder="Unit#, Apt#, Bldg#">
	</p>
	<p>
		<input type="text" name="student_city" placeholder="City">
	
		<?php
			if (mysqli_num_rows($resultState) > 0) 
			{
				echo "<select id='state' name='state_id'>\n";
				while($row = mysqli_fetch_row($resultState)) 
				{
					echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
				}
				echo "</select>\n";
			} 
			else 
			{
				echo "0 results";
			}
		?>
	</p>
	<p>
		<input type="text" name="student_zip" maxlength=5 size=5 placeholder="Zip">
	</p>

	<p>
	<!--changed name to prefphoneA, B, and C vs student_prefphone-->
		Preferred Phone Number:			
		( <input type="text" name="prefphoneA" size=3 maxlength=3 placeholder="123" > )
	
		<input type="text" name="prefphoneB"  size=3 maxlength=3 placeholder="456"> - 
	
		<input type="text" name="prefphoneC"  size=4 maxlength=4 placeholder="7890">
	</p>

<!--<h3>Citizenship, Language Information</h3>-->
	<p>
		Are you a US Citizen?
	</p> 
	<!--changed name to student_citizen vs origin_id-->
	<p style=margin-left:20px>
		<input type="radio" name="student_citizen" value=1>Yes
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="student_citizen" value=2>No
	</p>

	<p>
		Is English your native language?
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="student_english_lang" value=1>Yes
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="student_english_lang" value=2>No
	</p>

	<p>
		<label for="gender">
			Gender?
		</label>
		<?php
			if (mysqli_num_rows($resultGender) > 0) 
			{
				echo "<select id='gender' name='student_gender'>\n";
				while($row = mysqli_fetch_row($resultGender)) 
				{
					echo "<option value='" . $row[0]	. "'>" . $row[1] . "</option>\n";
				}
				echo "</select>\n";
			} 
			else 
			{
				echo "0 results";
			}
		?>
	</p>

<!--<h3>Military Information</h3>-->
	<p>
		<label for="vetStat">
			Please tell us your veteran status:
		</label>
		<?php
			if (mysqli_num_rows($resultState) > 0) 
			{
				echo "<select id='vetStat' name='vet_status_id'>\n";
				while($row = mysqli_fetch_row($resultVetStat)) 
				{
					echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
				}
				echo "</select>\n";
			} 
			else 
			{
				echo "0 results";
			}
		?>
	</p>

	<p>
		<label for="MilBranch">
			Military Branch (if applicable):
		</label>
		<?php
			if (mysqli_num_rows($resultMilitaryBranch) > 0) 
			{
				echo "<select id='MilBranch' name='military_id'>\n";
				while($row = mysqli_fetch_row($resultMilitaryBranch)) 
				{
					echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>\n";
				}
				echo "</select>\n";
			} 
			else 
			{
				echo "0 results";
			}
		?>
	</p>

<!--<h3>Ethnicity Information</h3>-->
	<p>
		Are you Hispanic/Latino?
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="student_hisplat" value=1>Yes
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="student_hisplat" value=2>No
	</p>

	<p>
		Please mark all that apply:
	</p>
	<p>
		<?php
			if (mysqli_num_rows($resultOriginType) > 0) 
			{
				while($row = mysqli_fetch_row($resultOriginType)) 
				{
					echo "<p style='margin-left:20px;'><input type='checkbox' name='origin_id[]'
					id='origin_id' value='" . $row[0] . "'>" . $row[1] . "</input></p>\n";
				}
			} 
			else 
			{
				echo "0 results";
			}
		?>
	</p>

	
	<p>
		<input type="submit" value="Submit">
		<input type="reset" value="Clear">
	</p>
	
	</form>
</body>
<?php
	// Free result set
	mysqli_free_result($resultState);
	mysqli_free_result($resultMilitaryBranch);
	mysqli_free_result($resultVetStat);
	mysqli_free_result($resultOriginType);
	mysqli_close($conn);
?>
</html>