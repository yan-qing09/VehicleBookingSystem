<?php include 'headermain.php';?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <h1 class="mb-3 bread">REGISTER</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-3">NEW CUSTOMER REGISTER HERE</h2>
          </div>
        </div>
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-8 block-9 mb-md-5 mx-auto">
            <form method = "POST" action="registerprocess.php" class="bg-light p-5 contact-form" id="registrationForm">
              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Identity Card No</label>
                <input type="text" name= "fic" class="form-control" id="exampleInputIc" placeholder="IC number without dash (-)" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Full Name</label>
                <input type="text" name= "fname" class="form-control" id="exampleInputName" placeholder="Name according to IC" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                <input type="password" name= "fpwd1" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Re-Enter Password</label>
                <input type="password" name= "fpwd" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Phone Number</label>
                <input type="text" name= "fphone" class="form-control" id="exampleInputPhone" placeholder="Please include country code" required>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Email Address</label>
                <input type="email" name= "femail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">License Number</label>
                <input type="text" name= "flic" class="form-control" id="exampleInputLic" placeholder="Driving license number" required>
              </div>
              
              <div class="form-group">
                <label for="exampleTextarea" class="form-label mt-4">Street</label>
                <textarea class="form-control" name= "fstreet" id="exampleTextarea" rows="3" required></textarea>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="exampleCity" class="form-label mt-4">City</label>
                  <input type="text" name="fcity" class="form-control" id="exampleCity" placeholder="City" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="examplePostcode" class="form-label mt-4">Postcode</label>
                  <input type="text" name="fpostcode" class="form-control" id="examplePostcode" placeholder="Postcode" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleState" class="form-label mt-4">State</label>
                  <input type="text" name="fstate" class="form-control" id="exampleState" placeholder="State" required>
                </div>
              </div>

              <br>
              <div id="passwordError" style="color: red;"></div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block py-3">REGISTER</button>
              </div>

              <hr class="my-4">
              <div class="text-center">
                <p class="mt-3 mb-0">Already have an account? <a href="login.php" style="color:#0a66bf;">Login Now</a></p>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include "footer.php";?>