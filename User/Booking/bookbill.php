<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML2pdf</title>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/bill.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/6be23040d4.js"></script>  
    <!-- <link href="../../css/font-awesome.min.css" rel="stylesheet" /> -->
    <script src="../../js/html2pdf.bundle.min.js"></script>
    <!-- Download Bill PDF Script -->
    <script>
        window.onload = function() {
            document.getElementById("download")
                .addEventListener("click", () => {
                    const invoice = this.document.getElementById("invoice");
                    console.log(invoice);
                    console.log(window);
                    var opt = {
                        margin: 0.5,
                        filename: 'bills.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 1
                        },
                        html2canvas: {
                            scale: 2
                        },
                        jsPDF: {
                            unit: 'in',
                            format: 'letter',
                            orientation: 'portrait'
                        }
                    };
                    html2pdf().from(invoice).set(opt).save();
                })
        }
    </script>
</head>

<body><br>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
    $id = $_GET['id'];
    if (isset($_SESSION['user'])) {
        // get current logged in user   
        $logedInUseremail = $_SESSION['user'];
        $statementid = $pdo->prepare("SELECT * from users where Email=?");
        $statementid->execute(array($logedInUseremail));
        $logedInUserid = $statementid->fetch();
        $userid = $logedInUserid['Id'];
        $username = $logedInUserid['Name'];
        $mobile = $logedInUserid['MobileNo'];
        $statementbookingdata = $pdo->prepare("SELECT * from booking where User_id=? and Id=?");
        $statementbookingdata->execute(array($userid, $id));
        $logedInUserhistory = $statementbookingdata->fetch();
        $bookid = $logedInUserhistory['Id'];
        $hotelid = $logedInUserhistory['Hotel_id'];
        $statementbookinghotel = $pdo->prepare("SELECT * from hotels where Id=?");
        $statementbookinghotel->execute(array($hotelid));
        $bookhotel = $statementbookinghotel->fetch();
        $hotelname = $bookhotel['HotelName'];
        $perdayprice = $bookhotel['PerDayPrice'];
        $city = $bookhotel['City_id'];
        $bookingdate = date("Y-m-d", strtotime($logedInUserhistory['BookingDate']));
        $arrivaldate = date("Y-m-d", strtotime($logedInUserhistory['ArrivalDate']));
        $leavingdate = date("Y-m-d", strtotime($logedInUserhistory['LeavingDate']));
        $totaldays = $logedInUserhistory['Totaldays'];
        $totalrooms = $logedInUserhistory['TotalRooms'];
        $totalprice = $logedInUserhistory['TotalPrice'];
        $status = $logedInUserhistory['status'];
        $statementcity = $pdo->prepare("SELECT * from city where Id=?");
        $statementcity->execute(array($city));
        $recordcity = $statementcity->fetch();
        $cityname = $recordcity['CityName'];
        $state = $recordcity['State_id'];
        $statementstate = $pdo->prepare("SELECT * from states where Id=?");
        $statementstate->execute(array($state));
        $recordstate = $statementstate->fetch();
        $statename = $recordstate['StateName'];
        $country = $recordstate['Country_id'];
        $statementcountry = $pdo->prepare("SELECT * from country where Id=?");
        $statementcountry->execute(array($country));
        $recordcountry = $statementcountry->fetch();
        $countryname = $recordcountry['CountryName'];
        $tax = ($totalprice * 10) / 100;
        $finalamount = $totalprice + $tax;
        if ($status == 1) {
    ?>
            <div class="page-content container px-5" style="border: solid 1px;">
                <div class="page-header text-blue-d2">
                    <h1 class="page-title text-secondary-d1">
                        Invoice
                    </h1>

                    <div class="page-tools">
                        <div class="action-buttons">
                            <a id="download" class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                                <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                                Print
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container" id="invoice">
                    <div class="row mt-4">
                        <div class="col-12 col-lg-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center text-150" style="background-color: black;">
                                        <img src="../../images/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <!-- .row -->

                            <hr class="row brc-default-l1 mx-n1 mb-4" />

                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle">To:</span>
                                        <span class="text-600 text-110 text-blue align-middle"><?= $username ?></span>
                                    </div>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                            <?= $cityname ?>
                                        </div>
                                        <div class="my-1">
                                            <?= $statename ?>, <?= $countryname ?>
                                        </div>
                                        <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600"><?= $mobile ?></b></div>
                                    </div>
                                </div>
                                <!-- /.col -->

                                <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                    <hr class="d-sm-none" />
                                    <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                            Invoice
                                        </div>

                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID: &nbsp; </span><?= $userid ?></div>

                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> <?= $bookingdate ?></div>

                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">Unpaid</span></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                    <thead class="bg-none bgc-default-tp1">
                                        <tr class="text-white">
                                            <th class="opacity-2">#</th>
                                            <th>HotelName</th>
                                            <th>Rooms</th>
                                            <th>ArrivalDate</th>
                                            <th>LeavingDate</th>
                                            <th width="140">Amount</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-95 text-secondary-d3">
                                        <tr></tr>
                                        <tr>
                                            <td>1</td>
                                            <td><?= $hotelname ?></td>
                                            <td><?= $totalrooms ?></td>
                                            <td class="text-95"><?= $arrivaldate ?></td>
                                            <td class="text-95"><?= $leavingdate ?></td>
                                            <td class="text-secondary-d2">₹ <?= $perdayprice ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                        Extra note such as company or payment information...
                                    </div>

                                    <div class="col-12 col-sm-5 text-- text-90 order-first order-sm-last">
                                        <div class="row my-2">
                                            <div class="col-7 text-right">
                                                SubTotal
                                            </div>
                                            <div class="col-5">
                                                <span class="text-120 text-secondary-d1">₹ <?= $totalprice ?></span>
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-7 text-right">
                                                Tax (10%)
                                            </div>
                                            <div class="col-5">
                                                <span class="text-110 text-secondary-d1">₹ <?= $tax ?></span>
                                            </div>
                                        </div>

                                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                            <div class="col-7 text-right">
                                                Total Amount
                                            </div>
                                            <div class="col-5">
                                                <span class="text-150 text-success-d3 opacity-2">₹ <?= $finalamount ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-secondary-d1 text-105">Thank you for your business</span>
                                    <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</body>
<?php
        } else {
            echo "NO";
        }
    }
?>

</html>