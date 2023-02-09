<?php

session_start();
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
if (isset($_POST['loginbutton'])) {
  $email = $_POST['email'];
  $password = $_POST['loginpassword'];
  $statement = $pdo->prepare("SELECT * from users where Email=? and Password=?");
  $statement->execute(array($email, $password));

  while ($record = $statement->fetch()) {
    $usertype = $record['UserType'];
    $status = $record['status'];
    $delete=$record['user_delete'];
  }
  $row = $statement->rowcount();

  if($email=="" && $password)
  {
    
  }

  if ($row > 0) {
    if($delete == 0){
    if($status != 0){
      if ($usertype == 'A') {
      $_SESSION['Admin'] = $email;
      header("Location: ../../Admin/index.php");
      }
      elseif( $usertype == 'H')
      {
        $_SESSION['hotel'] = $email;
        header("Location: ../hotelsmanagement/bookingmanage.php");
      }
      
      else {
         $_SESSION['user'] = $email;
      header("Location: ../home/index.php");
    }
  } else {
    echo "<script>window.location.href='./login.php'; alert('User Deactivated');</script>";
  }
}
else
{
  echo "<script>window.location.href='./login.php';alert('User Deleted!');</script>";
}
}
else{
  echo "<script>window.location.href='./login.php';alert('wrong UserName Or Password or Password');</script>";
}
}

//Register
if (isset($_POST['signupbutton'])) {
  $name = $_POST['NAME'];
  $mobile = $_POST['MOBILENO'];
  $email = $_POST['EMAIL'];
  $password1 = $_POST['PASSWORD1'];
  $password2 = $_POST['PASSWORD2'];
  $status=1;
  $usertype = "U";
  if ($password1 == $password2) {
    $statement = $pdo->prepare("INSERT INTO users(Name,MobileNo,UserType,Email,Password,status) values(?,?,?,?,?,?)");
    $statement->execute(array($name, $mobile, $usertype, $email, $password1,$status));
    echo "<script>window.location.href='./login.php';alert('user registered successfully');</script>";
  }
}



//change password

if (isset($_POST['confirmpassword'])) {
  $email = $_POST['email'];
  $password = $_POST['loginpassword'];
  $statement = $pdo->prepare("SELECT Id,UserType,Email,Password,status from users where Email=? and Password=?");
  $statement->execute(array($email, $password));
  while ($record = $statement->fetch()) {
    $usertype = $record['UserType'];
    $status = $record['status'];
    $id=$record['Id'];
  }
  $row = $statement->rowCount();
  if ($row > 0) {
        header("Location: ./change-password.php?id=$id");
  }
  else{
    echo "<script>window.location.href='./check-password.php';alert('wrong UserName Or Password or Password');</script>";
  }
}


