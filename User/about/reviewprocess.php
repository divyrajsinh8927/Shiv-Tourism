<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
if(isset($_POST['reviews'])){
if (isset($_SESSION['user'])) {
    // get current logged in user   
    $logedInUseremail = $_SESSION['user'];
    $statementid = $pdo->prepare("SELECT Id from users where Email=?");
    $statementid->execute(array($logedInUseremail));
    $logedInUserid = $statementid->fetch();
    $userid = $logedInUserid['Id'];
    $review=$_POST['review'];
    $star=$_POST['rating'];
    $statementbook = $pdo->prepare("INSERT INTO client_reiviws(User_id,Reviews,Stars) VALUES(?,?,?)");
    $statementbook->execute(array($userid,$review,$star));
    header("Location: ./index.php");
} else {
    echo "<script> window.location.href = './index.php'; alert('To Book Hotel Login First');</script>";
}
}
?>