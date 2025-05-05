<?php 
include('mysession.php');
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

$suic= $_SESSION['u_ic']; //Get IC for current user

$sql = "SELECT * 
        FROM tb_booking
        LEFT JOIN tb_vehicle ON tb_booking.b_reg = tb_vehicle.v_reg
        LEFT JOIN tb_status ON tb_booking.b_status = tb_status.s_id
        LEFT JOIN tb_user ON tb_booking.b_ic = tb_user.u_ic
        WHERE b_status = '1'";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">APPROVAL</h1>
          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-section contact-section">
      <div class="container">
        <div class="table-responsive">
        <table id="approvalinfo" class="table table-hover">
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
                            var modalId = 'approvalModal-" . $row['b_id'] . "';
                            var modalTrigger = document.getElementById('modalTrigger-" . $row['b_id'] . "');
                            var myModal = new bootstrap.Modal(document.getElementById(modalId));
                            modalTrigger.addEventListener('click', function () {
                                myModal.show();
                            });
                        });
                    </script>";

              echo "<tr>";
              echo "<td class='text-center'>".$row['b_id']."</td>";
              echo "<td class='text-center'>".$row['b_ic']."</td>";
              echo "<td class='text-center'>".$row['v_model']."</td>";
              echo "<td class='text-center'>".$row['b_pdate']."</td>";
              echo "<td class='text-center'>".$row['b_rdate']."</td>";
              echo "<td class='text-center'>".$row['b_total']."</td>";
              echo "<td class='text-center'>";
                echo "<button type='button' class='btn btn-warning m-1' id='modalTrigger-" . $row['b_id'] . "'>Approval</button>&nbsp";
                echo "</td>
                    </tr>";

              echo "<div class='modal fade' id='approvalModal-" . $row['b_id'] . "' tabindex='-1' role='dialog' aria-labelledby='approvalModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                      <div class='modal-content text-dark'>
                          <div class='modal-header'>
                              <h5 class='modal-title' id='approvalModalLabel'>New Booking Details</h5>
                              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                              </button>
                          </div>
                          <div class='modal-body'>
                              <form id='approval' method='post' action='staffapprovalprocess.php?id=" . $row['b_id'] . "'>";
                                   echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Booking ID</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['b_id'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>User ID</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong> " . $row['b_ic'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>User Name</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['u_name'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Vehicle ID</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['b_reg'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Vehicle Model</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['v_model'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Pickup Date</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['b_pdate'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Return Date</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['b_rdate'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Price per day</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['v_price'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Total Price</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <strong>" . $row['b_total'] . "</strong>
                                            </div>
                                        </div>";

                                    echo "<div class='row'>
                                            <div class='col-sm-6'>
                                                <strong>Approval</strong>
                                            </div>
                                            <div class='col-sm-6'>
                                                <select class='form-select text-dark' name='fstatus'>";
                                                
                                    $sqls = "SELECT * FROM tb_status";
                                    $stmt = $con->prepare($sqls);
                                    $stmt->execute();
                                    $results = $stmt->get_result();

                                    while ($rows = mysqli_fetch_array($results)) {
                                        if ($rows['s_id'] != '1' && $rows['s_id'] != '4' && $rows['s_id'] != '5') {
                                            echo "<option value='" . $rows['s_id'] . "'>" . $rows['s_desc'] . "</option>";
                                        }
                                    }

                                    echo "</select>
                                            </div>
                                        </div>";
                                    echo "<div class='modal-footer'>
                                          <button type='submit' class='btn btn-warning'>Approval</button>
                                      </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>";


            }
            ?>
          </tbody>
        </table>
    </div>
      </div>
    </section>

<script>
    $('#approvalinfo').DataTable({
        "lengthMenu": [5, 10, 15, 20],
        "pageLength": 5,
    });
</script>  

<?php 
$stmt->close();
$con->close();
include "footer.php";
?>