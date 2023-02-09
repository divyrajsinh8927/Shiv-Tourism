
<?php
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
$bookid = $_GET['bookid'];

$statementbook = $pdo->prepare("UPDATE booking SET cancle_booking=? WHERE id=?");
$statementbook->execute(array(1,$bookid));
header("Location: ./bookinghistory.php");
?>