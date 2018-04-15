<?php include('header.php'); ?>

<h1>New clarification</h1>

<form action="clarifySubmit.php" method="post" enctype="multipart/form-data">
	<p>Team number (-1 for all teams):
	<input type="text" name="team" id="teamNumber" <?php if (isset($_POST["clarifyTeam"])) { echo "value=\"" . $_POST["clarifyTeam"] . "\""; }?>>

	<p>Clarification:
	<br>
	<textarea name="clarification" rows="10" cols="100"></textarea>
	<br>
	<input type="submit" value="Submit" id="submit">
</form>

