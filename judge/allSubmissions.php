<?php include('header.php'); ?>

<p>This is the list of all submissions.

<table border=1>
	<tr>
		<th>Status</th>
		<th>Team</th>
		<th>Problem</th>
		<th>Submission</th>
		<th>Project Download</th>
		<th>Design Link</th>
		<th>Project Link</th>
	</tr>
<?php
include('../settings.php');

readIndex();
function readIndex() {
	$save_dir = getSaveDir();

	$csvData = file_get_contents($save_dir . "/index.csv");
	$lines = explode(PHP_EOL, $csvData);
	$submissions_table = array();
	foreach ($lines as $line) {
		$submissions_table[] = str_getcsv($line);
	}
	$submissions_table = array_reverse($submissions_table);

	foreach($submissions_table as $row) {
		if ($row[0] != '') {
		?><tr>
		<td>
		<form action=<?php if (file_exists($save_dir . "/team" . $row[0] . "/feedback/prob" . $row[1] . "sub" . $row[2] . ".txt") && json_decode(file_get_contents($save_dir . "/team" . $row[0] . "/feedback/prob" . $row[1] . "sub" . $row[2] . ".txt"))->score != "" ) { 
			echo "viewGrade.php"; 
		} else { 
			echo "grade.php"; 
		}?> method="post" enctype="multipart/form-data">
		
			<input type="hidden" name="team" value=<?php echo $row[0]; ?>>
			<input type="hidden" name="problem" value=<?php echo $row[1]; ?>>
			<input type="hidden" name="submission" value=<?php echo $row[2]; ?>>
<?php 
			
	$feedback = json_decode($filecontent);
	if (file_exists($save_dir . "/team" . $row[0] . "/feedback/prob" . $row[1] . "sub" . $row[2] . ".txt")
		&& json_decode(file_get_contents($save_dir . "/team" . $row[0] . "/feedback/prob" . $row[1] . "sub" . $row[2] . ".txt"))->score != "" ) { ?>
			Graded
			<input type="submit" value="View Grade" id="viewGrade">
		<?php } else {?>
			Needing Grading
			<input type="submit" value="Grade" id="claim">
		<?php }?>
		</form>
		</td>

		<td><?php echo $row[0]; ?></td> <!-- Team -->
		<td><?php echo $row[1]; ?></td> <!-- Problem Number -->
		<td><?php echo $row[2]; ?></td> <!-- Submission Number -->

<!--		<td><a href=<?php echo $row[3]; ?>><?php echo $row[3]; ?></a></td> Project download -->
		<td>
		<form action=download.php method="post" enctype="multipart/form-data">
			<input type="hidden" name="team" value=<?php echo $row[0]; ?>>
			<input type="hidden" name="problem" value=<?php echo $row[1]; ?>>
			<input type="hidden" name="submission" value=<?php echo $row[2]; ?>>
			<input type="submit" value="Download .sb2" id="download">
		</form>
		</td>

		<!-- Design doc -->
		<td>
		<?php if (file_exists($save_dir . "/team" . $row[0] . "/design/prob" . $row[1] . "sub" . $row[2] . ".txt")) { ?>
		<form action=design.php method="post" enctype="multipart/form-data">
			<input type="hidden" name="team" value=<?php echo $row[0]; ?>>
			<input type="hidden" name="problem" value=<?php echo $row[1]; ?>>
			<input type="hidden" name="submission" value=<?php echo $row[2]; ?>>
			<input type="submit" value="View Design Document" id="viewDesign">
		</form>
		<?php }?>
		</td>


		<!-- Project Link -->
		<td>
		<a href="<?php echo $row[3]; ?>" target="_blank">scratch.mit.edu</a>
		</td>
	</tr>
	<?php
		}
	}
}

?>
</table>
