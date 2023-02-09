<?php
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
$id=$_GET['id'];
            $statementbook = $pdo->prepare("SELECT * FROM booking WHERE Id=?");
            $statementbook->execute(array($id));
            $rowbook = $statementbook->fetch();
            $status=$rowbook['status'];
if ($status == 0) {
    $statement = $pdo->prepare("UPDATE booking SET status=? WHERE Id=?");
    $statement->execute(array(1,$id));
    header("Location: ./bookingmanage.php");
}
?>