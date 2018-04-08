<?php include('header.php'); ?>

<p>This is the list of all team scores. Click header to sort.

<?php
include('../settings.php');

readIndex();
function readIndex() {
	if (isset($_POST["submitballoons"])) {
		echo "<p>Submitted balloons: ";
		$save_dir = getSaveDir();
		foreach ($_POST as $key => $value) {
			if ($value == "done") {
				$team = substr($key, 4, strpos($key, "balloon") - 4);
				$file_path = $save_dir . "/team" . $team . "/score.csv"; 
				$teamscores = json_decode(file_get_contents($file_path));
				$teamscores->balloons = $teamscores->balloons + 1;
				file_put_contents($file_path, json_encode($teamscores));
				echo $team . " ";
			}
		}
	}	
?>
<table border=1 id="maintable">
	<tr>
		<th onclick="sortTable(0)" style="min-width:50px">Team</th>
	<?php
	for ($prob = 0; $prob <= 5; $prob++) {
		?><th onclick="sortTable(<?php echo $prob + 1; ?>)" style="min-width:30px"><?php echo $prob; ?></th>
	<?php
	}?>
		<th onclick="sortTable(7)" style="min-width:50px">Total</th>
		<th onclick="sortTable(8)" style="min-width:150px">Balloons needed</th>
	</tr>
	<?php
	$save_dir = getSaveDir();

	foreach(scandir($save_dir) as $subfile) {
		if (substr($subfile, 0, 4) == "team") {
			$scores = json_decode(file_get_contents($save_dir . "/" . $subfile . "/score.csv"));
			$team = substr($subfile, 4);
			?><tr>

			<td><?php echo $team; ?></td> <!-- Team -->
			<?php
			$total = 0;
			for ($prob = 0; $prob <= 5; $prob++) {
				if ($prob > 0) {
					$total = $total + $scores->{$prob};
				}
				?><td><?php echo $scores->{$prob}; ?></td> <!-- Submission Number -->
			<?php
			}?>
			<td><?php echo $total; ?></td>

			<td>
			<?php echo $total / 5 - $scores->balloons; ?>
			<form action="viewScores.php" method="post" enctype="multipart/form-data">
				<script type="text/javascript">
				function showSubmit<?php echo $team; ?>() {
					document.getElementById('submitballoonsdiv<?php echo $team; ?>').style.display = 'inline';
				}
				</script>
			<?php
			for ($scorelevel = 1; $scorelevel <= $total / 5; $scorelevel++) {
				?><input type="checkbox" name="<?php echo "team" . $team . "balloon" . $scorelevel; ?>" value="done" onclick="showSubmit<?php echo $team; ?>()"
	<?php if ($scores->balloons >= $scorelevel) { echo "checked disabled"; } ?>
	><?php
			}

				
			?>
			<br>
			<div id="submitballoonsdiv<?php echo $team; ?>" hidden>	
				<input type="submit" value="Save Changes" name="submitballoons">	
			</div>
			</form>
			</td>
		<?php
		}
		?>
	</tr>
	<?php
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
