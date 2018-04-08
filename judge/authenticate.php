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
			return;
		} else {
			echo "<p>Sorry, but I could not authenticate you, " . $_POST["name"];
		}
}

?>

<form action=<?php echo $_SESSION["judgeRedirect"]?> method="post" enctype="multipart/form-data">
	<input type="submit" value="Click here to redirect and/or resubmit to the page you tried to access." id="submit">
</form>
