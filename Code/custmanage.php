<?php
include('mysession.php'); //protect this page, cannot enter url to go this page
if(!session_id())
{
  session_start();
}

if(($_SESSION['u_type']) != 2)
{
    header('Location: login.php');
    exit();
}

include 'headercust.php';
include 'dbconnect.php';

$suic= $_SESSION['u_ic'];

$sql = "SELECT * FROM tb_booking
            LEFT JOIN tb_vehicle ON tb_booking.b_reg = tb_vehicle.v_reg
            LEFT JOIN tb_status ON tb_booking.b_status = tb_status.s_id  
            WHERE b_ic = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param('s', $suic);
$stmt->execute();

$result = $stmt->get_result();
?>

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">MANAGE BOOKING</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <table id="managebooking" class="table table-hover">
          <thead>
            <tr>
              <th scope="col" class="text-center">Booking ID</th>
              <th scope="col" class="text-center">Vehicle</th>
              <th scope="col" class="text-center">Pickup Date</th>
              <th scope="col" class="text-center">Return Date</th>
              <th scope="col" class="text-center">Total Rent</th>
              <th scope="col" class="text-center">Status</th>
              <th scope="col" class="text-center">Operation</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "<script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var modalId = 'cancelConfirmationModal-" . $row['b_id'] . "';
                            var modalTrigger = document.getElementById('modalTrigger-" . $row['b_id'] . "');
                            var myModal = new bootstrap.Modal(document.getElementById(modalId));
                            modalTrigger.addEventListener('click', function () {
                                myModal.show();
                            });
                        });
                    </script>";

              echo "<tr>";
              echo "<td class='text-center'>" . $row['b_id'] . "</td>";
              echo "<td class='text-center'>" . $row['v_model'] . "</td>";
              echo "<td class='text-center'>" . $row['b_pdate'] . "</td>";
              echo "<td class='text-center'>" . $row['b_rdate'] . "</td>";
              echo "<td class='text-center'>" . $row['b_total'] . "</td>";
              echo "<td class='text-center'>" . $row['s_desc'] . "</td>";
              echo "<td class='text-center'>";
              if ($row['b_status'] != '4') {
                echo "<a href='custmodify.php?id=" . $row['b_id'] . "' button type='button' class='btn btn-warning'>Modify</a>&nbsp";
                echo "<button type='button' class='btn btn-danger' id='modalTrigger-" . $row['b_id'] . "'>Cancel</button>";
              }
              else {
                echo "<span>No Operation Available</span>";
              }
              echo "</td>";
              echo "</tr>";

              echo "<div class='modal fade' id='cancelConfirmationModal-" . $row['b_id'] . "' tabindex='-1' role='dialog' aria-labelledby='cancelModalLabel' aria-hidden='true'>
                      <div class='modal-dialog' role='document'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                  <h5 class='modal-title' id='cancelModalLabel'>Cancel Booking</h5>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                      <span aria-hidden='true'>&times;</span>
                                  </button>
                              </div>
                              <div class='modal-body'>
                              <form id='cancel' method='post' action='custcancel.php?id=" . $row['b_id'] . "'>
                                  <p>Are you sure you want to cancel this booking?</p>
                              </div>
                              <div class='modal-footer'>
                                  <button type='submit' class='btn btn-danger'>Yes</button>
                                  <button type='submit' class='btn btn-light' data-dismiss='modal'>No</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script>
    $('#managebooking').DataTable({
        "lengthMenu": [5, 10, 15, 20],
        "pageLength": 5,
    });
</script>  


<?php 
include "footer.php";

$stmt->close();
$con->close();
?>