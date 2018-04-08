<h>Authentication
<?php

include('../settings.php');

authenticate();
function authenticate() {
		if ($_POST["scratchJudgingPassword"] == getJudgingPassword()) {
			session_start();
			$_SESSION["login"] = 1;
			$_SESSION["name"] = $_POST["name"];
			echo "<p>You have successfully been authenticated, " . $_SESSION["name"];
			return;
		} else {
			echo "<p>Sorry, but I could not authenticate you, " . $_POST["name"];
		}
}

?>

<form action=<?php echo $_SESSION["redirect"]?> method="post" enctype="multipart/form-data">
	<input type="submit" value="Click here to redirect and/or resubmit to the page you tried to access." id="submit">
</form>
