<?php 
include 'headermain.php';
include 'dbconnect.php';

$sql = "SELECT v_reg, v_model, v_price, v_type, v_pic 
				FROM tb_vehicle
				WHERE v_status = '1'";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/image_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4">CHEAP CAR RENTAL IN YOUR DESIRED DESTINATION</h1>
	            <p style="font-size: 18px;">Explore on a budget with our affordable car rentals. Enjoy the freedom to discover your dream destination at a low cost.</p>
	            	<div class="heading-title ml-5">
		            	<p><a href="login.php" class="btn btn-info py-3 px-4">LOGIN FOR FAST BOOKING</a></p>
	            	</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          	<span class="subheading">Discover Our Selection</span>
            <h2 class="mb-2">Featured Vehicles</h2>
          </div>
        </div>
        <div class="row">
    			<div class="col-md-12">
    				<div class="carousel-car owl-carousel">
    					<?php
								while ($row = mysqli_fetch_assoc($result)) {
								    echo '<div class="item">
								        <div class="car-wrap rounded ftco-animate">
								            <div class="img rounded d-flex align-items-end" style="background-image: url(' . $row["v_pic"] . ');">
								            </div>
								            <div class="text">
								                <h2 class="mb-0"><a href="#">' . $row["v_model"] . '</a></h2>
								                <div class="d-flex mb-3">
								                    <span class="cat">' . $row["v_type"] . '</span>
								                    <p class="price ml-auto">RM' . $row["v_price"] . ' <span>/day</span></p>
								                </div>
								                <p class="d-flex mb-0 d-block">
								                    <a href="login.php" class="btn btn-primary py-2 mr-1">Book now</a>
								                    <a href="login.php" class="btn btn-secondary py-2 ml-1">Details</a>
								                </p>
								            </div>
								        </div>
								    </div>';
								}
							?>

    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    					

    <section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Why Choose Us</span>
            <h2 class="mb-3">Our Commitment to You</h2>
          </div>
        </div>
				<div class="row">
					<div class="col-md-4">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">24/7 Car Support</h3>
                <p>Experience the convenience of round-the-clock assistance. Our dedicated team ensures your car needs are met anytime, anywhere.</p>
              </div>
            </div>
					</div>
					<div class="col-md-4">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Lots of Locations</h3>
                <p>Discover our vast network of locations, making it easy for you to pick up and drop off your rental car wherever your journey takes you.</p>
              </div>
            </div>
					</div>
					<div class="col-md-4">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Reservation Anytime</h3>
                <p>Enjoy the flexibility of reserving your preferred car at any time. We make the booking process seamless for your convenience.</p>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>

    <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php 
include "footer.php";
$stmt->close();
$con->close();
?>