<?php include('header.php') ?>
<?php include('securityHeader.php') ?>
<?php include('returnLink.php') ?>

<h1>Latest Feedback</h1>

<?php
include('settings.php');
include('Parsedown.php');

showFeedback();
function showFeedback() {
	$Parsedown = new Parsedown();
	$feedback_dir = getSaveDir() . "/team" . $_SESSION["teamNumber"] . "/feedback";

	$dir = new DirectoryIterator($feedback_dir);
	foreach ($dir as $fileinfo) {
		if (!$fileinfo->isDot()) {
			$filename = $fileinfo->getFilename();

			$parts = explode("sub", $filename);
			$probpart = explode("prob", $parts[0]);
			$problem = $probpart[1];

			$subpart = explode(".txt", $parts[1]);
			$submission = $subpart[0];

			$feedback = json_decode(file_get_contents($feedback_dir . "/" . $filename));

			?>
<hr>
<h2>Problem <?php echo $problem ?>, Submission <?php echo $submission ?></h2>
<p>Score: <?php echo $feedback->score ?>
<p>Feedback:
<div style="background-color:#EBEDEF;padding:1px 10px;">
<?php echo $Parsedown->text($feedback->feedback); ?>
</div>
		<?php			
		}
	}
}
?>
