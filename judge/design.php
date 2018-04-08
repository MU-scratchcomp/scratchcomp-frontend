<?php include('header.php'); ?>

<h2>Design Document for Team <?php echo $_POST["team"]; ?>, Problem <?php echo $_POST["problem"]; ?>, Submission <?php echo $_POST["submission"]; ?></h2>

<?php
include('../settings.php');
include('../Parsedown.php');

displayDesignDoc();
function displayDesignDoc() {
	$Parsedown = new Parsedown();
	$save_dir = getSaveDir();

	$content = file_get_contents($save_dir . "/team" . $_POST["team"] . "/design/prob" . $_POST["problem"] . "sub" . $_POST["submission"] . ".txt");
	?>
<p>
<div style="background-color:#EBEDEF;padding:1px 10px;">
<?php echo $Parsedown->text($content); ?>
</div>
	
<?php
}
?>
