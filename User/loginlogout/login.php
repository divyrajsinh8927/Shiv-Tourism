<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/font-awesome.min.css">
  <!-- swiper css link  -->
  <link rel="stylesheet" href="../../css/swiper-bundle.min.css" />

  <!-- font awesome cdn link  --> 
  <link rel="stylesheet" href="../../css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="../../css/animate.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/login.css">
  <link rel="stylesheet" href="../../css/styles.css">
  <!--bootstrap.css-->
  <script src="../../js/6be23040d4.js"></script>  
</head>

<body>

  <!-- header section starts  -->
  <nav>
    <div class="menu-icon">
      <span class="fas fa-bars"></span>
      <div class="cancel-icon">
        <span class="fas fa-times"></span>
      </div>
    </div>
    <div class="logo">
      <img src="../../images/1.png" alt="" style="padding-top: -10px;">
    </div>
    <div class="nav-items">
      <li><a href="../home/index.php">Home</a></li>
      <li><a href="../about/index.php">Aboout Us</a></li>
      <li><a href="../places/index.php">Places</a></li>
      <li><a href="../hotels/index.php">Hotels</a></li>
      <?php
      if (isset($_SESSION['hotel'])) {
      ?>
        <li><a href="../hotelsmanagement/bookingmanage.php">BookingManage</a></li>
      <?php
      } else {
      ?>
        <li><a href="../Booking/index.php">Booking</a></li>
      <?php
      }
      $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
      if(isset($_SESSION['user']))
      {
        header("Location: ../home/index.php");
      } elseif (isset($_SESSION['hotel'])) {
        header("Location: ../home/index.php");
      } elseif(isset($_SESSION['Admin'])){
  header("Location: ../../Admin/index.php");  
      }
     ?>
    </div>

  </nav>
  </div>
  <!-- </section> -->
<body>
  <section class="container2 forms">
    <div class="form login">
      <div class="form-content">
        <header>Login</header>
        <form action="./loginprocess.php" method="POST" class="loginform">
          <div class="field input-field">
            <input type="email" placeholder="Email" class="input" name="email" id="email" required>
          </div>

          <div class="field input-field">
            <input type="password" placeholder="Password" class="password" name="loginpassword" id="loginpassword" required>
            <i onclick="$('#hide').toggle(); $(this).hide();$('#loginpassword').attr('type', 'text');" id="show" style="font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye eye-icon'></i>
            <i onclick="$('#show').toggle(); $(this).hide();$('#loginpassword').attr('type', 'password');" id="hide" style="display : none;font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye-slash eye-icon'></i>
          </div>

          <div class="field button-field">
            <button type="submit" name="loginbutton">Login</button>
          </div>
        </form>
        <div class="line"></div>

        <div class="form-link">
          <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
        </div>
       
      </div>


    </div>

    <!-- Signup Form -->

    <div class="form signup">
      <div class="form-content">
        <header>Signup</header>
        <form action="./loginprocess.php" method="POST" onSubmit="return checkPassword(this)" class="loginform">

          <div class="field input-field">
            <input type="text" placeholder="Name" class="input" name="NAME" require>
          </div>

          <div class="field input-field">
            <input type="number" placeholder="Mobial No" class="input" name="MOBILENO" require>
          </div>

          <div class="field input-field">
            <input type="email" placeholder="Email" class="input" name="EMAIL" require>
          </div>

          <div class="field input-field">
            <input type="password" placeholder="Create password" class="password" name="PASSWORD1" require>
          </div>

          <div class="field input-field">
            <input type="password" placeholder="Confirm password" class="password" name="PASSWORD2" require>
          </div>

          <div class="field button-field">
            <button name="signupbutton">Signup</button>
          </div>
        </form>

        <div class="line"></div>
        <div class="form-link">
          <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
        </div>
      </div>

    </div>
  </section>
  <!-- JavaScript -->
  <script>
    function checkPassword(form) {
      password1 = form.PASSWORD1.value;
      password2 = form.PASSWORD2.value;

      // If password not entered
      if (password1 == '')
        alert("Please enter Password");

      // If confirm password not entered
      else if (password2 == '')
        alert("Please enter confirm password");

      // If Not same return False.    
      else if (password1 != password2) {
        alert("\nPassword did not match: Please try again...")
        return false;
      }
    }
  </script>
  <?php
  include("../home/footer.php");
  ?>