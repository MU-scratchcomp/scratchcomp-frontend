<?php
session_start();
if (!isset($_SESSION['login']))
{
		$_SESSION['redirect'] = "judgeMain.php";
		header("Location: judgeLogin.php");
} else {
	include('header.php');
	echo "<form action=\"judgeLogout.php\" method=\"post\" enctype=\"multipart/form-data\">	<p>Logged in as " . $_SESSION["name"] . " <input type=\"submit\" value=\"Logout\" id=\"logout\"> </form>";
	echo "<a href=\"judgeMain.php\">Main judging page</a>";
	echo "<hr>";
}
?>

