
<?php
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
$id = $_GET['id'];

$statement = $pdo->prepare("UPDATE booking SET status=? WHERE Id=?");
    $statement->execute(array(0,$id));
    header("Location: ./bookingmanage.php");
?>