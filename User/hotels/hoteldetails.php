<?php
include("../home/header.php");
?>
<?php
$id = $_GET['id'];
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
$statementhotel = $pdo->prepare("SELECT * FROM hotels WHERE Id=$id");
$statementhotel->execute();
while ($hotelrow = $statementhotel->fetch()) {
	$cityid = $hotelrow['City_id'];
	$statementcity = $pdo->prepare("SELECT * FROM city WHERE Id=$cityid");
	$statementcity->execute();
	$cityrow = $statementcity->fetch();
	$stateid = $cityrow['State_id'];
	$statementstate = $pdo->prepare("SELECT * FROM states WHERE Id=$stateid");
	$statementstate->execute();
	$staterow = $statementstate->fetch();
	$countryid = $staterow['Country_id'];
?>
	<div class="heading" style="background:url(../../images/5.jpg) no-repeat">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="padding-top: 0px; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-weight: bolder;"><?= $hotelrow['HotelName']; ?> Details</h1>
	</div>
	<!--- /banner ---->
	<!--- selectroom ---->
	<div class="selectroom">
		<div class="container">

			<form name="book" method="post">
				<div class="selectroom_top">
					<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
						<img src="../../images/<?= $hotelrow['Imagespath']; ?>" class="img-responsive" alt="" style="padding-top: 35px">
					</div>
					<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
						<h2></h2>
						<p class="dow">&nbsp;</p>
						<h1><?= $hotelrow['HotelName']; ?></h1>
						<?php
						$statementcountry = $pdo->prepare("SELECT * FROM country where Id=$countryid");
						$statementcountry->execute();
						$hotelcountry = $statementcountry->fetch();
						?>
						<p style="font-size: 20px; font-weight: bolder;">Country : <?= $hotelcountry['CountryName']; ?> </p>
						<p style="font-size: 20px; font-weight: bolder;">City : <?= $cityrow['CityName']; ?> </p><br><br><br><br><br>
						<div class="grand">
							<p style="font-size: 20px;">PerDay Price :</p>
							<h3><?= $hotelrow['PerDayPrice']; ?>&nbsp;&nbsp;Rs.</h3>
						</div>
					</div>
					<h1 style="text-justify: inter-word; text-decoration: wavy; padding-top: 0px;">Details About <?= $hotelrow['HotelName']; ?> :</h1>
					<p style="padding-top: 1%; font-size: x-large; font-weight: bolder; text-align: justify; text-justify: inter-word; padding-left: 10px;"><?= $hotelrow['Hoteldetail']; ?></p>
				</div>
			<?php
		}
			?>
			</form>
			<?php
			if (!isset($_SESSION['hotel'])) {
				if(isset($_SESSION['user']))
				{
			?>
				<div class="clearfix">
					<a href="../Booking/content.php?id=<?= $id ?>" class="btn">Book</a>
				</div>
			<?php
				}
			}
			?>
		</div>
	</div>
	<?php
	include("../home/footer.php");
	?>