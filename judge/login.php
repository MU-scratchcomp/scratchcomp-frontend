<html>
<body>
<p>This is the login page for the 2018 Marquette ACM Programming Competition, Scratch Division, judging software.

<p>Leave if you are not judging this competition.

<p>Enter your name and the judging password. Use the same name each time you log in.

<form action="authenticate.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="redirect" value=<?php echo $_SESSION["judgeRedirect"]?>>
	
	<p>Name:
	<input type="text" name="name" required>
	
	<p>Password:
	<input type="password" name="scratchJudgingPassword" required>

	<input type="submit" value="Continue" id="submit">
</form>

