<?php include('judgeHeader.php'); ?>

<h1>All open clarification requests</h1>

<table border=1>
	<tr>
		<th>Status</th>
		<th>Team</th>
		<th>Time</th>
		<th>Question</th>
	</tr>
<?php
include('settings.php');

showClarifications();
function showClarifications() {
	$save_dir = getSaveDir();
	$clarify_dir = $save_dir . "/clarify";

	$dir = new DirectoryIterator($clarify_dir);
	foreach ($dir as $fileinfo) {
		if (!$fileinfo->isDot()) {
			$filename = $fileinfo->getFilename();

			if (substr($filename, 0, strlen("question")) == "question") {
				$question = json_decode(file_get_contents($clarify_dir . "/" . $filename));
				?>
	<tr>
		<td>
		<?php if ($question->status == 'unresolved') { ?>
			Unresolved
			<form action="judgeClarifyResolve.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="status" value="resolved">
				<input type="hidden" name="clarificationTime" value="<?php echo $question->time; ?>">
				<input type="submit" value="Resolve" id="resolve">
			</form>
		<?php } else { ?>
			Resolved
			<form action="judgeClarifyResolve.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="status" value="unresolved">
				<input type="hidden" name="clarificationTime" value="<?php echo $question->time; ?>">
				<input type="submit" value="Unresolve" id="unresolve">
			</form>
		<?php } ?>
		</td>
		
		<td><?php echo $question->team; ?></td>
		<td><?php echo $question->time; ?></td>
		<td><?php echo $question->question; ?></td>
	</tr>
				<?php
			}
		}
	}
}

?>
