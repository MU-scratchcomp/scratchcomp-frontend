<?php
session_start();
unset($_SESSION['teamlogin']);
session_unset();
session_destroy();
echo "<p>You have been logged out.";
echo "<p><a href=\"login.php\">Login</a>";
?>
