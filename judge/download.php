<?php include('header.php'); ?>

<p>Beginning download of project file from team
<?php echo $_POST["team"]; ?>
, problem <?php echo $_POST["problem"]; ?>, submission <?php echo $_POST["submission"]; ?></p>

<?php
include('settings.php');

beginDownload();
function beginDownload() {
	$save_dir = getSaveDir();
	$file_dir = $save_dir . "/team" . $_POST["team"];
	$filename = "prob" . $_POST["problem"] . "sub" . $_POST["submission"] . ".sb2";
	$filepath = $file_dir . "/" . $filename;

	header('Content-Type: application/download');
	header('Content-Disposition: attachment; filename="' . "team" . $_POST["team"] . $filename . '"');
	header('Content-LEngth: ' . filesize($filepath));

	$fp = fopen($filepath, 'r');
	fpassthru($fp);
	fclose($fp);
}

?>
