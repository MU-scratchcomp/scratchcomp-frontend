<?php
session_start();
unset($_SESSION['teamlogin']);
unset($_SESSION['teamNumber']);
session_destroy();
echo "<p>You have been logged out.";
?>
