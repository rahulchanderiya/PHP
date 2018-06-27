<?php
session_start();

$message = $_SESSION['message'];
$link = $_SESSION['link'];

echo '<script type="text/javascript">alert("'.$message.'"); window.location.href="'.$link.'";</script>';

?>