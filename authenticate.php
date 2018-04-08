<h>Authentication
<?php

include('settings.php');
include(getDependencyDir() . '/scratchcompprefs.php');

authenticate();
function authenticate() {
		$teamNumber = getTeam($_POST["teamPassword"]);
		if ($teamNumber == "-1" || $teamNumber == "") {
			echo "<p>Invalid password.";
		} else {
			session_start();
			$_SESSION["teamlogin"] = 1;
			$_SESSION["teamNumber"] = $teamNumber;
			echo "<p>You have successfully been authenticated, team " . $teamNumber;
			return;
		}
}

include('returnLink.php');
?>
