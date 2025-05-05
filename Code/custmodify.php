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

//Get booking id
if(isset($_GET['id']))
{
  $fbid = $_GET['id'];
}   

//Retrieve booking data
$sqlr = "SELECT * FROM tb_booking 
         LEFT JOIN tb_vehicle ON tb_booking.b_reg = tb_vehicle.v_reg
         WHERE b_id = ?";

$stmt = $con->prepare($sqlr);

$stmt->bind_param('s', $fbid);
$stmt->execute();

$resultr = $stmt->get_result();
$rowr = mysqli_fetch_array($resultr);

?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">MODIFY BOOKING</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-8 block-9 mb-md-5 mx-auto">
            <form method = "POST" action="custmodifyprocess.php" class="bg-light p-5 contact-form" id="modifyForm">
              <div class="form-group">
                <label for="exampleSelect1" class="form-label mt-4">Select Vehicle</label>

                <?php
                  echo '<input type="hidden" value="'.$rowr['b_id'].'" name="fbid">';

                  $sql = "SELECT * FROM tb_vehicle";
                  $stmt = $con->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  echo '<select class="custom-select" name="fvehicle" id="exampleSelect1">';
                  while($row = mysqli_fetch_array($result))
                  {
                    if($row['v_reg']==$rowr['b_reg'])
                    {
                      echo"<option selected='selected' value='".$row['v_reg']."'>".$row['v_model'].", RM".$row['v_price']."</option>";
                    }
                    else
                    {
                      echo"<option value='".$row['v_reg']."'>".$row['v_model'].", RM".$row['v_price']."</option>";
                    }
                  }
                  echo '</select>';
              
                ?>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Select Pickup Date</label>
                <?php
                echo '<input type="date" value="' . $rowr['b_pdate'] . '" name="fpdate" class="form-control" id="pickupDate" required min="' . date("Y-m-d") . '">';
                ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Select Return Date</label>
                <?php
                echo '<input type="date" value="' . $rowr['b_rdate'] . '" name="frdate" class="form-control" id="returnDate" required>';
                ?>
            </div>

             <br> 
            <button type="submit" class="btn btn-warning btn-block py-3">Modify</button>
            <button type="reset" class="btn btn-light btn-block py-3">Reset</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script>
document.getElementById('modifyForm').addEventListener('change', function (event) {
    var pickupDate = new Date(document.getElementById('pickupDate').value);
    var returnDateField = document.getElementById('returnDate');
    var returnDate = new Date(returnDateField.value);

    returnDateField.min = pickupDate.toISOString().split('T')[0];

    if (returnDate < pickupDate) {
        returnDateField.value = pickupDate.toISOString().split('T')[0];
    }
});
</script>



<?php 
include "footer.php";
$stmt->close();
$con->close();
?>