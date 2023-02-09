<?php
include("../home/header.php");
?>
<style>
    .rating {
display: flex;
flex-direction: row-reverse;
justify-content: left;
}

.rating > input{
 display:none;
}

.rating > label {
position: relative;
width: 1.1em;
font-size: 7vw;
color: goldenrod;
cursor: pointer;
}

.rating > label::before{
content: "\2605";
position: absolute;
opacity: 0;
}

.rating > label:hover:before,
.rating > label:hover ~ label:before {
opacity: 1 !important;
}

.rating > input:checked ~ label:before{
opacity:1;
}

.rating:hover > input:checked ~ label:before{ 
opacity: 0.4;
 }
</style>
<div class="heading" style="background:url(../../images/header-bg-3.png) no-repeat">
<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="padding-top: 0px; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-weight: bolder;">Client Reviews</h1>
</div>

<!-- booking section starts  -->
<section class="booking">

    <!-- <h1 class="heading-title">Client Review</h1> -->

    <form action="reviewprocess.php" method="post" class="book-form">
        <div class="flex">
            <div class="inputBox">
                <span>User :</span>
                <?php
                if (isset($_SESSION['user'])) {
                    // get current logged in user   
                    $logedInUseremail = $_SESSION['user'];
                    $statementuser = $pdo->prepare("SELECT * from users where Email=?");
                    $statementuser->execute(array($logedInUseremail));
                    while ($logedInUsername = $statementuser->fetch()) {
                        $currentusername = $logedInUsername['Name'];
                    }
                } else {
                    $currentusername = "Log_In First";
                }

                ?>
                <input type="text" value="<?= $currentusername ?>" id="user" disabled readonly>
            </div>

            <!-- <div class="inputBox">
            </div><br> -->



        </div><br>
        <div class="inputBox" style=" padding-top: 20px;">
            <span style="font-size: 15px;">Your Review :</span><br>
            <textarea name="review" id="" style="width: 100%;" rows="10" style="border-width: 5px;"></textarea>
        </div><br>
        <div class="rating">
            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
        </div>
        <input type="submit"  class="btn" name="reviews" style="float: right;">
    </form>
</section>
<?php
include("../home/footer.php");
?>