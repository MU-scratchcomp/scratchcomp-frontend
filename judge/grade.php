<?php include('header.php'); ?>

<h1> Grading Team <?php echo $_POST["team"]; ?>, Problem <?php echo $_POST["problem"];?>, Submission <?php echo $_POST["submission"] ?> </h1>

<form action="gradeSubmit.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="team" value=<?php echo $_POST["team"]; ?>>
	<input type="hidden" name="problem" value=<?php echo $_POST["problem"]; ?>>
	<input type="hidden" name="submission" value=<?php echo $_POST["submission"]; ?>>
	<p>Score:
	<input type="text" name="score" required>
	<p>Feedback:
	<br>
	<textarea name="feedback" rows="10" cols="100"></textarea>
	<br>
	<input type="submit" value="Submit" required>
</form>

