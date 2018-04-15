<?php include('header.php'); ?>

<p>This is the list of all submissions. Click the headers to sort.
<p>Refresh to sort by timestamp (latest at the top).
<p>

<table border=1 id="maintable">
	<tr>
		<th onclick="sortTable(0)">Status</th>
		<th onclick="sortTable(1)">Team</th>
		<th onclick="sortTable(2)">Problem</th>
		<th onclick="sortTable(3)">Submission</th>
		<th>Project Download</th>
		<th>Project Hash</th>
		<th>Design Link</th>
		<th>Project Link</th>
	</tr>
<?php
include('../settings.php');
include(getDependencyDir() . '/scratchcompprefs.php');

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

		<td><?php echo $row[0] . ": " . getTeamName($row[0]); ?></td> <!-- Team -->
		<td><?php echo $row[1]; ?></td> <!-- Problem Number -->
		<td><?php echo $row[2]; ?></td> <!-- Submission Number -->

		<!-- Project Download -->
		<td>
		<form action=download.php method="post" enctype="multipart/form-data">
			<input type="hidden" name="team" value=<?php echo $row[0]; ?>>
			<input type="hidden" name="problem" value=<?php echo $row[1]; ?>>
			<input type="hidden" name="submission" value=<?php echo $row[2]; ?>>
			<input type="submit" value="Download .sb2" id="download">
		</form>
		</td>

		<!-- Project Hash -->
		<td><?php echo str_replace("\\n", "<br>", $row[3]); ?></td>

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
		<a href="<?php echo $row[4]; ?>" target="_blank">scratch.mit.edu</a>
		</td>
	</tr>
	<?php
		}
	}
}

?>
</table>



<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("maintable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
