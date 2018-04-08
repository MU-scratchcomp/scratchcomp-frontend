<?php include('header.php'); ?>

<?php
session_start();
include('settings.php');
include(getDependencyDir() . "/scratchcompprefs.php");

submitClarification();
function submitClarification() {
	$save_dir = getSaveDir();
	$clarify_dir = $save_dir . "/clarify";

	mkdir($clarify_dir, 0777, true);

	$filename = "clarification" . date("H-i-s-u") . ".txt";
	$filepath = $clarify_dir . "/" . $filename;

	$clarification = array(
			'time' => date("r"),
			'team' => $_POST["team"],
			'status' => 'published',
			'judge' => $_SESSION["name"],
			'clarification' => $_POST["clarification"]);

	if (file_put_contents($filepath, json_encode($clarification))) {
		chmod($filepath, 0777);
		echo "<p>Submitted clarification successfully.";		
	} else {
		echo "<p>Failed to submit clarification.";
	}
}
?>
