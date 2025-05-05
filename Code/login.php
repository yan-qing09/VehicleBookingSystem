<?php 
session_start();
include 'headermain.php';
?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">LOGIN</h1>
          </div>
        </div>
      </div>
    </section>

    <?php
      if (isset($_SESSION['loginError'])) {
        $message = $_SESSION['loginError'];
        echo '<br>';
        echo '<div class="alert alert-danger">' . $message . '</div>';
        unset($_SESSION['loginError']);
      }
    ?>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-3">LOGIN TO YOUR ACCOUNT</h2>
          </div>
        </div>
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-8 block-9 mb-md-5 mx-auto">
            <form method = "POST" action="loginprocess.php" class="bg-light p-5 contact-form">
              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Identity Card No</label>
                <input type="text" name= "fic" class="form-control" id="exampleInputIc" placeholder="IC number without dash (-)" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                <input type="password" name= "fpwd" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block py-3">LOGIN</button>
              </div>
              <hr class="my-4">
              <div class="text-center">
                <p class="mt-3 mb-0">Didn't have an account? <a href="register.php" style="color:#0a66bf;">Register Now</a></p>
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include "footer.php";?>