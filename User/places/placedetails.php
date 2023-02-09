<?php
include("../home/header.php");
?>
<?php
$id = $_GET['id'];
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
$statementplace = $pdo->prepare("SELECT * FROM places WHERE Id=$id");
$statementplace->execute();
while ($placerow = $statementplace->fetch()) {
	$cityid = $placerow['City_id'];
?>
		<div class="heading" style="background:url(../../images/header-bg-2.png) no-repeat">
			<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="padding-top: 0px; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-weight: bolder;"><?= $placerow['PlaceName']; ?> Details</h1>
		</div>
	
	<!--- selectroom ---->
	<div class="selectroom">
		<div class="container">

			<form name="book" method="post">
				<div class="selectroom_top">
					<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
						<img src="../../images/<?= $placerow['Imagepath']; ?>" class="img-fluid" alt="" style="padding-top: 35px;">
					</div>
					<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
						<h2></h2>
						<p class="dow">&nbsp;</p>
						<h1 style="padding-left: 10px; font-size: 40px"><?= $placerow['PlaceName']; ?></h1>
						<?php
						$statementcity = $pdo->prepare("SELECT * FROM city where Id=?");
						$statementcity->execute(array($cityid));
						$placecity = $statementcity->fetch();
						$stateid = $placecity['State_id'];
						$statementstate = $pdo->prepare("SELECT * FROM states where Id=?");
						$statementstate->execute(array($stateid));
						$placestate = $statementstate->fetch();
						$countryid = $placestate['Country_id'];
						
						$statementcountry = $pdo->prepare("SELECT * FROM country where Id=$countryid");
						$statementcountry->execute();
						$placecountry = $statementcountry->fetch();
						?>
						<p style="font-size: 30px; font-weight: bolder; padding-left: 10px;">Country : <?= $placecountry['CountryName']; ?> </p>
						<p style="font-size: 30px; font-weight: bolder; padding-left: 10px;">City : <?= $placecity['CityName']; ?> </p>
						<div class="grand">
							<p>&nbsp;</p>
							<h3>&nbsp; </h3>
						</div>
					</div>
					<h1 style="text-justify: inter-word;">Details About <?= $placerow['PlaceName']; ?> :</h1>
					<p style="padding-top: 1%; font-size: large; font-weight: bolder; text-align: justify; text-justify: inter-word; padding-left: 10px;"><?= $placerow['Discription']; ?></p>
					<div class="clearfix"></div>
				</div>
			<?php
		}
			?>
			</form>


		</div>
	</div>
	<?php
	include("../home/footer.php");
	?>