<?php
	require "connection.php";

	$sqlStateQuery = "SELECT state_id, state_description FROM state";
	$sqlMilitaryBranchQuery = "SELECT military_id, military_description FROM military_branch";
	$sqlVetStatQuery = "SELECT vet_status_id, vet_status_description FROM veteran_status";
	$sqlOriginTypeQuery = "SELECT origin_id, origin_description FROM origin_type";
	$sqlGender = "SELECT gender_id, gender_descrip FROM gender";
	$sqlMonth = "SELECT month_id, month_descrip FROM month";
	$resultState = mysqli_query($conn, $sqlStateQuery);
	$resultMilitaryBranch = mysqli_query($conn, $sqlMilitaryBranchQuery);
	$resultVetStat = mysqli_query($conn, $sqlVetStatQuery);
	$resultOriginType = mysqli_query($conn, $sqlOriginTypeQuery);
	$resultGender = mysqli_query($conn, $sqlGender);
	$resultMonth = mysqli_query($conn, $sqlMonth);

?>

<!DOCTYPE html>
<html>

<head>
	<title>Personal Information</title>
</head>

<body>
	<h1>Personal Information</h1>
	
	<form action="Page3_Application_Information.php" method="POST">

	<!--<h3>Name</h3>-->
	<table>
		<tr>
			<td>
				<label for="fName">First Name:</label>
			</td>
			<td>
				<input id="fName" name="app_stud_fname" placeholder="Your first name">
			</td>
		<tr>
			<td>
				<label for="initialName">Middle Initial:</label>
			</td>
			<td>
				<input id="initialName" name="app_stud_initial" placeholder="I" size=1 maxlength=1>
			</td>
		<tr>
			<td>
				<label for="lName">Last Name:</label>
			</td>
			<td>
				<input id="lName" name="app_stud_lname" placeholder="Your last name">
			</td>
		</tr>
		<tr>
			<td>
				<label for="prefName">Preferred Name:</label>
			</td>
			<td>
				<input id="prefName" name="app_stud_prefname" placeholder="Your preferred name">
			</td>
		</tr>
	</table>

	<p>
		Date of Birth:	
					
				<?php
					if (mysqli_num_rows($resultMonth) > 0) 
					{
						echo "<select id='bdayMonth' name='app_stud_dob'>\n";
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
				
			<select>
					<?php
						for($i=1; $i<32; $i++)
						{
							echo "<option value='" . $i . "'>" . $i . "</option>\n";						
						}
					?>

				</select>
			<select>
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
		<input id="studentAddr" type="text" name="app_stud_street_addr" placeholder="Street Address">
		<input type="text" name="app_stud_unit_num" placeholder="Unit#, Apt#, Bldg#">
	</p>
	<p>
		<input type="text" name="app_stud_city" placeholder="City">
	
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
		<input type="text" name="app_stud_zip" maxlength=5 size=5 placeholder="Zip">
	</p>

	<p>
		Preferred Phone Number:			
		( <input name="app_stu_prefphone" placeholder="123" size=3 maxlength=3> )
	
		<input name="app_stu_prefphone" placeholder="456" size=3 maxlength=3> - 
	
		<input name="app_stu_prefphone" placeholder="7890" size=4 maxlength=4>
	</p>

<!--<h3>Citizenship, Language Information</h3>-->
	<p>
		Are you a US Citizen?
	</p> 
	<p style=margin-left:20px>
		<input type="radio" name="origin_id" value=1>Yes
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="origin_id" value=2>No
	</p>

	<p>
		Is English your native language?
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="app_stud_english_lang" value=1>Yes
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="app_stud_english_lang" value=2>No
	</p>

	<p>
		<label for="gender">
			Gender?
		</label>
		<?php
			if (mysqli_num_rows($resultGender) > 0) 
			{
				echo "<select id='gender' name='app_stud_gender'>\n";
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
			Military Branch:
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
		<input type="radio" name="app_stud_hisplat" value=1>Yes
	</p>
	<p style=margin-left:20px>
		<input type="radio" name="app_stud_hisplat" value=2>No
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
					echo "<p style='margin-left:20px;'><input type='checkbox' name='origin_id'" . $row[0] . "'>" . $row[1] . "</input></p>\n";
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