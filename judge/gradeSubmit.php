<?php include('header.php'); ?>

<?php
include('settings.php');

submitFeedback();
function submitFeedback() {
	$save_dir = getSaveDir();
	$feedback = array(
			'score' => $_POST["score"],
			'feedback' => $_POST["feedback"],
			'judge' => $_SESSION["name"]);
	$target_dir = $save_dir . "/team" . $_POST["team"] . "/feedback";
	$target_file = $target_dir . "/prob" . $_POST["problem"] . "sub" . $_POST["submission"] . ".txt";
	mkdir($target_dir, 0777, true);

	if (file_put_contents($target_file, json_encode($feedback))) {
		chmod($target_file, 0777);
		echo "<p>Submitted feedback.";
	} else {
		echo "<p>Could not submit feedback.";
	}
}
?>
