<div class="heading" style="background:url(../../images/header-bg-3.png) no-repeat">
   <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="padding-top: 0px; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-weight: bolder;">Hotels</h1>
</div>

<!-- packages section starts  -->

<section class="packages">

   <h1 class="heading-title">Hotels</h1>

   <div class="box-container">
      <?php
      $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
      $statementhotel = $pdo->prepare("SELECT * FROM hotels");
      $statementhotel->execute();
      while ($hotelrow = $statementhotel->fetch()) {
         if ($hotelrow['hotel_delete'] == 0) {
      ?>
            <div class="box">
               <div class="image">
                  <?php
                  ?>
                  <img src="../../images/<?= $hotelrow['Imagespath']; ?>" alt="">
               </div>
               <div class="content">
                  <?php
                  $statementhotelcity = $pdo->prepare("SELECT * FROM city where Id=" . $hotelrow['City_id']);
                  $statementhotelcity->execute();
                  $hotelcity = $statementhotelcity->fetch();
                  ?>
                  <h3><?= $hotelrow['HotelName']; ?></h3>
                  <h4 id="cityofhotel"><?= $hotelcity['CityName']; ?></h4>
                  <a href="./hoteldetails.php?id=<?= $hotelrow['Id'] ?>" class="btn">View More</a>
               </div>
            </div>
      <?php
         }
      }
      ?>
   </div>
</section>