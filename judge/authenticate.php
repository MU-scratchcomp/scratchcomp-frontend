<h>Authentication
<?php

include('../settings.php');
include(getDependencyDir() . '/scratchcompprefs.php');

authenticate();
function authenticate() {
		if (checkJudgingPassword($_POST["scratchJudgingPassword"])) {
			session_start();
			$_SESSION["judgeLogin"] = 1;
			$_SESSION["name"] = $_POST["name"];
			echo "<p>You have successfully been authenticated, " . $_SESSION["name"];
			echo "<p><a href=\"main.php\">Go to main judging page</a>";
			return;
		} else {
			echo "<p>Sorry, but I could not authenticate you, " . $_POST["name"];
			echo "<p><a href=\"login.php\">Return to login page</a>";
		}
}

?>
