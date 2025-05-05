<?php 
include('mysession.php'); //protect this page, cannot enter url to go this page
if(!session_id())
{
  session_start();
}

if(($_SESSION['u_type']) != 1)
{
    header('Location: login.php');
    exit();
}

include 'headerstaff.php';
include 'dbconnect.php';
include 'staffmainprocess.php';

$suic = $_SESSION['u_ic'];

$countPendingApprovals = getCountPendingApprovals($con);
$countCompleteOrders = getCountCompleteOrders($con);
$countCancelOrders = getCountCancelOrders($con);
$countInventory = getCountAvailableVehicles($con);

$thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));

$sql = "SELECT * 
        FROM tb_booking
        LEFT JOIN tb_vehicle ON tb_booking.b_reg = tb_vehicle.v_reg
        LEFT JOIN tb_status ON tb_booking.b_status = tb_status.s_id
        LEFT JOIN tb_user ON tb_booking.b_ic = tb_user.u_ic
        WHERE tb_booking.b_pdate >= ?
        ORDER BY tb_booking.b_pdate DESC";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $thirtyDaysAgo);
$stmt->execute();
$result = $stmt->get_result();

$sql1 = "SELECT 
            tb_vehicle.*,
            CASE
                WHEN COUNT(tb_booking.b_id) = 0 THEN 'Available'
                WHEN CURRENT_DATE BETWEEN MAX(CASE WHEN tb_booking.b_status = '2' THEN tb_booking.b_pdate END)
                                    AND MAX(CASE WHEN tb_booking.b_status = '2' THEN tb_booking.b_rdate END)
                    THEN 'Not Available'
                ELSE 'Available'
            END AS availability_status
        FROM tb_vehicle
        LEFT JOIN tb_booking ON tb_booking.b_reg = tb_vehicle.v_reg AND tb_booking.b_status = '2'
        WHERE tb_vehicle.v_status = '1'
        GROUP BY tb_vehicle.v_reg";

$stmt1 = $con->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();

$sql2 = "SELECT u_name 
        FROM tb_user
        WHERE u_ic >= ?";

$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("s", $suic);
$stmt2->execute();
$result2 = $stmt2->get_result();
$userName = $result2->fetch_array()['u_name'];

?>


<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">DASHBOARD</h1>
          </div>
        </div>
      </div>
    </section>

<section class="section">
    <div class="container">
      <div class="row">
          <div class="col-md-12 text-center">
              <h2>Hello, <?php echo $userName;?> !</h2>
          </div>
      </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-xl-3 col-xxl-3 mb-4" style="padding: 10px 5px;">
                <div class="card text-white shadow" style="background-color: #6c757d;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2 text-center">
                                <p><b>PENDING APPROVAL</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <div class="text-white fw-bold h5 mb-0" style="font-size: 35px;">
                                    <?php echo $countPendingApprovals; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 col-xxl-3 mb-4" style="padding: 10px 5px;">
                <div class="card text-white shadow" style="background-color: #17a2b8;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2 text-center">
                                <p><b>VEHICLE INVENTORY</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <div class="text-white fw-bold h5 mb-0" style="font-size: 35px;">
                                    <?php echo $countInventory; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 col-xxl-3 mb-4" style="padding: 10px 5px;">
                <div class="card text-white shadow" style="background-color: #28a745;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2 text-center">
                                <p><b>COMPLETED ORDERS</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <div class="text-white fw-bold h5 mb-0" style="font-size: 35px;">
                                    <?php echo $countCompleteOrders; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 col-xxl-3 mb-4" style="padding: 10px 5px;">
                <div class="card text-white shadow" style="background-color: #ffc107;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2 text-center">
                                <p><b>CANCELED ORDERS</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <div class="text-white fw-bold h5 mb-0" style="font-size: 35px;">
                                    <?php echo $countCancelOrders; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
        <h3 class="text-left mb-4">Booking Information</h3>
        <div class="table-responsive">
            <table id="bookinginfo" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Booking ID</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Vehicle</th>
                        <th class="text-center">Pickup Date</th>
                        <th class="text-center">Return Date</th>
                        <th class="text-center">Total Rent</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $row['b_id'] . "</td>";
                        echo "<td class='text-center'>" . $row['u_name'] . "</td>";
                        echo "<td class='text-center'>" . $row['v_model'] . "</td>";
                        echo "<td class='text-center'>" . $row['b_pdate'] . "</td>";
                        echo "<td class='text-center'>" . $row['b_rdate'] . "</td>";
                        echo "<td class='text-center'>" . $row['b_total'] . "</td>";
                        echo "<td class='text-center'>" . $row['s_desc'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="section">
    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
        <h3 class="text-left mb-4">Vehicle Information</h3>
        <div class="table-responsive">
            <table id="vehicleinfo" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Vehicle ID</th>
                        <th class="text-center">Vehicle Model</th>
                        <th class="text-center">Vehicle Type</th>
                        <th class="text-center">Mileage</th>
                        <th class="text-center">Transmission</th>
                        <th class="text-center">Seating Capacity</th>
                        <th class="text-center">Availability Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row1 = mysqli_fetch_array($result1)) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $row1['v_reg'] . "</td>";
                        echo "<td class='text-center'>" . $row1['v_model'] . "</td>";
                        echo "<td class='text-center'>" . $row1['v_type'] . "</td>";
                        echo "<td class='text-center'>" . $row1['v_mileage'] . "</td>";
                        echo "<td class='text-center'>" . $row1['v_transmission'] . "</td>";
                        echo "<td class='text-center'>" . $row1['v_seat'] . "</td>";

                        $availabilityStatus = $row1['availability_status'];
                        $buttonClass = ($availabilityStatus == 'Available') ? 'btn btn-success rounded' : 'btn btn-danger rounded';

                        echo "<td class='text-center'>
                                <button type='button' class='$buttonClass m-1' disabled>$availabilityStatus</button>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $('#bookinginfo').DataTable({
        "lengthMenu": [3, 10, 15, 20],
        "pageLength": 3,
    });

    $('#vehicleinfo').DataTable({
        "lengthMenu": [3, 10, 15, 20],
        "pageLength": 3,
    });
</script>       
               


<?php 
include "footer.php";
$stmt->close();
$stmt1->close();
$stmt2->close();
$con->close();
?>