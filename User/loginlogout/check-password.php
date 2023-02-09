<?php
include("../home/header.php");
if(isset($_SESSION['user']))
{
  $email=$_SESSION['user'];
}
else if(isset($_SESSION['hotel']))
{
  $email=$_SESSION['hotel'];
}
?>
  <section class="container2 forms" style="padding-top: 150px;">
    <div class="form login">
      <div class="form-content">
        <header>Confirm Password</header>
        <form action="./loginprocess.php" method="POST" class="loginform">
          <div class="field input-field">
            <input type="email" placeholder="Email" class="input" name="email" id="email" value="<?=$email?>">
          </div>

          <div class="field input-field">
            <input type="password" placeholder="Old Password" class="password" name="loginpassword" id="loginpassword">
            <i onclick="$('#hide').toggle(); $(this).hide();$('#loginpassword').attr('type', 'text');" id="show" style="font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye eye-icon'></i>
            <i onclick="$('#show').toggle(); $(this).hide();$('#loginpassword').attr('type', 'password');" id="hide" style="display : none;font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye-slash eye-icon'></i>
          </div>
          <div class="field button-field">
            <button type="submit" name="confirmpassword">Confirm</button>
          </div>
        </form>
      </div>
    </div>
    </section>
    <?php
  include("../home/footer.php");
  ?>