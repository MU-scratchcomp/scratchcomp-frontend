<?php include('header.php'); ?>

<?php
session_start();
include('../settings.php');

submitClarification();
function submitClarification() {
	$upload_dir = getUploadDir();

	$filename = "clarification" . date("H-i-s-u") . ".txt";
	$filepath = $upload_dir . "/" . $filename;

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
