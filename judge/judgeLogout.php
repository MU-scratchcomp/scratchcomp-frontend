<?php
session_start();
unset($_SESSION['login']);
session_destroy();
echo "<p>You have been logged out.";
?>
