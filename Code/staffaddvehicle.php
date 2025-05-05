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

?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">ADD NEW VEHICLE</h1>
          </div>
        </div>
      </div>
    </section>
    <?php
      if (isset($_GET['message'])) {
      $message = urldecode($_GET['message']);
      echo '<br>';
      echo '<div class="alert ' . (strpos($message, 'Error') !== false ? 'alert-danger' : 'alert-success') . '">' . $message . '</div>';
      }
    ?>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-8 block-9 mb-md-5 mx-auto">
            <form method="POST" action="staffaddvehicleprocess.php" onsubmit="return onsubmit()" class="bg-light p-5 contact-form" id="addvehicleform" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputImage" class="form-label mt-4">Vehicle Image</label>
                <input type="file" name="fimage" class="form-control" id="exampleInputImage" accept="image/*" required>
                <small class="form-text text-muted">Accepted formats: JPEG, PNG, GIF. Maximum file size: 5MB.</small>
            </div>

              <div class="form-group">
                <label for="exampleInputReg" class="form-label mt-4">Vehicle ID</label>
                <input type="text" name= "freg" class="form-control" id="exampleInputModel" placeholder="exp: ABC123" required>
              </div>

              <div class="form-group">
                <label for="exampleInputModel" class="form-label mt-4">Vehicle Model</label>
                <input type="text" name= "fmodel" class="form-control" id="exampleInputModel" placeholder="exp: Range Rover Evoque" required>
              </div>

              <div class="form-group">
                <label for="exampleInputType" class="form-label mt-4">Vehicle Type</label>
                <input type="text" name= "ftype" class="form-control" id="exampleInputType" placeholder="exp: Coupe" required>
              </div>

              <div class="form-group">
                <label for="exampleInputMileage" class="form-label mt-4">Vehicle Mileage</label>
                <input type="text" name= "fmileage" class="form-control" id="exampleInputMileage" placeholder="exp: 10,000" required>
              </div>

              <div class="form-group">
                <label for="exampleInputSeat" class="form-label mt-4">Vehicle Seat</label>
                <input type="text" name= "fseat" class="form-control" id="exampleInputSeat" placeholder="exp: 4" required>
              </div>

              <div class="form-group">
                <label for="exampleInputTrans" class="form-label mt-4">Vehicle Transmission</label>
                <input type="text" name= "ftrans" class="form-control" id="exampleInputTrans" placeholder="exp: Automatic" required>
              </div>

              <div class="form-group">
                <label for="exampleInputColor" class="form-label mt-4">Vehicle Color</label>
                <input type="text" name= "fcolor" class="form-control" id="exampleInputColor" placeholder="exp: White" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPrice" class="form-label mt-4">Price Per Day (RM)</label>
                <input type="text" name= "fprice" class="form-control" id="exampleInputPrice" placeholder="exp: 250" required>
              </div>

              <div class="form-group">
                <label for="exampleTextareaDesc" class="form-label mt-4">Vehicle Description</label>
                <textarea class="form-control" name= "fdesc" id="exampleTextarea" rows="5" placeholder="exp: The Range Rover Evoque Coupe Prestige SD4 is ..." required></textarea>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block py-3">ADD VEHICLE</button>
              </div>
              <div class="form-group">
                <button type="reset" class="btn btn-light btn-block py-3">RESET</button>
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include "footer.php";?>