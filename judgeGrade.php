<?php include('judgeHeader.php'); ?>

<h1> Grading Team <?php echo $_POST["team"]; ?>, Problem <?php echo $_POST["problem"];?>, Submission <?php echo $_POST["submission"] ?> </h1>

<form action="judgeGradeSubmit.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="team" value=<?php echo $_POST["team"]; ?>>
	<input type="hidden" name="problem" value=<?php echo $_POST["problem"]; ?>>
	<input type="hidden" name="submission" value=<?php echo $_POST["submission"]; ?>>
	<p>Score:
	<input type="text" name="score" required>
	<p>Feedback:
	<input type="text" name="feedback" required>
	<br>
	<input type="submit" value="Submit" required>
</form>

