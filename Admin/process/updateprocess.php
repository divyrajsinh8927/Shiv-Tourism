<?php
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
if (isset($_POST['Updateplace'])) {
    $id = $_GET['id'];
    $file_name = $_FILES['placeimage']['name'];
    $file_tmp_name = $_FILES['placeimage']['tmp_name'];
    $path="../../images/".$file_name;
    $placename = $_POST['placename'];
    $city_id = $_POST['citys'];
    $detail = $_POST['detail'];
    $statementplace = $pdo->prepare("UPDATE places SET PlaceName=?,City_id=?,Discription=?,Imagepath=? WHERE ID=?");
    $statementplace->execute(array($placename, $city_id, $detail, $file_name, $id));
    if($statementplace)
    {
        move_uploaded_file($file_tmp_name,$path);
        $message = 'Place Updated Successfully!.';
        echo "<SCRIPT>alert('$message');window.location.replace('../placesmanagement.php');</SCRIPT>";
    }
}
if (isset($_POST['Updatehotel'])) {
    $id = $_GET['id'];
    $hfile_name = $_FILES['hotelimage']['name'];
    $hfile_tmp_name = $_FILES['hotelimage']['tmp_name'];
    $hpath="../../images/".$hfile_name;
    $hotelname = $_POST['hotelname'];
    $pdprice = $_POST['pdprice'];
    $city_id = $_POST['citys'];
    $detail = $_POST['detail'];
    $statementhotel = $pdo->prepare("UPDATE hotels SET HotelName=?,PerDayPrice=?,City_id=?,Hoteldetail=?,Imagespath=? WHERE ID=?");
    $statementhotel->execute(array($hotelname, $pdprice, $city_id, $detail, $hfile_name, $id));
    if($statementhotel)
    {
        move_uploaded_file($hfile_tmp_name,$hpath);
        $message = 'Hotel Updated Successfully!.';
        echo "<SCRIPT>alert('$message');window.location.replace('../hotelsmanagement.php');</SCRIPT>";
    }
}
?>