<?php include('header.php'); ?>
<?php include('securityHeader.php'); ?>
<?php include('returnLink.php'); ?>

<?php
include('settings.php');

submitQuestion();
function submitQuestion() {
	$save_dir = getSaveDir();
	$clarify_dir = $save_dir . "/clarify";

	$filename = "question" . date("H-i-s-u") . ".txt";
	$filepath = $clarify_dir . "/" . $filename;

	$clarification = array(
			'time' => date("r"),
			'team' => $_SESSION["teamNumber"],
			'status' => 'unresolved',
			'question' => $_POST["question"]);

	if (file_put_contents($filepath, json_encode($clarification))) {
		chmod($filepath, 0777);
		echo "<p>Submitted clarification successfully.";		
	} else {
		echo "<p>Failed to submit clarification. Talk to a room proctor if this issue continues.";
	}
}
?>
