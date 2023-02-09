<div class="heading" style="background:url(../../images/header-bg-1.png) no-repeat">
   <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="padding-top: 0px; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-weight: bolder;">About Us</h1>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="image">
      <img src="../../images/about-img.jpg" alt="">
   </div>

   <div class="content">
      <h3>Why choose us?</h3>
      <p>Provide a best facality and instant respons for few hour in customer<br>
         We Provide Best Tour Packages In Your Budget </p>
      <h3>Our services</h3>
      <p>our tourisem business is a Top 5 in All india and achive NATIONAL TOURISM AWARDS 2009-10.
         we are provide booking hotel in india and show different typs of package in all of the world.
         for customer setisfaction we provide direct information for hotel and also include show hotel photo.
         every customer show package photo and deatil.
      </p>
      <h3>Best Servicess</h3>
      <div class="icons-container">
         <div class="icons">
            <i class="fas fa-hotel"></i>
            <span>Top Hotels</span>
         </div>
         <div class="icons">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Affordable price</span>
         </div>
         <div class="icons">
            <i class="fas fa-headset"></i>
            <span>24/7 service</span>
         </div>
         <div class="icons"><a href="./client-review.php">
               <i class="fas fa-solid fa-comments"></i>
               <span>Share Your review</span></a>
         </div>
      </div>
   </div>

</section>

<!-- about section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="heading-title"> What People Say </h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">
         <?php
         $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
         $statementreview = $pdo->prepare("SELECT * from client_reiviws");
         $statementreview->execute();
         while($row = $statementreview->fetch()){
         ?>
         <div class="swiper-slide slide">
            <?php
            $star = $row['Stars'];
            ?>
            <div class="stars">
               <?php
               for($i=0;$i<$star;$i++)
               {
               ?>
               <i class="fas fa-star"></i>
            <?php
            }
            ?>
            </div>
            <p><?=$row['Reviews'];?></p>
            <?php
               $userid=$row['User_id'];
               $statementuser = $pdo->prepare("SELECT * from users WHERE Id=?");
               $statementuser->execute(array($userid));
               $userrow=$statementuser->fetch();
            ?>
            <h4><?=$userrow['Name'];?></h4>
            <span>traveler</span>
            <img src="../../images/pic-1.png" alt="">
         </div>
<?php
         }
?>
         <!-- <div class="swiper-slide slide">
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <p>Great package and good follow up.
Critical travel info does get lost with all of the other marketing info so I deleted it and then had to get it sent again as it wasn't just marketing.
Very happy and hope there are more all included deals available.</p>
            <h4>Abhay</h4>
            <span>traveler</span>
            <img src="../../images/pic-3.png" alt="">
         </div> -->
      </div>

   </div>

</section>

<!-- reviews section ends -->