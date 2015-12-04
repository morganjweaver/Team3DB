<!DOCTYPE html>
<html>
<head>
	<title>Create New Account</title>
</head>

<h3>Please enter a username and password:</h3>

<body>

 <form action="Login.php" method="POST">

	<p>
		Email:
		<input name="user_id" placeholder="enter email address" required />		
	</p>

	<p>
		Create Password:
		<input type="password" name="user_password" placeholder="enter password" required />
	</p>

	<p>
		<button type="submit" formaction="Login.php" name="create_new_user">Create New Account
		</button>