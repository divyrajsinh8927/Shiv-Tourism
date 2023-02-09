<div class="heading" style="background:url(../../images/header-bg-2.png) no-repeat">
   <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="padding-top: 0px; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-weight: bolder;">Places</h1>
</div>

<!-- packages section starts  -->

<section class="packages">

   <h1 class="heading-title">top destinations</h1>

   <div class="box-container">
      <?php
      $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
      $statementplace = $pdo->prepare("SELECT * FROM places");
      $statementplace->execute();
      while ($placerow = $statementplace->fetch()) {
         if ($placerow['place_delete'] == 0) {
      ?>
            <div class="box">
               <div class="image">
                  <img src="../../images/<?= $placerow['Imagepath']; ?>" alt="">
               </div>
               <div class="content">
               <?php
                  $statementplacecity = $pdo->prepare("SELECT * FROM city where Id=" . $placerow['City_id']);
                  $statementplacecity->execute();
                  $placecity = $statementplacecity->fetch();
                  ?>
                  <h3><?= $placerow['PlaceName']; ?></h3>
                  <h4 id="cityofhotel"><?= $placecity['CityName']; ?></h4>
                  <a href="placedetails.php?id=<?= $placerow['Id'] ?>"><button class="btn">View More</button></a>
               </div>
            </div>
      <?php
         }
      }
      ?>
   </div>
</section>