<?php include('header.php'); ?>

<?php
include('settings.php');

resolveClarification();
function resolveClarification() {
	$save_dir = getSaveDir();
	$clarify_dir = $save_dir . "/clarify";
	
	$dir = new DirectoryIterator($clarify_dir);
	foreach ($dir as $fileinfo) {
		if (!$fileinfo->isDot()) {
			$filename = $fileinfo->getFilename();
			if (substr($filename, 0, strlen("clarification")) == "clarification") {
				$read_data = json_decode(file_get_contents($clarify_dir . "/" . $filename));
				if ($read_data->time == $_POST["clarificationTime"]) {
					$write_data = array(
							'team' => $read_data->team,
							'time' => $read_data->time,
							'judge' => $read_data->judge,
							'clarification' => $read_data->clarification,
							'status' => $_POST["status"]);

					if (file_put_contents($clarify_dir . "/" . $filename, json_encode($write_data))) {
						echo "<p>Successfully updated clarification.";
					} else {
						echo "<p>Failed to update clarification.";
					}
					return;
				}
			}
		}
	}
	echo "<p>Could not find clarification.";
}
?>
