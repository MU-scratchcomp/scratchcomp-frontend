<?php
session_start();
unset($_SESSION['judgeLogin']);
session_destroy();
echo "<p>You have been logged out.";
?>
