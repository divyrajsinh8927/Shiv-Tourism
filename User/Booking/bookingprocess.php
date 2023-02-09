<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
if(isset($_POST['send'])){
if (isset($_SESSION['user'])) {
    // get current logged in user   
    $logedInUseremail = $_SESSION['user'];
    $statementid = $pdo->prepare("SELECT Id from users where Email=?");
    $statementid->execute(array($logedInUseremail));
    $logedInUserid = $statementid->fetch();
    $userid = $logedInUserid['Id'];
    $hotelid = $_POST['Hotels'];
    $bookingdate = date('Y-m-d', strtotime($_POST['bookingdate']));
    $arrivaldate = date('Y-m-d', strtotime($_POST['arrivaldate']));
    $leavingdate = date('Y-m-d', strtotime($_POST['leavingdate']));
    $totalrooms = $_POST['totalrooms'];
    $totaldays = $_POST['totalday'];
    $totalprice = $_POST['totalprice'];
    $statementbook = $pdo->prepare("INSERT INTO booking(User_id,Hotel_id,BookingDate,ArrivalDate,LeavingDate,TotalDays,TotalRooms,TotalPrice) VALUES(?,?,?,?,?,?,?,?)");
    $statementbook->execute(array($userid, $hotelid, $bookingdate, $arrivaldate, $leavingdate, $totaldays, $totalrooms, $totalprice));
    header("Location: ./bookinghistory.php");
} else {
    echo "<script> window.location.href = './index.php'; alert('To Book Hotel Login First');</script>";
}
}
?>