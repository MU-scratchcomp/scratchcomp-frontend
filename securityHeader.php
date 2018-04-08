<?php
session_start();
if (!isset($_SESSION['teamlogin']))
{
		$_SESSION['redirect'] = "scratch.php";
		header("Location: login.php");
} else {
	echo "<form action=\"logout.php\" method=\"post\" enctype=\"multipart/form-data\">	<p>Logged in as team " . $_SESSION["teamNumber"] . " <input type=\"submit\" value=\"Logout\" id=\"logout\"> </form>";
}
?>

