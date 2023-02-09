<?php
$pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");

if (isset($_GET['country_id'])) {
	$selectstate = $pdo->prepare("SELECT * FROM states where Country_id=" . $_GET['country_id']);
	$selectstate->execute();
	if ($selectstate->rowCount() > 0) {
		echo '<option value="">Select State</option>';
		while ($row = $selectstate->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value=' . $row['Id'] . '>' . $row['StateName'] . '</option>';
		}
	} else {

		echo '<option>No State Found!</option>';
	}
} elseif (isset($_GET['State_id'])) {
	$selectcity = $pdo->prepare("SELECT * FROM city where State_id=" . $_GET['State_id']);
	$selectcity->execute();
	if ($selectcity->rowCount() > 0) {
		echo '<option value="">Select City</option>';
		while ($row = $selectcity->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value=' . $row['Id'] . '>' . $row['CityName'] . '</option>';
		}
	} else {

		echo '<option>No City Found!</option>';
	}
} elseif (isset($_GET['city_id'])) {
	$selecthotel = $pdo->prepare("SELECT * FROM hotels where City_id=" . $_GET['city_id']);
	$selecthotel->execute();
	if ($selecthotel->rowCount() > 0) {
		echo '<option value="">Select Hotel</option>';
		while ($row = $selecthotel->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value=' . $row['Id'] . '>' . $row['HotelName'] . '</option>';
		}
	} else {

		echo '<option>No Hotel Found!</option>';
	}
} elseif (isset($_GET['hotel_id'])) {
	$selectprise = $pdo->prepare("SELECT * FROM hotels where Id=" . $_GET['hotel_id']);
	$selectprise->execute();
	if ($selectprise->rowCount() > 0) {
		$row = $selectprise->fetch(PDO::FETCH_ASSOC);
		echo $row['PerDayPrice'];
	} else {

		echo '0';
	}
} elseif (isset($_GET['diffDays'])) {
	echo $_GET['diffDays'];
} elseif (isset($_GET['totalprice'])) {
	echo $_GET['totalprice'];
}
