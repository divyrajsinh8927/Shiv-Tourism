<?php
include('../home/header.php');
?>
<section class="home">
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=tourism", "root", "");
    if (isset($_SESSION['user'])) {
        // get current logged in user   
        $logedInUseremail = $_SESSION['user'];
        $statementid = $pdo->prepare("SELECT * from users where Email=?");
        $statementid->execute(array($logedInUseremail));
        $logedInUserid = $statementid->fetch();
        $userid = $logedInUserid['Id'];
        $username = $logedInUserid['Name'];
        $statementbookingdata = $pdo->prepare("SELECT * from booking where User_id=?");
        $statementbookingdata->execute(array($userid));
    ?>
        <div class="heading" style="background:url(../../images/6.jpg) no-repeat">
            <h1>BOOKING HISTORY OF <?= $username ?></h1>
        </div><br><br><br>
        <div class="flex">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>HotelName</th>
                        <th>bookingdate</th>
                        <th>arrival-leavingdate</th>
                        <th>Totaldays</th>
                        <th>totalrooms</th>
                        <th>totalprice</th>
                        <th>Status</th>
                        <th>Hotel confirmation</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                        <tr>
                        <th>HotelName</th>
                        <th>bookingdate</th>
                        <th>arrival-leavingdate</th>
                        <th>Totaldays</th>
                        <th>totalrooms</th>
                        <th>totalprice</th>
                        <th>States</th>
                        </tr>
                    </tfoot> -->
                <?php
                while ($logedInUserhistory = $statementbookingdata->fetch()) {
                    $bookid = $logedInUserhistory['Id'];
                    $hotelid = $logedInUserhistory['Hotel_id'];
                    $statementbookinghotel = $pdo->prepare("SELECT * from hotels where Id=?");
                    $statementbookinghotel->execute(array($hotelid));
                    $bookhotel = $statementbookinghotel->fetch();
                    $hotelname = $bookhotel['HotelName'];
                    $bookingdate = date("Y-m-d", strtotime($logedInUserhistory['BookingDate']));
                    $arrivaldate = date("Y-m-d", strtotime($logedInUserhistory['ArrivalDate']));
                    $leavingdate = date("Y-m-d", strtotime($logedInUserhistory['LeavingDate']));
                    $totaldays = $logedInUserhistory['Totaldays'];
                    $totalrooms = $logedInUserhistory['TotalRooms'];
                    $totalprice = $logedInUserhistory['TotalPrice'];
                    $status = $logedInUserhistory['status'];
                    if($logedInUserhistory['cancle_booking'] == 0){
                ?>
                    <tbody>
                        <tr>
                            <td data-label="Hotel-"><?= $hotelname ?></td>
                            <td data-label="bOOKINGDATE-"><?= $bookingdate ?></td>
                            <td data-label="Arrivaldate-"><?= $arrivaldate ?> - <?= $leavingdate ?></td>
                            <td data-label="Totaldays-"><?= $totaldays ?></td>
                            <td data-label="totalrooms-"><?= $totalrooms ?></td>
                            <td data-label="totalprice-"><?= $totalprice ?></td>
                            <?php
                            $currentdate = date("Y/m/d");
                            if (strtotime($currentdate) > strtotime($leavingdate)) {
                            ?>
                                <td data-label="sTATES">&nbsp; COMPLATED &nbsp; </button></td>
                            <?php
                            } else { 
                                if($status == NULL){
                                ?>
                                <td data-label="sTATES-"><a href="canclebooking.php?bookid=<?= $bookid ?>" onclick="if (! confirm('Are You Sure?')) { return false; }"><button class="btn-danger" style="font-weight: bolder; color: black; border-radius: 10px; border: 1px;">&nbsp; cancle &nbsp;</button></a></td>
                    <?php
                            }else{
                                ?>
                                <td></td>
                                <?php
                            }
                            }
                            if ($status == 1) {
                                ?>
                                    <td data-label="Hotel confirmation-">&nbsp; Approved &nbsp; </button></td>
                                <?php
                                } 
                                elseif($status == 0){
                                    ?>
                                    <td data-label="Hotel confirmation">&nbsp; Disapproved &nbsp; </button></td>
                                <?php
                                }
                                if($status == 1){
                                ?>
                                <td><a href="./bookbill.php?id=<?=$bookid?>"><i class="fa fa-thin fa-file-pdf" style="font-size:36px;color: red;"></i></a></td>
                        <?php
                                }
                                else if($status == NULL)
                                {
                                    ?>
                                    <td data-label="Hotel confirmation">&nbsp; waiting For confirmation &nbsp; </button></td>
<?php
                                }
                        }
                    }   
                    } else {
                        echo "<script> window.location.href = './index.php'; alert('To Book Hotel Login First');</script>";
                    }
                    ?>
                        </tr>
                    </tbody>
            </table>
            <div class="clearfix" style="padding-right: 15px; float: right;">
                <a href="./canclehistory.php" class="btn">Cancle History</a>
            </div>
        </div>
</section><br><br><br><br>
<?php
include('../home/footer.php');
?>