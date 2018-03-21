<?php include('header.php') ?>
<?php include('returnLink.php') ?>

<h1>Latest Feedback</h1>

<?php
include('settings.php');
include(getDependencyDir() . "/scratchcompprefs.php");

showFeedback();
function showFeedback() {
	$team = getTeam($_POST["teamPassword"]);
	$feedback_dir = getSaveDir() . "/team" . $team . "/feedback";

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
<p>Feedback: <?php echo $feedback->feedback ?>


		<?php			
		}
	}
}
?>
