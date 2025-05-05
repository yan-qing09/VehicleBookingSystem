<?php
include('mysession.php');
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

$sql = "SELECT *
        FROM tb_user
        WHERE u_ic = ?";
$stmt = $con->prepare($sql);

$stmt->bind_param('s', $suic);
$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_array();
$userIC = $row['u_ic'];
$userName = $row['u_name'];
$userEmail = $row['u_email'];
$userPhone = $row['u_phone'];
$userStreet = $row['u_street'];
$userCity = $row['u_city'];
$userPostcode = $row['u_postcode'];
$userState = $row['u_state'];
$userLic = $row['u_lic'];
?>

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">PROFILE</h1>
          </div>
        </div>
      </div>
    </section>

    <?php
      if (isset($_GET['message']) && isset($_GET['type'])) {
          $message = urldecode($_GET['message']);
          $messageType = urldecode($_GET['type']);
          echo '<br>';
          echo '<div class="alert ' . ($messageType === 'success' ? 'alert-success' : 'alert-danger') . '">' . $message . '</div>';
      }
    ?>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-3">UPDATE YOUR PROFILE</h2>
          </div>
        </div>
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-8 block-9 mb-md-5 mx-auto">
            <form method = "POST" action="custprofileprocess.php" class="bg-light p-5 contact-form" id="updateForm">
              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Identity Card No</label>
                <input type="text" name="fic" class="form-control" id="exampleInputIc" placeholder="IC number without dash (-)" value="<?php echo $userIC; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Full Name</label>
                <input type="text" name= "fname" class="form-control" id="exampleInputName" placeholder="Name according to IC" value="<?php echo $userName; ?>" readonly>
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword3" class="form-label mt-4">Current Password</label>
                  <input type="password" name="currentPassword" class="form-control" id="exampleInputPassword3" placeholder="Password">
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword4" class="form-label mt-4">New Password</label>
                  <input type="password" name="newPassword" class="form-control" id="exampleInputPassword4" placeholder="New Password">
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword5" class="form-label mt-4">Re-Enter Password</label>
                  <input type="password" name="confirmPassword" class="form-control" id="exampleInputPassword5" placeholder="Re-Enter New Password">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Email Address</label>
                <input type="email" name= "femail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $userEmail; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Phone Number</label>
                <input type="text" name= "fphone" class="form-control" id="exampleInputPhone" placeholder="Please include country code" value="<?php echo $userPhone; ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">License Number</label>
                <input type="text" name= "flic" class="form-control" id="exampleInputLic" placeholder="Driving license number" value="<?php echo $userLic; ?>">
              </div>
              
              <div class="form-group">
                <label for="exampleTextarea" class="form-label mt-4">Street</label>
                <textarea class="form-control" name="fstreet" id="exampleTextarea" rows="3"><?php echo $userStreet; ?></textarea>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="exampleCity" class="form-label mt-4">City</label>
                  <input type="text" name="fcity" class="form-control" id="exampleCity" placeholder="City" value="<?php echo $userCity; ?>">
                </div>

                <div class="form-group col-md-4">
                  <label for="examplePostcode" class="form-label mt-4">Postcode</label>
                  <input type="text" name="fpostcode" class="form-control" id="examplePostcode" placeholder="Postcode" value="<?php echo $userPostcode; ?>">
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleState" class="form-label mt-4">State</label>
                  <input type="text" name="fstate" class="form-control" id="exampleState" placeholder="State" value="<?php echo $userState; ?>">
                </div>
              </div>

              <br>
              <div id="passwordError" style="color: red;"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block py-3">UPDATE PROFILE</button>
              </div>
              <div class="form-group">
                <a href="custmain.php" class="btn btn-light btn-block py-3">CANCEL</a>
            </div>

            </form>
          </div>
        </div>
      </div>
    </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script>
document.getElementById('updateForm').addEventListener('submit', function(event) {
    var currentPassword = document.getElementById('exampleInputPassword3').value;
    var newPassword = document.getElementById('exampleInputPassword4').value;
    var confirmPassword = document.getElementById('exampleInputPassword5').value;

    if ((newPassword || confirmPassword) && !currentPassword) {
        document.getElementById('passwordError').innerHTML = 'Please enter the current password';
        event.preventDefault();
        return;
    }

    if (newPassword !== confirmPassword) {
        document.getElementById('passwordError').innerHTML = 'New Password and Re-Enter Password do not match';
        event.preventDefault();
    } else {
        document.getElementById('passwordError').innerHTML = '';
    }
});
</script>



<?php 
include "footer.php";
$stmt->close();
$con->close();
?>