<?php include('header.php'); ?>

<?php
include('../settings.php');

submitFeedback();
function submitFeedback() {
	$save_dir = getSaveDir();
	$feedback = array(
			'score' => $_POST["score"],
			'feedback' => $_POST["feedback"],
			'judge' => $_SESSION["name"]);
	$team_dir = $save_dir . "/team" . $_POST["team"];
	$target_dir = $team_dir . "/feedback";
	$target_file = $target_dir . "/prob" . $_POST["problem"] . "sub" . $_POST["submission"] . ".txt";

	$score_file = $team_dir . "/score.csv";
	$scores = json_decode(file_get_contents($score_file));
	if ($scores->$_POST["problem"] < $_POST["score"]) {
		$scores->$_POST["problem"] = $_POST["score"];
		echo "<p>Updated high score for this problem.";
	}

	if (file_put_contents($target_file, json_encode($feedback)) && file_put_contents($score_file, json_encode($scores))) {
		echo "<p>Submitted feedback.";
		chmod($target_file, 0777);
		chmod($score_file, 0777);
	} else {
		echo "<p>Could not submit feedback.";
	}
}
?>
