<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
if (isset($_POST['addplace'])) {
    $file_name = $_FILES['placeimage']['name'];
    $file_tmp_name = $_FILES['placeimage']['tmp_name'];
    $path="../../images/".$file_name;
    $placename = $_POST['placename'];
    $city_id = $_POST['citys'];
    $detail = $_POST['detail'];
    $statementplace = $pdo->prepare("INSERT INTO places(PlaceName,City_id,Discription,Imagepath) VALUES(?,?,?,?)");
    $statementplace->execute(array($placename, $city_id,$detail,$file_name));
    if($statementplace)
    {
        move_uploaded_file($file_tmp_name,$path);
        $message = 'Place Added Successfully!.';
        echo "<SCRIPT>alert('$message');window.location.replace('../placesmanagement.php');</SCRIPT>";
    }
}
if (isset($_POST['addhotel'])) {
    $hfile_name = $_FILES['hotelimage']['name'];
    $hfile_tmp_name = $_FILES['hotelimage']['tmp_name'];
    $hpath="../../images/".$hfile_name;
    $placename = $_POST['hotelname'];
    $pdprice = $_POST['pdprice'];
    $city_id = $_POST['citys'];
    $userid = $_POST['User'];
    $detail = $_POST['detail'];
    $statementhotel = $pdo->prepare("INSERT INTO hotels(HotelName,PerDayPrice,City_id,Hoteldetail,Imagespath,User_id) VALUES(?,?,?,?,?,?)");
    $statementhotel->execute(array($placename, $pdprice, $city_id, $detail,$hfile_name,$userid));
    if($statementhotel)
    {
        move_uploaded_file($hfile_tmp_name,$hpath);
        $message = 'Hotel Added Successfully!.';
        echo "<SCRIPT>alert('$message');window.location.replace('../hotelsmanagement.php');</SCRIPT>";
    }
}
if (isset($_SESSION['Admin'])) {
    if (isset($_POST['adduser'])) {
        $name = $_POST['NAME'];
        $mobile = $_POST['MOBILENO'];
        $email = $_POST['EMAIL'];
        $password1 = $_POST['PASSWORD1'];
        $password2 = $_POST['PASSWORD2'];
        $status=1;
        $usertype = $_POST['usertype'];
        if ($password1 == $password2) {
          $statement = $pdo->prepare("INSERT INTO users(Name,MobileNo,UserType,Email,Password,status) values(?,?,?,?,?,?)");
          $statement->execute(array($name, $mobile, $usertype, $email, $password1,$status));
          $message = 'User Added Successfully!.';
    echo "<SCRIPT>alert('$message');window.location.replace('../index.php');</SCRIPT>";
        }
    }
}
?>