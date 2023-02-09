<?php
include("../home/header.php");
?>

<body>
    <section class="container2 forms">
        <div class="form login">
            <div class="form-content">
                <header>Change Password</header>
                <form action="#" method="POST" class="loginform">
                    <input type="hidden" name="id" value="<?=$_GET['id'];?>">
                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password" name="newpassword" id="loginpassword">
                        <i onclick="$('#hide').toggle(); $(this).hide();$('#loginpassword').attr('type', 'text');" id="show" style="font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye eye-icon'></i>
                        <i onclick="$('#show').toggle(); $(this).hide();$('#loginpassword').attr('type', 'password');" id="hide" style="display : none;font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye-slash eye-icon'></i>
                    </div>
                    <div class="field input-field">
                        <input type="password" placeholder="Confirm  Password" class="password" name="confirmpassword" id="loginpassword">
                        <i onclick="$('#hide').toggle(); $(this).hide();$('#loginpassword').attr('type', 'text');" id="show" style="font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye eye-icon'></i>
                        <i onclick="$('#show').toggle(); $(this).hide();$('#loginpassword').attr('type', 'password');" id="hide" style="display : none;font-size: 20px; cursor: pointer; color: black; margin:4px;" class='fa fa-solid fa-eye-slash eye-icon'></i>
                    </div>

                    <div class="field button-field">
                        <button type="submit" name="changepassword">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
        <?php   
        //change Password

if (isset($_POST['changepassword'])) {
    $loginpass = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $id=$_POST['id'];
    if($loginpass == $confirmpassword)
    {
    $statement = $pdo->prepare("UPDATE users SET Password=? WHERE Id =?");
    $statement->execute(array($loginpass,$id));
    echo "<script>window.location.href='../home/index.php';alert('Password Changed Successfuly!');</script>";
  }
    else{
      echo "<script>window.location.href='/change-password.php?id=$id';alert('Password Doesn't match!');</script>";
    }
  }
        include("../home/footer.php");
        ?>