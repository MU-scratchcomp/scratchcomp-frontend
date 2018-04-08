<title>Computers Judging</title>
<?php
session_start();
if (!isset($_SESSION['judgeLogin']))
{
		$_SESSION['judgeRedirect'] = "main.php";
		header("Location: login.php");
} else {
	echo "<form action=\"logout.php\" method=\"post\" enctype=\"multipart/form-data\">	<p>Logged in as " . $_SESSION["name"] . " <input type=\"submit\" value=\"Logout\" id=\"logout\"> </form>";
	echo "<a href=\"main.php\">Main judging page</a>";
	echo "<hr>";
}
?>

