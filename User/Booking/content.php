<?php
if (isset($_GET['id'])) {
    include('../home/header.php');
    $id = $_GET['id'];
    $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
    $statementhotel = $pdo->prepare("SELECT * FROM hotels WHERE Id=$id");
    $statementhotel->execute();
    $hotelrow = $statementhotel->fetch();
    $cityid = $hotelrow['City_id'];
    $statementcity = $pdo->prepare("SELECT * FROM city WHERE Id=$cityid");
    $statementcity->execute();
    $cityrow = $statementcity->fetch();
    $stateid = $cityrow['State_id'];
    $statementstate = $pdo->prepare("SELECT * FROM states WHERE Id=$stateid");
    $statementstate->execute();
    $staterow = $statementstate->fetch();
    $countryid = $staterow['Country_id'];
    $statementcountry = $pdo->prepare("SELECT * FROM country WHERE Id=$countryid");
    $statementcountry->execute();
    $countryrow = $statementcountry->fetch();
    $countryid = $staterow['Country_id'];
?>
    <div class="heading" style="background:url(../../images/header-bg-3.png) no-repeat">
    <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="padding-top: 0px; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-weight: bolder;">Book Now</h1>
    </div>

    <!-- booking section starts  -->
    <section class="booking">

        <h1 class="heading-title">book your Hotel!</h1>

        <form action="bookingprocess.php" method="post" class="book-form">
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
                <div class="inputBox">
                    <span>country :</span>
                    <select onchange="country(this.id)" class="combo" name="countrys" id="country" required>
                        <option value="<?= $countryid ?>"><?= $countryrow['CountryName']; ?></option>
                        <?php
                        $statement = $pdo->prepare("SELECT * FROM country");
                        $statement->execute();
                        while ($row = $statement->fetch()) {
                        ?>
                            <option value="<?= $row['Id']; ?>"><?= $row['CountryName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>State :</span>
                    <select onchange="state(this.id)" class="combo" name="State" id="state" required>
                        <option value="<?= $stateid ?>"><?= $staterow['StateName']; ?></option>
                        <?php
                        $bookstate = $pdo->prepare("SELECT * FROM States");
                        $bookstate->execute();
                        while ($selctstate = $bookstate->fetch()) {
                        ?>
                            <option value="<?= $selctstate['Id']; ?>"><?= $selctstate['StateName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <select class="combo" name="city" id="citys" required>
                        <option value="<?= $cityid ?>"><?= $cityrow['CityName']; ?></option>
                        <?php
                        $bookcity = $pdo->prepare("SELECT * FROM city");
                        $bookcity->execute();
                        while ($selectcity = $bookcity->fetch()) {
                        ?>
                            <option value="<?= $selectcity['Id']; ?>"><?= $selectcity['CityName'] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="inputBox">
                    <span>Hotel :</span>
                    <select onchange="hotel(this.id)" class="combo" name="Hotels" id="hotel" required>
                        <option value="<?= $hotelrow['Id']; ?>"><?= $hotelrow['HotelName']; ?></option>
                        <?php
                        $bookhotel = $pdo->prepare("SELECT * FROM hotels");
                        $bookhotel->execute();
                        while ($selecthotel = $bookhotel->fetch()) {
                        ?>
                            <option value="<?= $selecthotel['Id']; ?>"><?= $selecthotel['HotelName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Perday Rent :</span>
                    <input type="text" id="perdayprice" value="" readonly style="background-color: transparent;">
                </div>
                <div class="inputBox">
                    <span>Number Of Rooms :</span>
                    <input type="number" name="totalrooms" id="numberofroom" required>
                </div>
                <div class="inputBox">
                    <span>Booking Date :</span>
                    <input type="date" name="bookingdate" id="bookingdate" readonly>
                </div>
                <div class="inputBox">
                    <span>arrivals :</span>
                    <input type="date" name="arrivaldate" id="arrival" required>
                </div>
                <div class="inputBox">
                    <span>leaving :</span>
                    <input type="date" name="leavingdate" id="leaving" required>
                </div>
                <div class="inputBox">
                    <span>Total Days :</span>
                    <input type="text" name="totalday" id="totaldays" value="" style="background-color: transparent;" readonly>
                </div>
                <div class="inputBox">
                    <span>Total Price :</span>
                    <input type="text" value="" name="totalprice" id="totalprice" style="background-color: transparent;" readonly>
                </div>
            </div>

            <input type="submit" value="submit" class="btn" name="send">
            <a href="./bookinghistory.php" style="float: right;"><input type="button" value="History" class="btn" name="history"></a>
        </form>
    </section>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" language="javascript">
        $('#hotel').on('change', function() {
            var hotel_id = this.value;
            $.ajax({
                url: "ajaxdata.php?hotel_id=" + hotel_id,
                type: "GET",
                data: {
                    hotel_id: hotel_id
                },
                cache: false,
                success: function(result) {
                    $("#perdayprice").val(result);
                }
            });
        });
        var date = new Date();
        var currentDate = date.toISOString().slice(0, 10);
        document.getElementById('bookingdate').value = currentDate;
    </script>
<?php

} else {
    if (isset($_SESSION['user'])) {
?>
    <div class="heading" style="background:url(../../images/header-bg-3.png) no-repeat">
        <h1>book now</h1>
    </div>

    <!-- booking section starts  -->
    <section class="booking">

        <h1 class="heading-title">book your Hotel!</h1>

        <form action="bookingprocess.php" method="post" class="book-form">
            <div class="flex">
                <div class="inputBox">
                    <span>User :</span>
                    <?php
                        // get current logged in user   
                        $logedInUseremail = $_SESSION['user'];
                        $statementuser = $pdo->prepare("SELECT * from users where Email=?");
                        $statementuser->execute(array($logedInUseremail));
                        while ($logedInUsername = $statementuser->fetch()) {
                            $currentusername = $logedInUsername['Name'];
                        }
                    ?>
                    <input type="text" value="<?= $currentusername ?>" id="user" disabled readonly>
                </div>
                <div class="inputBox">
                    <span>country :</span>
                    <select class="combo" name="countrys" id="country" required>
                        <?php
                        if ($_GET['id']) {
                        ?>
                            <option value="<?= $countryid ?>"><?= $countryrow['CountryName']; ?></option>
                            <?php
                        } else {

                            $statement = $pdo->prepare("SELECT * FROM country");
                            $statement->execute();
                            while ($row = $statement->fetch()) {
                            ?>
                                <option value="<?= $row['Id']; ?>"><?= $row['CountryName']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>State :</span>
                    <select class="combo" name="State" id="state" required>
                        <?php
                        $bookstate = $pdo->prepare("SELECT * FROM States");
                        $bookstate->execute();
                        while ($selctstate = $bookstate->fetch()) {
                        ?>
                            <option value="<?= $selctstate['Id']; ?>"><?= $selctstate['StateName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <select class="combo" name="city" id="citys" required>
                        <?php
                        $bookcity = $pdo->prepare("SELECT * FROM city");
                        $bookcity->execute();
                        while ($selectcity = $bookcity->fetch()) {
                        ?>
                            <option value="<?= $selectcity['Id']; ?>"><?= $selectcity['CityName'] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="inputBox">
                    <span>Hotel :</span>
                    <select class="combo" name="Hotels" id="hotel" required>
                        <?php
                        $bookhotel = $pdo->prepare("SELECT * FROM hotels");
                        $bookhotel->execute();
                        while ($selecthotel = $bookhotel->fetch()) {
                        ?>
                            <option value="<?= $selecthotel['Id']; ?>"><?= $selecthotel['HotelName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Perday Rent :</span>
                    <input type="text" id="perdayprice" value="" readonly style="background-color: transparent;">
                </div>
                <div class="inputBox">
                    <span>Number Of Rooms :</span>
                    <input type="number" name="totalrooms" id="numberofroom" value="" required>
                </div>
                <div class="inputBox">
                    <span>Booking Date :</span>
                    <input type="date" name="bookingdate" id="bookingdate" readonly>
                </div>
                <div class="inputBox">
                    <span>arrivals :</span>
                    <input type="date" name="arrivaldate" id="arrival" required> 
                </div>
                <div class="inputBox">
                    <span>leaving :</span>
                    <input type="date" name="leavingdate" id="leaving" required>
                </div>
                <div class="inputBox">
                    <span>Total Days :</span>
                    <input type="text" name="totalday" id="totaldays" value="" style="background-color: transparent;" readonly>
                </div>
                <div class="inputBox">
                    <span>Total Price :</span>
                    <input type="text" value="" name="totalprice" id="totalprice" style="background-color: transparent;" readonly>
                </div>
            </div>

            <input type="submit" value="submit" class="btn" name="send">
            <a href="./bookinghistory.php" style="float: right;"><input type="button" value="History" class="btn" name="history"></a>
        </form>
    </section>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script>
        $('#hotel').on('change', function() {
            var hotel_id = this.value;
            $.ajax({
                url: "ajaxdata.php?hotel_id=" + hotel_id,
                type: "GET",
                data: {
                    hotel_id: hotel_id
                },
                cache: false,
                success: function(result) {
                    $("#perdayprice").val(result);
                }
            });
        });
    </script>

<?php
}
else {
    echo "<script>window.location.href='../loginlogout/login.php'; alert('Log_In First');</script>";

}
}

?>
<script type="text/javascript" language="javascript">
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#arrival').attr('min', maxDate);
        $('#leaving').attr('min', maxDate);
        let hotelID = $("#hotel").val();
        hotel(hotelID);
    });
    $('#country').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "ajaxdata.php?country_id=" + country_id,
            type: "GET",
            data: {
                country_id: country_id
            },
            cache: false,
            success: function(result) {
                $("#state").html(result);
                $('#citys').html('<option value="">Select State First</option>');
            }
        });
    });

    $('#state').on('change', function() {
        var State_id = this.value;
        $.ajax({
            url: "ajaxdata.php?State_id=" + State_id,
            type: "GET",
            data: {
                State_id: State_id
            },
            cache: false,
            success: function(result) {
                $("#citys").html(result);
            }
        });
    });

    $('#citys').on('change', function() {
        var city_id = this.value;
        $.ajax({
            url: "ajaxdata.php?city_id=" + city_id,
            type: "GET",
            data: {
                city_id: city_id
            },
            cache: false,
            success: function(result) {
                $("#hotel").html(result);
            }
        });
    });



    function hotel(id) {
        // alert("Hotel Id: " + id);
        var hotel_id = id;
        $.ajax({
            url: "ajaxdata.php?hotel_id=" + hotel_id,
            type: "GET",
            data: {
                hotel_id: hotel_id
            },
            cache: false,
            success: function(result) {
                $("#perdayprice").val(result);
            }
        });
    }
    $('#leaving').on('change', function() {
        var arrival = document.getElementById("arrival").value;
        var leaving = this.value;

        const date1 = new Date(arrival);
        const date2 = new Date(leaving);
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

        $.ajax({
            url: "ajaxdata.php?diffDays=" + diffDays,
            type: "GET",
            cache: false,
            success: function(result) {
                $("#totaldays").val(result);
            }
        });
        var perdayprice = document.getElementById("perdayprice").value;
        var noofroom = document.getElementById("numberofroom").value;
        var totalday = diffDays;
        var totalprice = perdayprice * noofroom * totalday;
        $.ajax({
            url: "ajaxdata.php?totalprice=" + totalprice,
            type: "GET",
            data: {
                totalprice: totalprice
            },
            cache: false,
            success: function(result) {
                $("#totalprice").val(result);
            }
        });
    });
    var date = new Date();
    var currentDate = date.toISOString().slice(0, 10);
    document.getElementById('bookingdate').value = currentDate;
</script>



<!-- booking section ends -->