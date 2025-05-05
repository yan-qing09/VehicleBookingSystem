<?php
include('mysession.php');

if (!session_id()) {
    session_start();
}

if(($_SESSION['u_type']) != 2) {
    header('Location: login.php');
    exit();
}

include 'headercust.php';
include 'dbconnect.php';

if (isset($_GET['id'])) {
    $vid = $_GET['id'];
}

$fpdate = $_POST['book_pdate'];
$frdate = $_POST['book_rdate'];
$suic = $_SESSION['u_ic'];

// CALCULATE TOTAL RENT PRICE
// 1. Convert form date to ISO8..
$start = date('Y-m-d H:i:s', strtotime($fpdate));
$end = date('Y-m-d H:i:s', strtotime($frdate));

// 2. Calculate num of days
$daydiff = abs(strtotime($start) - strtotime($end));
$daynum = $daydiff / (60 * 60 * 24);

// 3. Get vehicle price from table using prepared statement
$sqlp = "SELECT v_price FROM tb_vehicle WHERE v_reg = ?";
$stmtp = $con->prepare($sqlp);
$stmtp->bind_param('s', $vid);
$stmtp->execute();
$resultp = $stmtp->get_result();
$rowp = $resultp->fetch_array();

// 4. Calculate total price
$totalprice = $daynum * ($rowp['v_price']);

$sqlAvailability = "SELECT COUNT(*) as count FROM tb_booking 
                    WHERE b_reg = ? 
                    AND (b_pdate BETWEEN ? AND ? OR b_rdate BETWEEN ? AND ? OR ? BETWEEN b_pdate AND b_rdate) 
                    AND b_status = '2'";

$stmtAvailability = $con->prepare($sqlAvailability);
$stmtAvailability->bind_param("ssssss", $vid, $fpdate, $frdate, $fpdate, $frdate, $fpdate);
$stmtAvailability->execute();
$resultAvailability = $stmtAvailability->get_result();


$status = ($resultAvailability->fetch_assoc()['count'] == 0) ? '2' : '1';

// Insert new booking using prepared statement
$sql = "INSERT INTO tb_booking(b_ic, b_reg, b_pdate, b_rdate, b_total, b_status)
        VALUES(?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param('ssssds', $suic, $vid, $fpdate, $frdate, $totalprice, $status);
$stmt->execute();

?>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">ADD BOOKING</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-3">Here's your new booking details</h2>
          </div>
        </div>
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-8 block-9 mb-md-2 mx-auto bg-light p-5 contact-form">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-5">
                <h5 class="text-left"><strong>Vehicle</strong></h5>
                <h5 class="text-left"><strong>Pickup Date</strong></h5>
                <h5 class="text-left"><strong>Return Date</strong></h5>
                <h5 class="text-left"><strong>Duration</strong></h5>
                <h5 class="text-left"><strong>Total Price</strong></h5>
                <h5 class="text-left"><strong>Status</strong></h5>
              </div>
              <div class="col-md-5">
                <h5><?php echo $vid; ?></h5>
                <h5><?php echo $fpdate; ?></h5>
                <h5><?php echo $frdate; ?></h5>
                <h5><?php echo $daynum; ?></h5>
                <h5>RM <?php echo $totalprice; ?></h5>
                <h5><?php echo ($status == 1) ? 'Received' : 'Approved'; ?></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12 text-center">
              <a href="custmanage.php" class="btn btn-primary">Back</a>
          </div>
      </div>
    </section>


<?php
$stmtAvailability->close();
$stmt->close();
mysqli_close($con);
include "footer.php";
?>
