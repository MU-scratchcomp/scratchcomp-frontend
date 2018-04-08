<?php include('judgeHeader.php'); ?>

<h2>Design Document for Team <?php echo $_POST["team"]; ?>, Problem <?php echo $_POST["problem"]; ?>, Submission <?php echo $_POST["submission"]; ?></h2>

<?php
include('settings.php');

displayDesignDoc();
function displayDesignDoc() {
	$save_dir = getSaveDir();

	$content = file_get_contents($save_dir . "/team" . $_POST["team"] . "/design/prob" . $_POST["problem"] . "sub" . $_POST["submission"] . ".txt");
	?>
<p>
<?php echo str_replace("\n", "<br>", $content); 
	
}
?>
