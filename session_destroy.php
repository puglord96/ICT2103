<?php
session_start();
session_destroy();
header("Location: http://localhost/2103project/login.php"); 
exit();
?>  