<?php include('header.php'); ?>
<?php include('securityHeader.php'); ?>
<?php include('returnLink.php'); ?>

<h1>Clarifications</h1>

<?php
include('settings.php');
include(getDependencyDir() . "/scratchcompprefs.php");

showClarifications();
function showClarifications() {
	$team = getTeam($_POST["teamPassword"]);

	$save_dir = getSaveDir();
	$clarify_dir = $save_dir . "/clarify";

	$dir = new DirectoryIterator($clarify_dir);
	foreach ($dir as $fileinfo) {
		if (!$fileinfo->isDot()) {
			$filename = $fileinfo->getFilename();

			if (substr($filename, 0, strlen("clarification")) == "clarification") {
				$clarification = json_decode(file_get_contents($clarify_dir . "/" . $filename));
				if (($clarification->team == '-1' || $clarification->team == $team) && $clarification->status == 'published') { 
					?>
<hr>
<h3>Clarification for <?php if ($clarification->team == '-1') { echo "all teams"; } else { echo "your team"; } ?></h3>
<p>Time of clarification: <?php echo $clarification->time; ?>
<p><?php echo $clarification->clarification; ?>
					<?php
				}
			}
		}
	}
}
?>
