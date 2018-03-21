<?php include('judgeHeader.php'); ?>

<h1>Feedback for Team <?php echo $_POST["team"] ?>, Problem <?php echo $_POST["problem"] ?>, Submission <?php echo $_POST["submission"] ?></h1>

<p><?php
include('settings.php');

loadFeedback();
function loadFeedback() {
	$save_dir = getSaveDir();

	$target_dir = $save_dir . "/team" . $_POST["team"] . "/feedback";
	$filecontent = file_get_contents($target_dir . "/prob" . $_POST["problem"] . "sub" . $_POST["submission"] . ".txt");
	$feedback = json_decode($filecontent);

	echo "<p>Graded by " . $feedback->judge;
	echo "<p>Score: " . $feedback->score;
	echo "<p>Feedback: " . $feedback->feedback;	

}
?>
