<html>
<body>
<?php include('header.php'); ?>
<?php include('securityHeader.php'); ?>
<hr>
<p>Welcome to the 2018 Marquette ACM Programming Competition, Scratch Division!

<hr>
<p><a href="CompetitionInstructions.pdf">Competition Instructions and Rules</a>
<p><a href="PracticeProblem.pdf">Pre-competition Practice Problem</a>
<p><a href="CompetitionProblems.pdf">Problem Specifications</a>

<hr>
<h2>Submit a Solution</h2>
<form action="submit.php" method="post" enctype="multipart/form-data">
	<script type="text/javascript">
	function hideCreative() {
		document.getElementById('creativeSubmit').style.display = 'none';
		document.getElementById('designFile').value = '';
		document.getElementById('designFile').required = false;
	}
	function showCreative() {
		document.getElementById('creativeSubmit').style.display = 'inline';
		document.getElementById('designFile').required = true;
	}
	</script>

	<p>Problem Solved:
	<table border=1>
		<td><label for="probPractice">Practice</label>
		<input type="radio" name="probRadio" id="probPractice" value="0" onClick="hideCreative()" required checked></td>
		<td><label for="probPractice">1</label>
		<input type="radio" name="probRadio" id="prob1" value="1" onClick="hideCreative()" ></td>
		<td><label for="probPractice">2</label>
		<input type="radio" name="probRadio" id="prob2" value="2" onClick="hideCreative()" ></td>
		<td><label for="probPractice">3</label>
		<input type="radio" name="probRadio" id="prob3" value="3" onClick="hideCreative()" ></td>
		<td><label for="probPractice">4</label>
		<input type="radio" name="probRadio" id="prob4" value="4" onClick="showCreative()" ></td>
		<td><label for="probPractice">5</label>
		<input type="radio" name="probRadio" id="prob5" value="5" onClick="showCreative()" ></td>
	</table>

	<br>Scratch .sb2 file:
	<input type="file" name="projectFile" id="projectFile" required>

	<div id="creativeSubmit" hidden>
		Creative Section Design Document:<br>
		(.txt file from Notepad - markdown formatting is supported - <a href='https://github.com/adam-p/markdown-here/wiki/Markdown-Here-Cheatsheet'>formatting guide</a>)
		<input type="file" name="designFile" id="designFile">
	</div>
	
	<p><input type="submit" value="Submit" name="submit">	
</form>


<hr>
<h2>Feedback</h2>
<p><a href="feedback.php">Get Feedback</a>
<p>Check this page regularly after submitting a solution.


<hr>
<h2>Request Clarification</h2>
<p>Use this form to ask for clarification on the competition rules, question prompts, or grading process. Feel free to talk to your room proctor first if it's about submitting your work or something else housekeeping-related. Most questions will be posted for everyone to see, so check this page regularly.
<form action="clarify.php" method="post" enctype="multipart/form-data">
	<p>Your question or concern:
	<br>
	<textarea name="question" rows="5" cols="50"></textarea>
	<p><input type="submit" value="Ask Question" name="askquestion">
</form>
<p><a href="viewclarify.php">View Clarifications</a>

