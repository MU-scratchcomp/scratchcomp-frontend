<?php include('header.php'); ?>

<h1>All published clarifications</h1>

<table border=1>
	<tr>
		<th>Status</th>
		<th>Team (-1 means all teams)</th>
		<th>Time</th>
		<th>Judge</th>
		<th>Clarification</th>
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
			$parts = explode("clarification", $filename);

			if (substr($filename, 0, strlen("clarification")) == "clarification") {
				$clarification = json_decode(file_get_contents($clarify_dir . "/" . $filename));
				?>
	<tr>
		<td>
		<?php if ($clarification->status == 'published') { ?>
			Published
			<form action="clarifyDelete.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="status" value="deleted">
				<input type="hidden" name="clarificationTime" value="<?php echo $clarification->time; ?>">
				<input type="submit" value="Delete Clarification" id="resolve">
			</form>
		<?php } else { ?>
			Deleted
			<form action="clarifyDelete.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="status" value="published">
				<input type="hidden" name="clarificationTime" value="<?php echo $clarification->time; ?>">
				<input type="submit" value="Publish Clarification" id="resolve">
			</form>
		<?php } ?>
		</td>
		
		<td><?php echo $clarification->team; ?></td>
		<td><?php echo $clarification->time; ?></td>
		<td><?php echo $clarification->judge; ?></td>
		<td>
		<div style="background-color:#EBEDEF;padding:1px 10px;">
		<?php echo $Parsedown->text($clarification->clarification); ?>
		</div>
		</td>
	</tr>
				<?php
			}
		}
	}
}

?>
