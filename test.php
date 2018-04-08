<?php include('header.php'); ?>
<?php include('securityHeader.php'); ?>
<?php include('returnLink.php'); ?>

<?php
include('settings.php');

submitQuestion();
function submitQuestion() {
	echo $_SESSION["teamNumber"];
}
?>
