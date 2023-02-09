<?php
session_start();
unset($_SESSION["Admin"]);
header("Location: ../../User/home/index.php");
?>