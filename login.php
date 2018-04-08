<?php include('header.php') ?>

<html>
<body>
<p>This is the login page for the 2018 Marquette ACM Programming Competition, Scratch Division.

<p>Please enter your team password.

<form action="authenticate.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="redirect" value=<?php echo $_SESSION["redirect"]?>>
	
	<p>Password:
	<input type="password" name="teamPassword" required>

	<input type="submit" value="Login" id="submit">
</form>

