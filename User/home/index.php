<?php
include("./header.php");
?>
<!-- home section starts  -->

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(../../images/home-slide-1.webp)">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>travel arround the world</h3>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(../../images/home-slide-2.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>discover the new places</h3>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(../../images/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>make your tour worthwhile</h3>
            </div>
         </div>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<!-- home section ends -->

<section class="home-packages">

   <h1 class="heading-title">Places</h1>
   <div class="box-container">
      <?php
      $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
      $statementplace = $pdo->prepare("SELECT * FROM places LIMIT 3");
      $statementplace->execute();
      while ($placerow = $statementplace->fetch()) {
      ?>

         <div class="box">
            <div class="image">
               <img src="../../images/<?= $placerow['Imagepath']; ?>" alt="">
            </div>
            <div class="content">
               <h3><?= $placerow['PlaceName']; ?></h3>
               <?php
                  $statementplacecity = $pdo->prepare("SELECT * FROM city where Id=" . $placerow['City_id']);
                  $statementplacecity->execute();
                  $placecity = $statementplacecity->fetch();
                  ?>
               <h4 id="cityofhotel"><?= $placecity['CityName']; ?></h4>
               <a href="../places/placedetails.php?id=<?= $placerow['Id'] ?>" class="btn">View</a>
            </div>
         </div>
      <?php
      }
      ?>
   </div>
   <div class="load-more"> <a href="../places/" class="btn">View All</a> </div>
</section>

<section class="home-packages">

   <h1 class="heading-title">Hotels</h1>
   <div class="box-container">
      <?php
      $statementhotel = $pdo->prepare("SELECT * FROM hotels LIMIT 3");
      $statementhotel->execute();
      while ($hotelrow = $statementhotel->fetch()) {
      ?>

         <div class="box">
            <div class="image">
               <img src="../../images/<?= $hotelrow['Imagespath']; ?>" alt="">
            </div>
            <div class="content">
               <h3><?= $hotelrow['HotelName']; ?></h3>
               <?php
                  $statementhotelcity = $pdo->prepare("SELECT * FROM city where Id=" . $hotelrow['City_id']);
                  $statementhotelcity->execute();
                  $hotelcity = $statementhotelcity->fetch();
                  ?>                
                    <h4 id="cityofhotel"><?= $hotelcity['CityName']; ?></h4>
               <a href="../hotels/hoteldetails.php?id=<?= $hotelrow['Id']?>" class="btn">View More</a>
            </div>
         </div>
      <?php
      }
      ?>
   </div>
   <div class="load-more"> <a href="../hotels/index.php" class="btn">View All</a> </div>
</section>

<section class="home-about">

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
   </div>

</section>
<?php
include("./footer.php");
?>