<?php include('header.php'); ?>

<h1>All open clarification requests</h1>

<table border=1>
	<tr>
		<th>Status</th>
		<th>Team</th>
		<th>Time</th>
		<th>Question</th>
	</tr>
<?php
include('../settings.php');
include('../Parsedown.php');

showClarifications();
function showClarifications() {
	$Parsedown = new Parsedown();
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
			<form action="clarifyResolve.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="status" value="resolved">
				<input type="hidden" name="clarificationTime" value="<?php echo $question->time; ?>">
				<input type="submit" value="Mark as Resolved" id="resolve">
			</form>
			<form action="clarify.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="clarifyTeam" value="<?php echo $question->team?>">
				<input type="submit" value="Write a Response" id="write">
			</form>
		<?php } else { ?>
			Resolved
			<form action="clarifyResolve.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="status" value="unresolved">
				<input type="hidden" name="clarificationTime" value="<?php echo $question->time; ?>">
				<input type="submit" value="Marked as Unresolved" id="unresolve">
			</form>
		<?php } ?>
		</td>
		
		<td><?php echo $question->team; ?></td>
		<td><?php echo $question->time; ?></td>
		<td>
		<div style="background-color:#EBEDEF;padding:1px 10px;">
		<?php echo $Parsedown->text($question->question); ?>
		</div>
		</td>
	</tr>
				<?php
			}
		}
	}
}

?>
